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
        $summary = $transactionService->getMonthlySummary($this->selectedMonth, $this->selectedYear);

        // Get paid members for selected month
        $paidMembers = Payment::with(['user', 'paymentMethod'])
            ->where('month', $this->selectedMonth)
            ->where('year', $this->selectedYear)
            ->where('status', 'approved')
            ->orderBy('processed_at', 'desc')
            ->limit(10)
            ->get();

        // Get unpaid members for selected month
        $allActiveMembers = User::where('status', 'active')
            ->whereHas('roles', function($q) {
                $q->where('name', 'member');
            })
            ->get();

        $paidMemberIds = $paidMembers->pluck('user_id')->toArray();
        $unpaidMembers = $allActiveMembers->whereNotIn('id', $paidMemberIds)->take(10);

        // Attach due info for unpaid members
        $unpaidMembers = $unpaidMembers->map(function ($member) use ($memberService) {
            $dues = $memberService->calculateOutstandingDues($member);
            $member->due_months = $dues['unpaid_months'];
            $member->due_amount = $dues['total_due'];
            return $member;
        });

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
        ];

        return view('livewire.admin.dashboard', [
            'stats' => $stats,
            'paidMembers' => $paidMembers,
            'unpaidMembers' => $unpaidMembers,
            'summary' => $summary,
        ])->layout('layouts.app');
    }
}
