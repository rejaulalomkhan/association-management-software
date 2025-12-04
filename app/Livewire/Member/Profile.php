<?php

namespace App\Livewire\Member;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\Models\Payment;
use App\Services\SettingsService;

class Profile extends Component
{
    use WithFileUploads;

    public $name;
    public $email;
    public $phone;
    public $address;
    public $photo;
    public $current_password;
    public $new_password;
    public $new_password_confirmation;
    public $showPasswordModal = false;
    public $selectedYear;

    public function mount()
    {
        $user = auth()->user();
        $this->name = $user->name;
        $this->email = $user->email;
        $this->phone = $user->phone;
        $this->address = $user->address;

        // Set default year to current year
        $this->selectedYear = date('Y');
    }

    public function updatedSelectedYear()
    {
        // This will automatically re-render when year changes
    }

    public function loadProfileData()
    {
        $user = auth()->user();
        $this->name = $user->name;
        $this->email = $user->email;
        $this->phone = $user->phone;
        $this->address = $user->address;
    }

    public function updateBasicInfo()
    {
        $userId = auth()->id();

        \Log::info('Profile update started', [
            'user_id' => $userId,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
        ]);

        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255|unique:users,email,' . $userId . ',id',
            'phone' => 'required|string|max:20|unique:users,phone,' . $userId . ',id',
            'address' => 'nullable|string|max:500',
            'photo' => 'nullable|image|max:2048',
        ]);

        $user = auth()->user();
        $user->name = $this->name;
        $user->email = $this->email;
        $user->phone = $this->phone;
        $user->address = $this->address;

        if ($this->photo) {
            if ($user->photo) {
                Storage::disk('public')->delete($user->photo);
            }
            $user->photo = $this->photo->store('photos', 'public');
        }

        $user->save();

        \Log::info('Profile updated successfully', ['user_id' => $userId]);

        session()->flash('message', 'প্রোফাইল সফলভাবে আপডেট করা হয়েছে।');
        $this->reset(['photo']);
        $this->mount();

        // Close modal using Alpine.js
        $this->dispatch('close-modal');
    }

    public function openPasswordModal()
    {
        $this->showPasswordModal = true;
        $this->reset(['current_password', 'new_password', 'new_password_confirmation']);
    }

    public function closePasswordModal()
    {
        $this->showPasswordModal = false;
        $this->reset(['current_password', 'new_password', 'new_password_confirmation']);
    }

    public function updatePassword()
    {
        $this->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        $user = auth()->user();

        if (!Hash::check($this->current_password, $user->password)) {
            $this->addError('current_password', 'বর্তমান পাসওয়ার্ড সঠিক নয়।');
            return;
        }

        $user->password = Hash::make($this->new_password);
        $user->save();

        session()->flash('password_message', 'পাসওয়ার্ড সফলভাবে পরিবর্তন করা হয়েছে।');
        $this->closePasswordModal();
    }

    public function render()
    {
        $transactions = Payment::where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        // Calculate total paid (approved payments only)
        $totalPaid = Payment::where('user_id', auth()->id())
            ->where('status', 'approved')
            ->sum('amount');

        // Count approved months
        $paidMonths = Payment::where('user_id', auth()->id())
            ->where('status', 'approved')
            ->count();

        // Calculate total due (rejected only, as they are actual dues)
        $totalDue = Payment::where('user_id', auth()->id())
            ->where('status', 'rejected')
            ->sum('amount');

        // Count rejected months
        $dueMonths = Payment::where('user_id', auth()->id())
            ->where('status', 'rejected')
            ->count();

        // Calculate pending payments
        $pendingAmount = Payment::where('user_id', auth()->id())
            ->where('status', 'pending')
            ->sum('amount');

        // Count pending months
        $pendingMonths = Payment::where('user_id', auth()->id())
            ->where('status', 'pending')
            ->count();

        // Get organization established year from settings
        $settingsService = app(SettingsService::class);
        $establishedYear = $settingsService->get('organization_established_year', 2024);
        $currentYear = date('Y');

        // Generate years array from established year to current year
        $years = range($currentYear, $establishedYear);

        // Bengali month names
        $banglaMonths = [
            'জানুয়ারি', 'ফেব্রুয়ারি', 'মার্চ', 'এপ্রিল', 'মে', 'জুন',
            'জুলাই', 'আগস্ট', 'সেপ্টেম্বর', 'অক্টোবর', 'নভেম্বর', 'ডিসেম্বর'
        ];

        // Get payments for selected year
        $yearlyPayments = Payment::where('user_id', auth()->id())
            ->where('status', 'approved')
            ->whereYear('created_at', $this->selectedYear)
            ->get()
            ->keyBy(function($payment) {
                return date('n', strtotime($payment->created_at)); // 1-12
            });

        // Prepare monthly data
        $monthlyData = [];
        for ($i = 1; $i <= 12; $i++) {
            $payment = $yearlyPayments->get($i);
            $monthlyData[] = [
                'month' => $banglaMonths[$i - 1],
                'date' => $payment ? date('d-m-Y', strtotime($payment->created_at)) : '',
                'amount' => $payment ? number_format($payment->amount, 0) : '',
                'signature' => $payment ? auth()->user()->name : '',
            ];
        }

        return view('livewire.member.profile', [
            'transactions' => $transactions,
            'totalPaid' => $totalPaid,
            'paidMonths' => $paidMonths,
            'totalDue' => $totalDue,
            'dueMonths' => $dueMonths,
            'pendingAmount' => $pendingAmount,
            'pendingMonths' => $pendingMonths,
            'years' => $years,
            'monthlyData' => $monthlyData,
        ])->layout('layouts.app');
    }
}
