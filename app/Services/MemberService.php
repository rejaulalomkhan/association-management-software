<?php

namespace App\Services;

use App\Enums\PaymentTerm;
use App\Models\User;
use Carbon\Carbon;

/**
 * Service for member management and dues calculation.
 *
 * Handles membership ID generation, dues calculation (monthly/yearly),
 * member approval/rejection, and unpaid month tracking.
 */
class MemberService
{
    /**
     * Create a new MemberService instance.
     *
     * @param SettingsService $settingsService The settings service instance
     */
    public function __construct(
        private SettingsService $settingsService
    ) {}

    /**
     * Generate unique membership ID.
     *
     * Format: PUM-YY-XXXX (e.g., PUM-26-0001)
     * Where YY is the current year and XXXX is a sequential number.
     *
     * @return string The generated membership ID
     */
    public function generateMembershipId(): string
    {
        $year = Carbon::now()->format('y');
        $lastMember = User::whereNotNull('membership_id')
            ->orderBy('id', 'desc')
            ->first();

        if ($lastMember && $lastMember->membership_id) {
            // Extract number from last ID (e.g., PUM-25-0001 -> 1)
            preg_match('/\d+$/', $lastMember->membership_id, $matches);
            $lastNumber = isset($matches[0]) ? (int)$matches[0] : 0;
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }

        return sprintf('PUM-%s-%04d', $year, $newNumber);
    }

    /**
     * Calculate outstanding dues for a member.
     *
     * Behaviour depends on the member's effective payment term:
     *
     *  - monthly → iterate month-by-month from org start to current month,
     *              each month is "paid" when a monthly-term approved
     *              payment exists OR the whole year is covered by a
     *              yearly-term approved payment.
     *  - yearly  → iterate year-by-year, each year is "paid" when a
     *              yearly-term approved payment exists for that year OR
     *              all 12 months are covered by monthly-term payments.
     *
     * @param User $user The member to calculate dues for
     * @return array Dues information including unpaid_months, total_due, etc.
     */
    public function calculateOutstandingDues(User $user): array
    {
        $term = $user->effectivePaymentTerm();

        if ($term === PaymentTerm::YEARLY) {
            return $this->calculateYearlyDues($user);
        }

        return $this->calculateMonthlyDues($user);
    }

    /**
     * Classic monthly dues calculation with yearly-payment awareness.
     */
    private function calculateMonthlyDues(User $user): array
    {
        $orgStart   = Carbon::parse($this->settingsService->getOrganizationStartDate());
        $monthlyFee = $user->effectiveMonthlyFee();
        $startDate  = $orgStart;
        $currentDate = Carbon::now();

        // Total months between org-start and now (inclusive).
        $totalMonths = $startDate->diffInMonths($currentDate) + 1;

        // Years that have been paid in full via a single yearly payment.
        $yearsCoveredByYearly = $user->payments()
            ->where('status', 'approved')
            ->where('term', PaymentTerm::YEARLY)
            ->pluck('year')
            ->unique()
            ->toArray();

        // Count of monthly-term approved payments.
        $approvedMonthlyCount = $user->payments()
            ->where('status', 'approved')
            ->where('term', PaymentTerm::MONTHLY)
            ->count();

        // Months inside yearly-covered years that fall within the
        // org-start..current window — those are implicitly paid too.
        $yearlyCoveredMonths = 0;
        foreach ($yearsCoveredByYearly as $coveredYear) {
            $yearStart = Carbon::create((int) $coveredYear, 1, 1)->startOfMonth();
            $yearEnd   = Carbon::create((int) $coveredYear, 12, 1)->endOfMonth();

            $from = $yearStart->greaterThan($startDate) ? $yearStart : $startDate->copy()->startOfMonth();
            $to   = $yearEnd->lessThan($currentDate) ? $yearEnd : $currentDate->copy()->endOfMonth();

            if ($from->greaterThan($to)) {
                continue;
            }
            $yearlyCoveredMonths += $from->diffInMonths($to) + 1;
        }

        $paidMonths    = $approvedMonthlyCount + $yearlyCoveredMonths;
        $pendingMonths = $user->payments()
            ->where('status', 'pending')
            ->where('term', PaymentTerm::MONTHLY)
            ->count();

        $unpaidMonths = max(0, (int) $totalMonths - (int) $paidMonths);
        $totalDue     = (int) $unpaidMonths * (float) $monthlyFee;
        $totalPaid    = (int) $paidMonths * (float) $monthlyFee;
        $totalPending = (int) $pendingMonths * (float) $monthlyFee;

        $hasAnyDue           = $unpaidMonths > 0;
        $onlyCurrentMonthDue = $hasAnyDue && $unpaidMonths === 1 && $paidMonths === ($totalMonths - 1);
        $allCleared          = !$hasAnyDue;

        return [
            'term'                 => PaymentTerm::MONTHLY,
            'total_months'         => $totalMonths,
            'paid_months'          => $paidMonths,
            'unpaid_months'        => $unpaidMonths,
            'pending_months'       => $pendingMonths,
            'monthly_fee'          => $monthlyFee,
            'total_due'            => $totalDue,
            'total_paid'           => $totalPaid,
            'total_pending'        => $totalPending,
            'start_date'           => $startDate,
            'current_month'        => $currentDate->format('F'),
            'current_year'         => $currentDate->year,
            'has_due'              => $hasAnyDue,
            'only_current_month_due' => $onlyCurrentMonthDue,
            'all_cleared'          => $allCleared,
        ];
    }

