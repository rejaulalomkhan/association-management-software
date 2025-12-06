<?php

namespace App\Livewire\Member;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Payment;
use App\Models\PaymentMethod;
use App\Models\User;
use App\Services\SettingsService;

class SubmitPayment extends Component
{
    use WithFileUploads;
    public $selectedUserId;
    public $availableUsers = [];

    public $payment_type = 'current';
    public $paymentYear;
    public $selectedMonths = [];
    public $payment_amount = 0;
    public $payment_method_id;
    public $payment_reference;
    public $payment_note;
    public $isTypeChanging = false;
    public $payment_proof;
    public $isCurrentMonthAlreadyPaid = false;

    private function getEnglishMonthName(int $monthNum): ?string
    {
        $englishMonths = [
            1 => 'January', 2 => 'February', 3 => 'March', 4 => 'April',
            5 => 'May', 6 => 'June', 7 => 'July', 8 => 'August',
            9 => 'September', 10 => 'October', 11 => 'November', 12 => 'December'
        ];

        return $englishMonths[$monthNum] ?? null;
    }

    private function getMonthNumberFromEnglishName(string $name): ?int
    {
        $map = [
            'January' => 1, 'February' => 2, 'March' => 3, 'April' => 4,
            'May' => 5, 'June' => 6, 'July' => 7, 'August' => 8,
            'September' => 9, 'October' => 10, 'November' => 11, 'December' => 12,
        ];

        return $map[$name] ?? null;
    }

    public function mount()
    {
        // Check if user is authenticated
        if (!auth()->check()) {
            return redirect()->route('tyro-login.login');
        }

        $currentUser = auth()->user();

        // Determine if current user is admin or accountant
        $roleSlugs = collect($currentUser->tyroRoleSlugs() ?? []);
        $isAdminOrAccountant = $roleSlugs->contains(fn ($slug) => in_array($slug, ['admin', 'super-admin', 'accountant']));

        if ($isAdminOrAccountant) {
            // Admin / Accountant can select any active user
            $this->availableUsers = User::orderBy('name')->get(['id', 'name', 'membership_id']);
            $this->selectedUserId = $currentUser->id; // default to self
        } else {
            // Normal member can only submit for themselves
            $this->availableUsers = [$currentUser];
            $this->selectedUserId = $currentUser->id;
        }

        $this->payment_type = 'current';
        $this->paymentYear = date('Y');

        // Auto-select current month for current payment type
        $currentMonth = (int)date('n');
        $this->selectedMonths = [$currentMonth];

        $this->refreshCurrentMonthPaidFlag();

        $this->updatePaymentAmount();
    }

    private function refreshCurrentMonthPaidFlag(): void
    {
        $currentMonth = (int) date('n');
        $currentYear = (int) date('Y');

        $this->isCurrentMonthAlreadyPaid = Payment::where('user_id', $this->selectedUserId)
            ->where('status', 'approved')
            ->where('year', $currentYear)
            ->where('month', $this->getEnglishMonthName($currentMonth))
            ->exists();
    }

    public function updatedPaymentType()
    {
        $this->isTypeChanging = true;

        // Reset selections when payment type changes
        $this->selectedMonths = [];
        $this->payment_amount = 0;

        if ($this->payment_type === 'current') {
            // Auto-select current month if it is unpaid
            $currentMonth = (int) date('n');
            $currentYear = (int) date('Y');

            $alreadyPaid = Payment::where('user_id', $this->selectedUserId)
                ->where('status', 'approved')
                ->where('year', $currentYear)
                ->where('month', $this->getEnglishMonthName($currentMonth))
                ->exists();

            $this->paymentYear = $currentYear;

            if (!$alreadyPaid) {
                $this->selectedMonths = [$currentMonth];
            }

            $this->isCurrentMonthAlreadyPaid = $alreadyPaid;
        } elseif ($this->payment_type === 'overdue') {
            // Oldest year where there is at least one unpaid month
            $oldestYear = $this->getOldestOverdueYear();
            $this->paymentYear = $oldestYear ?? (int) date('Y');

            $this->selectedMonths = $this->getUnpaidMonthsForYear($this->paymentYear);
        } elseif ($this->payment_type === 'advance') {
            // For advance, start from current year and show future unpaid months
            $this->paymentYear = (int) date('Y');
            $this->selectedMonths = $this->getUnpaidMonthsForYear($this->paymentYear);
        }

        $this->updatePaymentAmount();
        $this->dispatch('payment-type-changed');

        $this->isTypeChanging = false;
    }

