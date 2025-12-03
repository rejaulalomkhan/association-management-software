<?php

namespace App\Livewire\Member;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Payment;
use App\Models\PaymentMethod;
use App\Services\SettingsService;
use App\Services\MemberService;
use App\Services\TransactionService;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class SubmitPayment extends Component
{
    use WithFileUploads;

    public $selectedMonth;
    public $selectedYear;
    public $amount;
    public $payment_method_id;
    public $proof;
    public $description;

    public $unpaidMonths = [];
    public $paymentMethods = [];
    public $monthlyFee;

    public function mount(MemberService $memberService, SettingsService $settingsService)
    {
        $this->monthlyFee = $settingsService->getMonthlyFee();
        $this->amount = $this->monthlyFee;
        $this->unpaidMonths = $memberService->getUnpaidMonths(Auth::user());
        $this->paymentMethods = PaymentMethod::active()->get();

        // Pre-select current month if unpaid
        $currentMonth = Carbon::now()->format('F');
        $currentYear = Carbon::now()->year;

        foreach ($this->unpaidMonths as $month) {
            if ($month['month'] === $currentMonth && $month['year'] === $currentYear) {
                $this->selectedMonth = $currentMonth;
                $this->selectedYear = $currentYear;
                break;
            }
        }
    }

    protected function rules()
    {
        return [
            'selectedMonth' => 'required|string',
            'selectedYear' => 'required|integer',
            'amount' => 'required|numeric|min:1',
            'payment_method_id' => 'required|exists:payment_methods,id',
            'proof' => 'nullable|image|max:2048',
            'description' => 'nullable|string|max:500',
        ];
    }

    public function selectMonth($month, $year)
    {
        $this->selectedMonth = $month;
        $this->selectedYear = $year;
        $this->amount = $this->monthlyFee;
    }

    public function submit(TransactionService $transactionService)
    {
        $this->validate();

        // Check if payment already exists for this month
        $exists = Payment::where('user_id', Auth::id())
            ->where('month', $this->selectedMonth)
            ->where('year', $this->selectedYear)
            ->exists();

        if ($exists) {
            session()->flash('error', 'এই মাসের জন্য ইতিমধ্যে একটি পেমেন্ট জমা দেওয়া হয়েছে।');
            return;
        }

        $data = [
            'month' => $this->selectedMonth,
            'year' => $this->selectedYear,
            'amount' => $this->amount,
            'payment_method_id' => $this->payment_method_id,
            'method' => PaymentMethod::find($this->payment_method_id)->name,
            'description' => $this->description,
        ];

        if ($this->proof) {
            $data['proof_path'] = $this->proof->store('payment-proofs', 'public');
        }

        $transactionService->createPayment(Auth::user(), $data);

        session()->flash('success', 'পেমেন্ট সফলভাবে জমা দেওয়া হয়েছে! অনুমোদনের জন্য অপেক্ষা করুন।');

        return redirect()->route('member.history');
    }

    public function render()
    {
        return view('livewire.member.submit-payment')->layout('layouts.app');
    }
}
