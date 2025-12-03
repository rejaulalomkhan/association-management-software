<?php

namespace App\Services;

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
     */
    public function calculateOutstandingDues(User $user): array
    {
        $orgStart = Carbon::parse($this->settingsService->getOrganizationStartDate());
        $memberJoined = $user->joined_at ? Carbon::parse($user->joined_at) : Carbon::now();
        $monthlyFee = $this->settingsService->getMonthlyFee();

        // Start from whichever is later: org start or member join
        $startDate = $orgStart->greaterThan($memberJoined) ? $orgStart : $memberJoined;
        $currentDate = Carbon::now();

        // Calculate total months
        $totalMonths = $startDate->diffInMonths($currentDate) + 1;

        // Get paid months
        $paidMonths = $user->payments()
            ->where('status', 'approved')
            ->count();

        // Get pending months
        $pendingMonths = $user->payments()
            ->where('status', 'pending')
            ->count();

        // Calculate dues
        $unpaidMonths = $totalMonths - $paidMonths;
        $totalDue = $unpaidMonths * $monthlyFee;
        $totalPaid = $paidMonths * $monthlyFee;
        $totalPending = $pendingMonths * $monthlyFee;

        return [
            'total_months' => $totalMonths,
            'paid_months' => $paidMonths,
            'unpaid_months' => $unpaidMonths,
            'pending_months' => $pendingMonths,
            'monthly_fee' => $monthlyFee,
            'total_due' => $totalDue,
            'total_paid' => $totalPaid,
            'total_pending' => $totalPending,
            'start_date' => $startDate,
            'current_month' => $currentDate->format('F'),
            'current_year' => $currentDate->year,
        ];
    }

    /**
     * Get list of unpaid months for a member.
     */
    public function getUnpaidMonths(User $user): array
    {
        $orgStart = Carbon::parse($this->settingsService->getOrganizationStartDate());
        $memberJoined = $user->joined_at ? Carbon::parse($user->joined_at) : Carbon::now();
        $startDate = $orgStart->greaterThan($memberJoined) ? $orgStart : $memberJoined;
        $currentDate = Carbon::now();

        // Get all paid month-year combinations
        $paidMonths = $user->payments()
            ->where('status', 'approved')
            ->pluck('month', 'year')
            ->toArray();

        $unpaidMonths = [];
        $date = $startDate->copy();

        while ($date->lessThanOrEqualTo($currentDate)) {
            $month = $date->format('F');
            $year = $date->year;

            // Check if this month is not paid
            if (!isset($paidMonths[$year]) || $paidMonths[$year] !== $month) {
                $unpaidMonths[] = [
                    'month' => $month,
                    'year' => $year,
                    'month_bn' => $this->getMonthNameBn($month),
                    'amount' => $this->settingsService->getMonthlyFee(),
                ];
            }

            $date->addMonth();
        }

        return $unpaidMonths;
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

        return $user->save();
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
