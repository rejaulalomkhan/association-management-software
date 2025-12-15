<?php

namespace App\Livewire\Admin;

use App\Models\User;
use App\Models\Payment;
use App\Services\MemberService;
use Livewire\Component;
use Livewire\WithPagination;

class ViewMemberProfile extends Component
{
    use WithPagination;

    public $member;
    public $memberId;
    public $selectedYear;

    public function mount($memberId)
    {
        $this->memberId = $memberId;
        $this->member = User::with('payments')->findOrFail($memberId);
        
        // Ensure only members can be viewed
        if (!$this->member->hasRole('member')) {
            abort(403, 'This page is only for viewing member profiles.');
        }
        
        // Set default year to current year
        $this->selectedYear = date('Y');
    }

    public function updatedSelectedYear()
    {
        // This will automatically re-render when year changes
    }

    public function render()
    {
        $memberService = app(MemberService::class);

        $dues = $memberService->calculateOutstandingDues($this->member);

        $transactions = Payment::where('user_id', $this->member->id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        // Calculate total paid (approved payments only)
        $totalPaid = Payment::where('user_id', $this->member->id)
            ->where('status', 'approved')
            ->sum('amount');

        // Count approved months
        $paidMonths = Payment::where('user_id', $this->member->id)
            ->where('status', 'approved')
            ->count();

        // Use unified outstanding dues calculation for total due
        $totalDue = (float) $dues['total_due'];
        $dueMonths = (int) $dues['unpaid_months'];

        // Calculate pending payments
        $pendingAmount = Payment::where('user_id', $this->member->id)
            ->where('status', 'pending')
            ->sum('amount');

        // Count pending months
        $pendingMonths = Payment::where('user_id', $this->member->id)
            ->where('status', 'pending')
            ->count();

        // Calculate bank balance
        $bankBalance = Payment::where('user_id', $this->member->id)
            ->where('method', 'bank')
            ->where('status', 'approved')
            ->sum('amount');

        // Get available years for dropdown
        $years = Payment::where('user_id', $this->member->id)
            ->selectRaw('DISTINCT year')
            ->orderBy('year', 'desc')
            ->pluck('year')
            ->toArray();

        if (empty($years)) {
            $years = [date('Y')];
        }

        // Prepare monthly payment data for annual record
        $banglaMonths = [
            'জানুয়ারি', 'ফেব্রুয়ারি', 'মার্চ', 'এপ্রিল', 'মে', 'জুন',
            'জুলাই', 'আগস্ট', 'সেপ্টেম্বর', 'অক্টোবর', 'নভেম্বর', 'ডিসেম্বর'
        ];

        $monthMap = [
            'January' => 1, 'February' => 2, 'March' => 3, 'April' => 4,
            'May' => 5, 'June' => 6, 'July' => 7, 'August' => 8,
            'September' => 9, 'October' => 10, 'November' => 11, 'December' => 12,
        ];

        // Get payments for selected year using explicit year/month columns
        $yearlyPayments = Payment::where('user_id', $this->member->id)
            ->where('status', 'approved')
            ->when($this->selectedYear, function ($query) {
                $query->where('year', $this->selectedYear);
            })
            ->get()
            ->keyBy(function ($payment) use ($monthMap) {
                return $monthMap[$payment->month] ?? null; // 1-12
            });

        // Prepare monthly data
        $monthlyData = [];
        for ($i = 1; $i <= 12; $i++) {
            $payment = $yearlyPayments->get($i);
            $monthlyData[] = [
                'month' => $banglaMonths[$i - 1],
                'date' => $payment ? date('d-m-Y', strtotime($payment->created_at)) : '',
                'amount' => $payment ? number_format($payment->amount, 0) : '',
                'signature' => $payment ? $this->member->name : '', // Member's name, not admin's
            ];
        }

        return view('livewire.admin.view-member-profile', [
            'transactions' => $transactions,
            'totalPaid' => $totalPaid,
            'paidMonths' => $paidMonths,
            'totalDue' => $totalDue,
            'dueMonths' => $dueMonths,
            'pendingAmount' => $pendingAmount,
            'pendingMonths' => $pendingMonths,
            'bankBalance' => $bankBalance,
            'years' => $years,
            'monthlyData' => $monthlyData,
        ])->layout('layouts.app');
    }
}