    public function updatedPaymentYear()
    {
        $this->selectedMonths = [];
        $this->updatePaymentAmount();
    }

    public function updatedSelectedMonths()
    {
        $this->updatePaymentAmount();
    }

    public function updatedSelectedUserId()
    {
        // When changing member, recompute whether current month is already paid
        $this->refreshCurrentMonthPaidFlag();

        // Reset type/year/months to sensible defaults for the newly selected user
        if ($this->payment_type === 'current') {
            $currentMonth = (int) date('n');
            $this->paymentYear = (int) date('Y');

            $this->selectedMonths = $this->isCurrentMonthAlreadyPaid ? [] : [$currentMonth];
        } else {
            $this->selectedMonths = [];
        }

        $this->updatePaymentAmount();
    }

    public function getUnpaidMonthsForYear($year)
    {
        $settingsService = app(SettingsService::class);
        $establishedYear = (int) $settingsService->get('organization_established_year', 2024);
        $establishedMonth = (int) $settingsService->get('organization_established_month', 1);

        // Paid months based on month/year columns to avoid double payments
        $paidMonths = Payment::where('user_id', $this->selectedUserId)
            ->where('status', 'approved')
            ->where('year', $year)
            ->pluck('month')
            ->map(function ($monthName) {
                return $this->getMonthNumberFromEnglishName($monthName);
            })
            ->filter()
            ->unique()
            ->values()
            ->toArray();

        $currentYear = (int) date('Y');
        $currentMonth = (int) date('n');
        $unpaidMonths = [];

        if ($this->payment_type === 'current') {
            if ($year == $currentYear && !in_array($currentMonth, $paidMonths)) {
                $unpaidMonths = [$currentMonth];
            }
        } elseif ($this->payment_type === 'overdue') {
            if ($year == $establishedYear) {
                $startMonth = $establishedMonth;
                $endMonth = ($year == $currentYear) ? $currentMonth - 1 : 12;
            } elseif ($year < $currentYear && $year >= $establishedYear) {
                $startMonth = 1;
                $endMonth = 12;
            } elseif ($year == $currentYear) {
                $startMonth = 1;
                $endMonth = $currentMonth - 1;
            } else {
                return [];
            }

            for ($m = $startMonth; $m <= $endMonth; $m++) {
                if (!in_array($m, $paidMonths)) {
                    $unpaidMonths[] = $m;
                }
            }
        } elseif ($this->payment_type === 'advance') {
            if ($year == $currentYear) {
                $startMonth = $currentMonth + 1;
                $endMonth = 12;

                for ($m = $startMonth; $m <= $endMonth; $m++) {
                    if (!in_array($m, $paidMonths)) {
                        $unpaidMonths[] = $m;
                    }
                }
            } elseif ($year == $currentYear + 1) {
                for ($m = 1; $m <= 12; $m++) {
                    if (!in_array($m, $paidMonths)) {
                        $unpaidMonths[] = $m;
                    }
                }
            }
        }

        return $unpaidMonths;
    }

    private function getOldestOverdueYear()
    {
        $settingsService = app(SettingsService::class);
        $establishedYear = (int) $settingsService->get('organization_established_year', 2024);

        for ($year = $establishedYear; $year < date('Y'); $year++) {
            $unpaidCount = $this->getUnpaidMonthsCountForYear($year);
            if ($unpaidCount > 0) {
                return $year;
            }
        }

        return date('Y');
    }

