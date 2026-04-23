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

    // Custom-fee editor state (only admins render this).
    public bool $editingFee = false;
    public ?string $customFeeInput = null;

    // Payment-term editor state.
    // '' means "use organization-wide default (inherit)".
    public bool $editingTerm = false;
    public string $customTermInput = '';

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

        $this->customFeeInput = $this->member->monthly_fee !== null
            ? (string) (int) $this->member->monthly_fee
            : null;

        $this->customTermInput = \App\Enums\PaymentTerm::coerce((string) $this->member->payment_term) ?? '';
    }

    public function updatedSelectedYear()
    {
        // This will automatically re-render when year changes
    }

    /**
     * Guard: only admins can mutate a member's fee override.
     */
    private function assertAdmin(): void
    {
        $user = auth()->user();
        $slugs = collect($user?->tyroRoleSlugs() ?? []);
        $isAdmin = $slugs->contains(fn ($s) => in_array($s, ['admin', 'super-admin']));
        abort_unless($isAdmin, 403, 'এই অপারেশনটি শুধুমাত্র এডমিনের জন্য।');
    }

    public function startEditFee(): void
    {
        $this->assertAdmin();
        $this->editingFee = true;
    }

    public function cancelEditFee(): void
    {
        $this->editingFee = false;
        $this->customFeeInput = $this->member->monthly_fee !== null
            ? (string) (int) $this->member->monthly_fee
            : null;
    }

    public function saveCustomFee(): void
    {
        $this->assertAdmin();

        $this->validate([
            'customFeeInput' => 'nullable|numeric|min:0|max:9999999',
        ], [
            'customFeeInput.numeric' => 'ফি অবশ্যই একটি সংখ্যা হতে হবে।',
            'customFeeInput.min'     => 'ফি ০ এর কম হতে পারবেনা।',
        ]);

        $value = $this->customFeeInput;
        // Treat blank or 0 as "use settings default" → store NULL so the
        // helper falls back to organization-wide monthly_fee.
        if ($value === null || $value === '' || (float) $value <= 0) {
            $this->member->monthly_fee = null;
        } else {
            $this->member->monthly_fee = (float) $value;
        }

        $this->member->save();
        $this->member->refresh();

        $this->customFeeInput = $this->member->monthly_fee !== null
            ? (string) (int) $this->member->monthly_fee
            : null;

        $this->editingFee = false;
        session()->flash('message', 'কাস্টম মাসিক ফি সংরক্ষণ করা হয়েছে।');
    }

    public function resetCustomFee(): void
    {
        $this->assertAdmin();
        $this->member->monthly_fee = null;
        $this->member->save();
        $this->member->refresh();
        $this->customFeeInput = null;
        $this->editingFee = false;
        session()->flash('message', 'ডিফল্ট মাসিক ফি পুনরায় চালু করা হয়েছে।');
    }

    public function startEditTerm(): void
    {
        $this->assertAdmin();
        $this->editingTerm = true;
    }

    public function cancelEditTerm(): void
    {
        $this->editingTerm = false;
        $this->customTermInput = \App\Enums\PaymentTerm::coerce((string) $this->member->payment_term) ?? '';
    }

    public function saveCustomTerm(): void
    {
        $this->assertAdmin();

        $this->validate([
            'customTermInput' => 'nullable|in:,' . implode(',', \App\Enums\PaymentTerm::all()),
        ], [
            'customTermInput.in' => 'অবৈধ পেমেন্ট টার্ম।',
        ]);

        $coerced = \App\Enums\PaymentTerm::coerce($this->customTermInput);
        $this->member->payment_term = $coerced; // null → inherit from settings
        $this->member->save();
        $this->member->refresh();

        $this->customTermInput = $coerced ?? '';
        $this->editingTerm = false;
        session()->flash('message', 'পেমেন্ট টার্ম সংরক্ষণ করা হয়েছে।');
    }

    public function resetCustomTerm(): void
    {
        $this->assertAdmin();
        $this->member->payment_term = null;
        $this->member->save();
        $this->member->refresh();
        $this->customTermInput = '';
        $this->editingTerm = false;
        session()->flash('message', 'ডিফল্ট পেমেন্ট টার্ম পুনরায় চালু করা হয়েছে।');
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

        $effectiveFee   = $this->member->effectiveMonthlyFee();
        $defaultFee     = app(\App\Services\SettingsService::class)->getMonthlyFee();
        $hasCustomFee   = $this->member->hasCustomMonthlyFee();
        $effectiveTerm  = $this->member->effectivePaymentTerm();
        $defaultTerm    = app(\App\Services\SettingsService::class)->getPaymentTerm();
        $hasCustomTerm  = $this->member->hasCustomPaymentTerm();
        $effectivePeriodFee = $this->member->effectiveTermFee();

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
            'effectiveFee' => $effectiveFee,
            'defaultFee' => $defaultFee,
            'hasCustomFee' => $hasCustomFee,
            'effectiveTerm' => $effectiveTerm,
            'defaultTerm' => $defaultTerm,
            'hasCustomTerm' => $hasCustomTerm,
            'effectivePeriodFee' => $effectivePeriodFee,
        ])->layout('layouts.app');
    }
}
