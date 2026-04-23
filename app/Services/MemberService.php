<?php

namespace App\Services;

use App\Enums\PaymentTerm;
use App\Models\User;
use Carbon\Carbon;

class MemberService
{
    public function __construct(
        private SettingsService $settingsService
    ) {}

    /**
     * Generate unique membership ID.
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
     * Yearly dues calculation.
     *
     * A year is considered paid when either:
     *   (a) an approved yearly-term payment exists for that year, or
     *   (b) all 12 months of that year have approved monthly-term payments
     *       (covers the "switched from monthly to yearly" case).
     */
    private function calculateYearlyDues(User $user): array
    {
        $orgStartYear  = (int) $this->settingsService->getOrganizationEstablishedYear();
        $currentYear   = (int) Carbon::now()->year;
        $yearlyFee     = $user->effectiveYearlyFee();

        $totalYears    = max(0, $currentYear - $orgStartYear + 1);

        // Already-paid yearly rows (approved).
        $paidYearRows = $user->payments()
            ->where('status', 'approved')
            ->where('term', PaymentTerm::YEARLY)
            ->pluck('year')
            ->unique()
            ->values()
            ->toArray();
        $paidYearsSet = array_flip(array_map('intval', $paidYearRows));

        // Years fully covered by 12 monthly payments.
        $monthlyByYear = $user->payments()
            ->where('status', 'approved')
            ->where('term', PaymentTerm::MONTHLY)
            ->selectRaw('year, COUNT(*) AS c')
            ->groupBy('year')
            ->pluck('c', 'year')
            ->toArray();

        $pendingYearRows = $user->payments()
            ->where('status', 'pending')
            ->where('term', PaymentTerm::YEARLY)
            ->pluck('year')
            ->unique()
            ->values()
            ->toArray();
        $pendingYearsSet = array_flip(array_map('intval', $pendingYearRows));

        $paidYears   = 0;
        $unpaidYears = [];
        $pendingYears = 0;

        for ($y = $orgStartYear; $y <= $currentYear; $y++) {
            $isPaid = isset($paidYearsSet[$y])
                || ((int) ($monthlyByYear[$y] ?? 0) >= 12);

            if ($isPaid) {
                $paidYears++;
                continue;
            }

            if (isset($pendingYearsSet[$y])) {
                $pendingYears++;
                continue;
            }

            $unpaidYears[] = $y;
        }

        $unpaidYearsCount = count($unpaidYears);
        $totalDue      = $unpaidYearsCount * $yearlyFee;
        $totalPaid     = $paidYears * $yearlyFee;
        $totalPending  = $pendingYears * $yearlyFee;

        $hasAnyDue  = $unpaidYearsCount > 0;
        $allCleared = !$hasAnyDue;

        return [
            'term'                 => PaymentTerm::YEARLY,
            // Monthly-shaped keys kept so existing UI (which reads
            // `unpaid_months`, `total_due`, etc.) keeps working —
            // "months" become "years" semantically for yearly members.
            'total_months'         => $totalYears,
            'paid_months'          => $paidYears,
            'unpaid_months'        => $unpaidYearsCount,
            'pending_months'       => $pendingYears,
            'monthly_fee'          => $yearlyFee,   // fee per period
            'total_due'            => $totalDue,
            'total_paid'           => $totalPaid,
            'total_pending'        => $totalPending,
            'start_date'           => Carbon::create($orgStartYear, 1, 1),
            'current_month'        => Carbon::now()->format('F'),
            'current_year'         => $currentYear,
            'has_due'              => $hasAnyDue,
            'only_current_month_due' => $hasAnyDue && $unpaidYearsCount === 1 && $paidYears === ($totalYears - 1),
            'all_cleared'          => $allCleared,
            // Yearly-specific extras:
            'unpaid_years'         => $unpaidYears,
            'paid_years'           => $paidYears,
            'unpaid_years_count'   => $unpaidYearsCount,
            'yearly_fee'           => $yearlyFee,
        ];
    }

    /**
     * Get list of unpaid months for a member.
     *
     * For yearly members we return one "virtual" entry per unpaid year
     * instead of iterating 12 months — the payment submission page
     * renders a year picker for yearly users anyway.
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
        $yearlyFee = $user->effectiveYearlyFee();

        $out = [];
        foreach ($dues['unpaid_years'] ?? [] as $year) {
            $out[] = [
                'year'     => (int) $year,
                'amount'   => $yearlyFee,
                // Purely for backwards compatibility with callers that
                // expect these keys — a yearly "period" has no single month.
                'month'    => 'January',
                'month_bn' => (string) $year,
            ];
        }
        return $out;
    }

    /**
     * Approve a member.
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
     * Reject a member.
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