    /**
     * Yearly dues calculation (smart monthly-equivalent coverage).
     *
     * Business rules:
     *  - Organization start year is partial: [start_month..12]
     *  - Every following year (including current year) expects [1..12]
     *  - If an approved yearly row exists for a year, that whole year is paid
     *  - If a pending yearly row exists for a year, that whole year is pending
     *  - Otherwise, monthly rows are counted month-by-month
     *
     * This keeps yearly members aligned with the user's expectation:
     * if 2026 has only Jan-Apr paid, then May-Dec remains due (8 months).
     */
    private function calculateYearlyDues(User $user): array
    {
        $orgStartYear  = (int) $this->settingsService->getOrganizationEstablishedYear();
        $orgStartMonth = (int) ($this->settingsService->get('organization_established_month', 1));
        if ($orgStartMonth < 1 || $orgStartMonth > 12) {
            $orgStartMonth = 1;
        }
        $now           = Carbon::now();
        $currentYear   = (int) $now->year;
        $monthlyFee    = $user->effectiveMonthlyFee();
        $yearlyFee     = $user->effectiveYearlyFee();

        // Approved yearly rows (fully covers that year).
        $paidYearsSet = array_flip(array_map('intval',
            $user->payments()
                ->where('status', 'approved')
                ->where('term', PaymentTerm::YEARLY)
                ->pluck('year')->unique()->values()->toArray()
        ));

        // Pending yearly rows (awaiting admin approval).
        $pendingYearsSet = array_flip(array_map('intval',
            $user->payments()
                ->where('status', 'pending')
                ->where('term', PaymentTerm::YEARLY)
                ->pluck('year')->unique()->values()->toArray()
        ));

        // Approved monthly rows grouped by year -> list of month-numbers.
        $monthlyApproved = $user->payments()
            ->where('status', 'approved')
            ->where('term', PaymentTerm::MONTHLY)
            ->get(['year', 'month']);
        // Pending monthly rows grouped by year -> list of month-numbers.
        $monthlyPending = $user->payments()
            ->where('status', 'pending')
            ->where('term', PaymentTerm::MONTHLY)
            ->get(['year', 'month']);

        $approvedMonthlyByYear = [];
        foreach ($monthlyApproved as $row) {
            $mNum = $this->englishMonthToNumber((string) $row->month);
            if ($mNum === null) {
                continue;
            }
            $approvedMonthlyByYear[(int) $row->year][$mNum] = true;
        }
        $pendingMonthlyByYear = [];
        foreach ($monthlyPending as $row) {
            $mNum = $this->englishMonthToNumber((string) $row->month);
            if ($mNum === null) {
                continue;
            }
            $pendingMonthlyByYear[(int) $row->year][$mNum] = true;
        }

        $paidYears    = 0;
        $pendingYears = 0;
        $unpaidYears  = [];
        $unpaidYearMonths = [];
        $totalMonths  = 0;
        $paidMonths   = 0;
        $pendingMonths = 0;
        $unpaidMonths  = 0;

        for ($y = $orgStartYear; $y <= $currentYear; $y++) {
            // Only org-start year is partial. Current year is treated as full-year.
            $winStart = ($y === $orgStartYear) ? $orgStartMonth : 1;
            $winEnd   = 12;
            if ($winStart > $winEnd) {
                continue;
            }
            $requiredMonths = $winEnd - $winStart + 1;
            $totalMonths += $requiredMonths;

            if (isset($paidYearsSet[$y])) {
                $paidYears++;
                $paidMonths += $requiredMonths;
                continue;
            }

            if (isset($pendingYearsSet[$y])) {
                $pendingYears++;
                $pendingMonths += $requiredMonths;
                continue;
            }

            $yearUnpaidMonths = 0;
            for ($m = $winStart; $m <= $winEnd; $m++) {
                if (isset($approvedMonthlyByYear[$y][$m])) {
                    $paidMonths++;
                    continue;
                }
                if (isset($pendingMonthlyByYear[$y][$m])) {
                    $pendingMonths++;
                    continue;
                }
                $unpaidMonths++;
                $yearUnpaidMonths++;
            }

            if ($yearUnpaidMonths > 0) {
                $unpaidYears[] = $y;
                $unpaidYearMonths[$y] = $yearUnpaidMonths;
            } else {
                // Fully covered by approved/pending monthly rows.
                $paidYears++;
            }
        }

        $unpaidYearsCount = count($unpaidYears);
        $totalDue      = $unpaidMonths * (float) $monthlyFee;
        $totalPaid     = $paidMonths * (float) $monthlyFee;
        $totalPending  = $pendingMonths * (float) $monthlyFee;

        $hasAnyDue  = $unpaidMonths > 0;
        $allCleared = !$hasAnyDue;

        return [
            'term'                 => PaymentTerm::YEARLY,
            // Keep monthly-shaped keys truly month-based for consistent UI.
            'total_months'         => $totalMonths,
            'paid_months'          => $paidMonths,
            'unpaid_months'        => $unpaidMonths,
            'pending_months'       => $pendingMonths,
            'monthly_fee'          => $monthlyFee,
            'total_due'            => $totalDue,
            'total_paid'           => $totalPaid,
            'total_pending'        => $totalPending,
            'start_date'           => Carbon::create($orgStartYear, $orgStartMonth, 1),
            'current_month'        => $now->format('F'),
            'current_year'         => $currentYear,
            'has_due'              => $hasAnyDue,
            'only_current_month_due' => false,
            'all_cleared'          => $allCleared,
            // Yearly-specific extras:
            'unpaid_years'         => $unpaidYears,
            'paid_years'           => $paidYears,
            'unpaid_years_count'   => $unpaidYearsCount,
            'yearly_fee'           => $yearlyFee,
            'unpaid_year_months'   => $unpaidYearMonths,
        ];
    }