    private function getUnpaidMonthsCountForYear($year)
    {
        $paidMonths = Payment::where('user_id', $this->selectedUserId)
            ->where('status', 'approved')
            ->where('year', $year)
            ->count();

        $currentYear = (int) date('Y');
        $totalMonths = ($year < $currentYear) ? 12 : (int) date('n');

        return max(0, $totalMonths - $paidMonths);
    }

    public function getTotalOverdueInfo()
    {
        $settingsService = app(SettingsService::class);
        $establishedYear = (int) $settingsService->get('organization_established_year', 2024);
        $establishedMonth = (int) $settingsService->get('organization_established_month', 1);
        $monthlyFee = (float) $settingsService->get('monthly_fee', 500);

        $establishmentDate = \Carbon\Carbon::create($establishedYear, $establishedMonth, 1);
        $lastMonthDate = \Carbon\Carbon::now()->subMonth()->endOfMonth();
        $totalMonthsShouldPay = $establishmentDate->diffInMonths($lastMonthDate) + 1;

        $paidMonths = Payment::where('user_id', $this->selectedUserId)
            ->where('status', 'approved')
            ->whereYear('created_at', '>=', $establishedYear)
            ->count();

        $overdueMonths = max(0, $totalMonthsShouldPay - $paidMonths);
        $overdueAmount = $overdueMonths * $monthlyFee;

        return [
            'months' => (int) round($overdueMonths),
            'amount' => $overdueAmount
        ];
    }

    private function updatePaymentAmount()
    {
        $settingsService = app(SettingsService::class);
        $monthlyFee = (float) $settingsService->get('monthly_fee', 500);
        $this->payment_amount = count($this->selectedMonths) * $monthlyFee;
    }

    public function submitPayment()
    {
        // Prevent submitting payment for current month if already paid
        if ($this->payment_type === 'current') {
            $currentMonth = (int) date('n');
            $currentYear = (int) date('Y');

            $alreadyPaid = Payment::where('user_id', $this->selectedUserId)
                ->where('status', 'approved')
                ->where('year', $currentYear)
                ->where('month', $this->getEnglishMonthName($currentMonth))
                ->exists();

            if ($alreadyPaid) {
                $this->addError('selectedMonths', 'এই মাসের পেমেন্ট আগে থেকেই পরিশোধিত হয়েছে।');
                return;
            }
        }

        $this->validate([
            'selectedUserId' => 'required|exists:users,id',
            'payment_amount' => 'required|numeric|min:1',
            'payment_method_id' => 'required|exists:payment_methods,id',
            'selectedMonths' => 'required|array|min:1',
            'payment_reference' => 'nullable|string|max:255',
            'payment_note' => 'nullable|string|max:500',
            'payment_proof' => 'nullable|image|max:2048',
        ], [
            'selectedUserId.required' => 'কোন সদস্যের জন্য পেমেন্ট দিচ্ছেন তা নির্বাচন করুন।',
            'selectedUserId.exists' => 'নির্বাচিত সদস্যটি সিস্টেমে পাওয়া যায়নি।',
            'payment_amount.required' => 'পেমেন্ট এর পরিমাণ প্রয়োজন।',
            'payment_amount.min' => 'কমপক্ষে এক মাসের পেমেন্ট নির্বাচন করুন।',
            'payment_method_id.required' => 'পেমেন্ট মাধ্যম নির্বাচন করুন।',
            'payment_method_id.exists' => 'নির্বাচিত পেমেন্ট মাধ্যমটি সিস্টেমে পাওয়া যায়নি।',
            'selectedMonths.required' => 'কমপক্ষে একটি মাস নির্বাচন করুন।',
            'selectedMonths.min' => 'কমপক্ষে একটি মাস নির্বাচন করুন।',
            'payment_reference.max' => 'রেফারেন্স নাম্বার সর্বোচ্চ ২৫৫ অক্ষরের হতে পারবে।',
            'payment_note.max' => 'নোট সর্বোচ্চ ৫০০ অক্ষরের হতে পারবে।',
            'payment_proof.image' => 'স্ক্রিনশট বা ছবি ফরম্যাট ভুল হয়েছে।',
            'payment_proof.max' => 'স্ক্রিনশট সর্বোচ্চ ২ এমবি হতে পারবে।',
        ]);

        // যদি ট্রানজেকশন আইডি দেওয়া থাকে এবং শুধু এক মাস নির্বাচন করা হয়,
        // সেক্ষেত্রে আগের রেকর্ড আছে কিনা চেক করি। একসাথে একাধিক মাসের জন্য
        // একই ট্রানজেকশন আইডি ব্যবহার করা যাবে।
        if ($this->payment_reference && count($this->selectedMonths) === 1) {
            $txExists = Payment::where('transaction_id', $this->payment_reference)->exists();
            if ($txExists) {
                $this->addError('payment_reference', 'এই ট্রানজেকশন আইডি আগে থেকেই ব্যবহার হয়েছে।');
                return;
            }
        }

        $settingsService = app(SettingsService::class);
        $monthlyFee = (float) $settingsService->get('monthly_fee', 500);

        $proofPath = null;
        if ($this->payment_proof) {
            $proofPath = $this->payment_proof->store('payment_proofs', 'public');
        }

        foreach ($this->selectedMonths as $monthNum) {
            $monthName = $this->getEnglishMonthName((int) $monthNum);
            if (!$monthName) {
                continue;
            }

            // Prevent duplicate submission for same user + month + year
            $alreadyExists = Payment::where('user_id', $this->selectedUserId)
                ->where('year', (int) $this->paymentYear)
                ->where('month', $monthName)
                ->whereIn('status', ['pending', 'approved'])
                ->exists();

            if ($alreadyExists) {
                continue;
            }

            Payment::create([
                'user_id' => $this->selectedUserId,
                'month' => $monthName,
                'year' => (int) $this->paymentYear,
                'amount' => $monthlyFee,
                'method' => optional(PaymentMethod::find($this->payment_method_id))->name ?? 'manual',
                'payment_method_id' => $this->payment_method_id,
                'description' => $this->payment_note,
                'transaction_id' => $this->payment_reference,
                'proof_path' => $proofPath,
                'status' => 'pending',
            ]);
        }

        session()->flash('success', 'পেমেন্ট সফলভাবে জমা দেওয়া হয়েছে! অনুমোদনের জন্য অপেক্ষা করুন।');

        return redirect()->route('member.profile');
    }

