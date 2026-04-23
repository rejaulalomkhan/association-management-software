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
            ->limit(20)
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

            // Members with an approved monthly payment for this month+year.
            $paidMonthlyIds = Payment::where('month', $month)
                ->where('year', $year)
                ->where('status', 'approved')
                ->where('term', \App\Enums\PaymentTerm::MONTHLY)
                ->pluck('user_id')
                ->toArray();

            // Build due list term-aware:
            //  - monthly term: unpaid for selected month+year if no approved monthly row
            //  - yearly term:  show if selected year appears in yearly dues window
            $unpaidMembers = $allActiveMembers
                ->map(function ($member) use ($memberService, $paidMonthlyIds, $year) {
                    $dues = $memberService->calculateOutstandingDues($member);
                    $term = $member->effectivePaymentTerm();

                    $isUnpaid = false;
                    if ($term === \App\Enums\PaymentTerm::YEARLY) {
                        $isUnpaid = in_array((int) $year, array_map('intval', $dues['unpaid_years'] ?? []), true);
                    } else {
                        $isUnpaid = !in_array((int) $member->id, $paidMonthlyIds, true);
                    }

                    if (!$isUnpaid) {
                        return null;
                    }

                    $member->due_months = (int) ($dues['unpaid_months'] ?? 0);
                    $member->due_amount = (float) ($dues['total_due'] ?? 0);
                    $member->due_term = $term;
                    return $member;
                })
                ->filter()
                ->take(20)
                ->values();
        }

        // Bank deposits stats
        $bankDepositsTotal = \App\Models\BankDeposit::sum('amount');
        $bankDepositsCount = \App\Models\BankDeposit::count();
        
        // Filtered bank deposits (for selected month/year)
        $bankDepositsFiltered = 0;
        if ($month && $year) {
            // Get month number from month name
            $monthNumber = date('n', strtotime($month));
            $bankDepositsFiltered = \App\Models\BankDeposit::where('year', $year)
                ->where('month', $monthNumber)
                ->sum('amount');
        } elseif ($year) {
            $bankDepositsFiltered = \App\Models\BankDeposit::where('year', $year)
                ->sum('amount');
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
            'bank_deposits_total' => $bankDepositsTotal,
            'bank_deposits_count' => $bankDepositsCount,
            'bank_deposits_filtered' => $bankDepositsFiltered,
            'total_documents' => \App\Models\Document::count(),
        ];

        return view('livewire.admin.dashboard', [
            'stats' => $stats,
            'paidMembers' => $paidMembers,
            'unpaidMembers' => $unpaidMembers,
            'summary' => $summary,
        ])->layout('layouts.app');
    }
}