    /**
     * Map an English month name ("January", "February", …) to 1..12.
     * Returns null for anything unrecognised.
     */
    private function englishMonthToNumber(string $name): ?int
    {
        static $map = [
            'January' => 1, 'February' => 2, 'March' => 3, 'April' => 4,
            'May' => 5, 'June' => 6, 'July' => 7, 'August' => 8,
            'September' => 9, 'October' => 10, 'November' => 11, 'December' => 12,
        ];
        return $map[$name] ?? null;
    }

    /**
     * Get list of unpaid months for a member.
     *
     * For yearly members returns one "virtual" entry per unpaid year.
     * For monthly members returns month-by-month unpaid entries.
     *
     * @param User $user The member to get unpaid months for
     * @return array Array of unpaid periods with month, year, amount
     */
    public function getUnpaidMonths(User $user): array
    {
        if ($user->effectivePaymentTerm() === PaymentTerm::YEARLY) {
            return $this->getUnpaidYears($user);
        }

        $orgStart   = Carbon::parse($this->settingsService->getOrganizationStartDate());
        $memberJoined = $user->joined_at ? Carbon::parse($user->joined_at) : Carbon::now();
        $startDate  = $orgStart->greaterThan($memberJoined) ? $orgStart : $memberJoined;
        $currentDate = Carbon::now();
        $monthlyFee = $user->effectiveMonthlyFee();

        $paidMonths = $user->payments()
            ->where('status', 'approved')
            ->where('term', PaymentTerm::MONTHLY)
            ->pluck('month', 'year')
            ->toArray();

        $yearsCoveredByYearly = $user->payments()
            ->where('status', 'approved')
            ->where('term', PaymentTerm::YEARLY)
            ->pluck('year')
            ->unique()
            ->toArray();

        $unpaidMonths = [];
        $date = $startDate->copy();

        while ($date->lessThanOrEqualTo($currentDate)) {
            $month = $date->format('F');
            $year  = $date->year;

            $isCoveredByMonthly = isset($paidMonths[$year]) && $paidMonths[$year] === $month;
            $isCoveredByYearly  = in_array($year, $yearsCoveredByYearly, true);

            if (!$isCoveredByMonthly && !$isCoveredByYearly) {
                $unpaidMonths[] = [
                    'month'    => $month,
                    'year'     => $year,
                    'month_bn' => $this->getMonthNameBn($month),
                    'amount'   => $monthlyFee,
                ];
            }

            $date->addMonth();
        }

        return $unpaidMonths;
    }

