<?php

namespace App\Livewire\Admin;

use App\Models\BankDeposit;
use App\Services\SettingsService;
use Livewire\Component;
use Livewire\WithFileUploads;

class BankDepositForm extends Component
{
    use WithFileUploads;

    public $transactionType = 'deposit';
    public $month;
    public $year;
    public $amount;
    public $bankMessage;
    public $bankReceipt;
    public $notes;
    public $years = [];
    public $depositedMonths = []; // Array of already deposited month-year combinations
    public $isDuplicate = false;

    public $showForm = false;

    protected $rules = [
        'transactionType' => 'required|in:deposit,withdrawal,deduction,profit',
        'month' => 'required|integer|min:1|max:12',
        'year' => 'required|integer',
        'amount' => 'required|numeric|min:0.01',
        'bankMessage' => 'required|image|max:5120', // 5MB
        'bankReceipt' => 'nullable|image|max:5120',
        'notes' => 'nullable|string|max:1000',
    ];

    protected $messages = [
        'transactionType.required' => 'ট্রানজেকশন টাইপ নির্বাচন করুন',
        'month.required' => 'মাস নির্বাচন করুন',
        'year.required' => 'বছর নির্বাচন করুন',
        'amount.required' => 'টাকার পরিমাণ লিখুন',
        'amount.min' => 'টাকার পরিমাণ অবশ্যই ০ এর বেশি হতে হবে',
        'bankMessage.required' => 'ব্যাংক মেসেজ স্ক্রিনশট আপলোড করুন',
        'bankMessage.image' => 'ব্যাংক মেসেজ অবশ্যই ছবি হতে হবে',
        'bankMessage.max' => 'ব্যাংক মেসেজ সর্বোচ্চ 5MB হতে পারবে',
        'bankReceipt.image' => 'রশীদ অবশ্যই ছবি হতে হবে',
        'bankReceipt.max' => 'রশীদ সর্বোচ্চ 5MB হতে পারবে',
    ];

    public function mount()
    {
        // Generate years array from organization start to current
        $settingsService = app(SettingsService::class);
        $startYear = $settingsService->get('organization_established_year', now()->year);
        $currentYear = now()->year;
        $this->years = range($currentYear, $startYear);
        
        // Set defaults to current month and year
        $this->month = now()->month;
        $this->year = now()->year;
        
        // Load deposited months
        $this->loadDepositedMonths();
        
        // Don't check duplicate on mount - only when user changes selection
        $this->isDuplicate = false;
    }

    public function loadDepositedMonths()
    {
        // Get all deposited month-year combinations
        $deposits = BankDeposit::select('month', 'year')
            ->where('transaction_type', 'deposit')
            ->get()
            ->map(fn($d) => $d->year . '-' . $d->month)
            ->toArray();
        
        $this->depositedMonths = $deposits;
    }

    public function updated($propertyName)
    {
        // Check for duplicate when month, year, or transaction type changes
        if (in_array($propertyName, ['month', 'year', 'transactionType'])) {
            $this->checkDuplicate();
        }
    }

    public function checkDuplicate()
    {
        // Only check for duplicates if transaction type is deposit
        if ($this->transactionType !== 'deposit') {
            $this->isDuplicate = false;
            return;
        }
        
        $key = $this->year . '-' . $this->month;
        $this->isDuplicate = in_array($key, $this->depositedMonths);
    }

    public function toggleForm()
    {
        $this->showForm = !$this->showForm;
        
        if (!$this->showForm) {
            $this->resetForm();
        } else {
            // Check for duplicate when form opens (current month/year by default)
            $this->checkDuplicate();
        }
    }

    public function save()
    {
        $this->validate();

        // Check for duplicate month/year for deposits
        if ($this->transactionType === 'deposit') {
            $existingDeposit = BankDeposit::where('transaction_type', 'deposit')
                ->where('month', $this->month)
                ->where('year', $this->year)
                ->exists();
            
            if ($existingDeposit) {
                session()->flash('error', 'এই মাস (' . $this->month . '/' . $this->year . ') এর জন্য ইতিমধ্যে জমা এন্ট্রি করা হয়েছে। একই মাসে দুইবার জমা করা যাবে না।');
                return;
            }
        }

        // Check if withdrawal or deduction and verify sufficient balance
        if (in_array($this->transactionType, ['withdrawal', 'deduction'])) {
            $currentBalance = BankDeposit::getTotalBalance();
            if ($this->amount > $currentBalance) {
                session()->flash('error', 'অপর্যাপ্ত ব্যালেন্স! বর্তমান ব্যালেন্স: ৳' . number_format($currentBalance, 2));
                return;
            }
        }

        // Calculate balance after transaction
        $balanceAfter = BankDeposit::calculateBalanceAfter($this->amount, $this->transactionType);

        // Store bank message screenshot
        $bankMessagePath = $this->bankMessage->store('bank_deposits', 'public');

        // Store bank receipt if provided
        $bankReceiptPath = null;
        if ($this->bankReceipt) {
            $bankReceiptPath = $this->bankReceipt->store('bank_deposits', 'public');
        }

        // Create deposit record
        BankDeposit::create([
            'transaction_type' => $this->transactionType,
            'amount' => $this->amount,
            'balance_after' => $balanceAfter,
            'month' => $this->month,
            'year' => $this->year,
            'bank_message_screenshot' => $bankMessagePath,
            'bank_receipt' => $bankReceiptPath,
            'deposited_by' => auth()->id(),
            'notes' => $this->notes,
        ]);

        // Dispatch browser event for notification
        $messages = [
            'deposit' => 'ব্যাংক জমা সফলভাবে এন্ট্রি হয়েছে!',
            'withdrawal' => 'ব্যাংক উত্তোলন সফলভাবে এন্ট্রি হয়েছে!',
            'deduction' => 'ব্যাংক কর্তন সফলভাবে এন্ট্রি হয়েছে!',
            'profit' => 'ব্যাংক মুনাফা সফলভাবে এন্ট্রি হয়েছে!',
        ];
        $this->dispatch('notify', message: $messages[$this->transactionType])->to('member.bank-deposits');

        $this->resetForm();
        $this->showForm = false;
        
        // Reload deposited months for duplicate detection
        $this->loadDepositedMonths();

        // Emit event to refresh parent component
        $this->dispatch('depositAdded')->to('member.bank-deposits');
    }

    public function resetForm()
    {
        $this->reset(['amount', 'bankMessage', 'bankReceipt', 'notes']);
        $this->transactionType = 'deposit';
        $this->month = now()->month;
        $this->year = now()->year;
        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.admin.bank-deposit-form');
    }
}
