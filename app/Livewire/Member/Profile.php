<?php

namespace App\Livewire\Member;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\Models\Payment;
use App\Models\PaymentMethod;
use App\Services\SettingsService;
use App\Services\MemberService;

class Profile extends Component
{
    use WithFileUploads;
    use WithPagination;

    public $name;
    public $email;
    public $phone;
    public $address;
    public $photo;
    public $current_password;
    public $new_password;
    public $new_password_confirmation;
    public $showEditModal = false;
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
        $this->showEditModal = false;
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

    public function getTotalOverdueInfo()
    {
        $settingsService = app(SettingsService::class);
        $establishedYear = (int) $settingsService->get('organization_established_year', 2024);
        $establishedMonth = (int) $settingsService->get('organization_established_month', 1);
        $monthlyFee = (float) $settingsService->get('monthly_fee', 500);
        $currentYear = (int) date('Y');
        $currentMonth = (int) date('n');

        // Calculate total months from establishment to previous month
        $establishmentDate = \Carbon\Carbon::create($establishedYear, $establishedMonth, 1);
        $lastMonthDate = \Carbon\Carbon::now()->subMonth()->endOfMonth();
        $totalMonthsShouldPay = $establishmentDate->diffInMonths($lastMonthDate) + 1;

        // Count paid months
        $paidMonths = Payment::where('user_id', auth()->id())
            ->where('status', 'approved')
            ->where('created_at', '<', \Carbon\Carbon::now()->startOfMonth())
            ->count();

        $overdueMonths = max(0, $totalMonthsShouldPay - $paidMonths);
        $overdueAmount = $overdueMonths * $monthlyFee;

        return [
            'months' => $overdueMonths,
            'amount' => $overdueAmount
        ];
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

    public function downloadReceipt($paymentId)
    {
        $payment = Payment::with(['paymentMethod'])->where('user_id', auth()->id())->findOrFail($paymentId);

        if ($payment->status !== 'approved') {
            session()->flash('message', 'শুধু অনুমোদিত পেমেন্টের রিসিপ্ট ডাউনলোড করা যাবে।');
            return;
        }

        // Configure mPDF with Bangla font support
        $defaultConfig = (new \Mpdf\Config\ConfigVariables())->getDefaults();
        $fontDirs = $defaultConfig['fontDir'];

        $defaultFontConfig = (new \Mpdf\Config\FontVariables())->getDefaults();
        $fontData = $defaultFontConfig['fontdata'];

        $path = public_path() . "/fonts";
        
        $mpdf = new \Mpdf\Mpdf([
            'format' => 'A4',
            'orientation' => 'P',
            'fontDir' => array_merge($fontDirs, [$path]),
            'fontdata' => $fontData + [
                'solaimanlipi' => [
                    'R' => 'SolaimanLipi.ttf',
                    'useOTL' => 0xFF,
                ],
            ],
            'default_font' => 'solaimanlipi'
        ]);

        $html = view('pdf.payment-receipt', ['payment' => $payment])->render();
        $mpdf->WriteHTML($html);

        $fileName = 'receipt-' . ($payment->transaction_id ?: ($payment->id)) . '.pdf';

        return response()->streamDownload(function () use ($mpdf) {
            echo $mpdf->Output('', 'S');
        }, $fileName);
    }

    public function render()
    {
        $memberService = app(MemberService::class);
        $user = auth()->user();

        $dues = $memberService->calculateOutstandingDues($user);

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

        // Use unified outstanding dues calculation for total due
        $totalDue = (float) $dues['total_due'];
        $dueMonths = (int) $dues['unpaid_months'];

        // Calculate pending payments
        $pendingAmount = Payment::where('user_id', auth()->id())
            ->where('status', 'pending')
            ->sum('amount');

        // Count pending months
        $pendingMonths = Payment::where('user_id', auth()->id())
            ->where('status', 'pending')
            ->count();

        // Get bank balance
        $bankBalance = \App\Models\BankDeposit::getTotalBalance();

        // Get organization established year from settings
        $settingsService = app(SettingsService::class);
        $establishedYear = (int) $settingsService->get('organization_established_year', 2024);
        $currentYear = (int) date('Y');

        // Generate years array from established year to current year (descending for latest first)
        $years = range($currentYear, $establishedYear);

        // Bengali month names
        $banglaMonths = [
            'জানুয়ারি', 'ফেব্রুয়ারি', 'মার্চ', 'এপ্রিল', 'মে', 'জুন',
            'জুলাই', 'আগস্ট', 'সেপ্টেম্বর', 'অক্টোবর', 'নভেম্বর', 'ডিসেম্বর'
        ];

        // Map English month names stored in payments table to month numbers
        $monthMap = [
            'January' => 1, 'February' => 2, 'March' => 3, 'April' => 4,
            'May' => 5, 'June' => 6, 'July' => 7, 'August' => 8,
            'September' => 9, 'October' => 10, 'November' => 11, 'December' => 12,
        ];

        // Get payments for selected year using explicit year/month columns
        $yearlyPayments = Payment::where('user_id', auth()->id())
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
            'bankBalance' => $bankBalance,
            'years' => $years,
            'monthlyData' => $monthlyData,
        ])->layout('layouts.app');
    }
}