    /**
     * Yearly equivalent of getUnpaidMonths — one entry per unpaid year.
     */
    private function getUnpaidYears(User $user): array
    {
        $dues = $this->calculateYearlyDues($user);
        $monthlyFee = $user->effectiveMonthlyFee();

        $out = [];
        foreach ($dues['unpaid_years'] ?? [] as $year) {
            $missingMonths = (int) (($dues['unpaid_year_months'][$year] ?? 12));
            $out[] = [
                'year'     => (int) $year,
                'amount'   => $missingMonths * $monthlyFee,
                // Purely for backwards compatibility with callers that
                // expect these keys — a yearly "period" has no single month.
                'month'    => 'January',
                'month_bn' => (string) $year,
            ];
        }
        return $out;
    }

    /**
     * Approve a pending member.
     *
     * Sets status to active, generates membership ID and verification token.
     *
     * @param User $user The member to approve
     * @return bool True if approval was successful
     */
    public function approveMember(User $user): bool
    {
        if (!$user->membership_id) {
            $user->membership_id = $this->generateMembershipId();
        }

        $user->status = 'active';
        $user->joined_at = now();

        $saved = $user->save();

        // Generate a public verification token (used for the member's QR code).
        if ($saved) {
            $user->ensureVerificationToken();
        }

        return $saved;
    }

    /**
     * Reject a pending member.
     *
     * Sets status to inactive.
     *
     * @param User $user The member to reject
     * @return bool True if rejection was successful
     */
    public function rejectMember(User $user): bool
    {
        $user->status = 'inactive';
        return $user->save();
    }

    /**
     * Get Bangla month name.
     */
    private function getMonthNameBn(string $month): string
    {
        $months = [
            'January' => 'জানুয়ারি',
            'February' => 'ফেব্রুয়ারি',
            'March' => 'মার্চ',
            'April' => 'এপ্রিল',
            'May' => 'মে',
            'June' => 'জুন',
            'July' => 'জুলাই',
            'August' => 'আগস্ট',
            'September' => 'সেপ্টেম্বর',
            'October' => 'অক্টোবর',
            'November' => 'নভেম্বর',
            'December' => 'ডিসেম্বর',
        ];

        return $months[$month] ?? $month;
    }
}
