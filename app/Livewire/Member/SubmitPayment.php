<?php

namespace App\Livewire\Member;

use Livewire\Component;

use Livewire\WithFileUploads;
use App\Models\Payment;
use App\Models\Setting;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class SubmitPayment extends Component
{
    use WithFileUploads;

    public $month;
    public $amount;
    public $method;
    public $transaction_id;
    public $screenshot;
    public $description;

    public $paymentMethods = [];

    public function mount()
    {
        $this->month = Carbon::now()->format('Y-m');
        $this->amount = Setting::get('monthly_fee', 500);
        
        $methodsJson = Setting::get('payment_methods');
        $this->paymentMethods = $methodsJson ? json_decode($methodsJson, true) : [
            ['type' => 'bKash', 'number' => '01700000000'],
            ['type' => 'Nagad', 'number' => '01700000000'],
        ];
        
        $this->method = $this->paymentMethods[0]['type'] ?? '';
    }

    protected $rules = [
        'month' => 'required|date_format:Y-m',
        'amount' => 'required|numeric|min:1',
        'method' => 'required|string',
        'transaction_id' => 'required|string|unique:payments,transaction_id',
        'screenshot' => 'nullable|image|max:2048',
        'description' => 'nullable|string|max:500',
    ];

    public function submit()
    {
        $this->validate();

        $screenshotPath = null;
        if ($this->screenshot) {
            $screenshotPath = $this->screenshot->store('payment-screenshots', 'public');
        }

        Payment::create([
            'user_id' => Auth::id(),
            'month_year' => Carbon::parse($this->month . '-01'),
            'amount' => $this->amount,
            'method' => $this->method,
            'transaction_id' => $this->transaction_id,
            'screenshot_path' => $screenshotPath,
            'description' => $this->description,
            'status' => 'pending',
            'submitted_at' => now(),
        ]);

        session()->flash('message', 'Payment submitted successfully! Waiting for approval.');
        $this->redirect(route('member.dashboard'), navigate: true);
    }

    public function render()
    {
        return view('livewire.member.submit-payment')->layout('layouts.app');
    }
}
