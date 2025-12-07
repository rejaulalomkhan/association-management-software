<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\User;
use App\Models\Payment;
use App\Services\TransactionService;
use App\Services\MemberService;
use Carbon\Carbon;

class Dashboard extends Component
{
    public $selectedMonth;
    public $selectedYear;

    public function mount()
    {
        $this->selectedMonth = Carbon::now()->format('F');
        $this->selectedYear = Carbon::now()->year;
    }

    public function render(TransactionService $transactionService, MemberService $memberService)
    {
        $year = $this->selectedYear ? (int) $this->selectedYear : null;
        $month = $this->selectedMonth ?: null; // Ensure empty string becomes null

        $summary = $transactionService->getStatsSummary($month, $year);

        // Get paid members based on filters
        $paidMembersQuery = Payment::with(['user', 'paymentMethod'])
            ->where('status', 'approved');

        if ($month) {
            $paidMembersQuery->where('month', $month);
        }
        if ($year) {
            $paidMembersQuery->where('year', $year);
        }

        $paidMembers = $paidMembersQuery->orderBy('processed_at', 'desc')
            ->limit(10)
            ->get();

        // Get unpaid members logic
        // Only show unpaid members list if specific month AND year are selected
        // Otherwise it's ambiguous who is "unpaid" for "All time" in this context
        $unpaidMembers = collect();
        
        if ($month && $year) {
            $allActiveMembers = User::where('status', 'active')
                ->whereHas('roles', function($q) {
                    $q->where('name', 'member');
                })
                ->get();

            // Get IDs of members who have APPROVED payments for this specific month/year
            $paidMemberIds = Payment::where('month', $month)
                ->where('year', $year)
                ->where('status', 'approved')
                ->pluck('user_id')
                ->toArray();

            $unpaidMembers = $allActiveMembers->whereNotIn('id', $paidMemberIds)->take(10);

            // Attach due info for unpaid members
            $unpaidMembers = $unpaidMembers->map(function ($member) use ($memberService) {
                $dues = $memberService->calculateOutstandingDues($member);
                $member->due_months = $dues['unpaid_months'];
                $member->due_amount = $dues['total_due'];
                return $member;
            });
        }

        $stats = [
            'total_members' => User::where('status', 'active')
                ->whereHas('roles', function($q) {
                    $q->where('name', 'member');
                })->count(),
            'pending_registrations' => User::where('status', 'pending')
                ->whereHas('roles', function($q) {
                    $q->where('name', 'member');
                })->count(),
            'total_paid' => $summary['total_paid'],
            'paid_count' => $summary['paid_count'],
            'unpaid_count' => $summary['unpaid_count'],
            'pending_count' => $summary['pending_count'],
            'collection_rate' => $summary['collection_rate'],
            'lifetime_collection' => Payment::where('status', 'approved')->sum('amount'),
        ];

        return view('livewire.admin.dashboard', [
            'stats' => $stats,
            'paidMembers' => $paidMembers,
            'unpaidMembers' => $unpaidMembers,
            'summary' => $summary,
        ])->layout('layouts.app');
    }
}