    public function render()
    {
        $settingsService = app(SettingsService::class);
        $currentYear = (int) date('Y');
        $establishedYear = $settingsService->get('organization_established_year', 2024);

        // Generate available years based on payment type
        if ($this->payment_type === 'advance') {
            $paymentYears = range($currentYear, $currentYear + 1);
        } else {
            $paymentYears = range($currentYear, $establishedYear);
        }

        $paymentMethods = PaymentMethod::active()->get();
        $monthlyFee = (float) $settingsService->get('monthly_fee', 500);

        $banglaMonthNames = [
            1 => 'জানুয়ারি', 2 => 'ফেব্রুয়ারি', 3 => 'মার্চ', 4 => 'এপ্রিল',
            5 => 'মে', 6 => 'জুন', 7 => 'জুলাই', 8 => 'আগস্ট',
            9 => 'সেপ্টেম্বর', 10 => 'অক্টোবর', 11 => 'নভেম্বর', 12 => 'ডিসেম্বর'
        ];

        $overdueInfo = $this->getTotalOverdueInfo();

        $currentUser = auth()->user();
        $roleSlugs = collect($currentUser->tyroRoleSlugs() ?? []);
        $isAdminOrAccountant = $roleSlugs->contains(fn ($slug) => in_array($slug, ['admin', 'super-admin', 'accountant']));

        return view('livewire.member.submit-payment', [
            'availableUsers' => $this->availableUsers,
            'isAdminOrAccountant' => $isAdminOrAccountant,
            'paymentMethods' => $paymentMethods,
            'paymentYears' => $paymentYears,
            'monthlyFee' => $monthlyFee,
            'banglaMonthNames' => $banglaMonthNames,
            'overdueInfo' => $overdueInfo,
        ])->layout('layouts.app');
    }
}

