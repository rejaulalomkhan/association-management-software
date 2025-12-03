<?php

namespace App\Livewire\Member;

use Livewire\Component;
use App\Services\MemberService;
use App\Services\SettingsService;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class Dashboard extends Component
{
    public function render(MemberService $memberService, SettingsService $settingsService)
    {
        $user = Auth::user();

        // Calculate dues
        $duesInfo = $memberService->calculateOutstandingDues($user);

        // Get recent payments
        $recentPayments = $user->payments()
            ->with('paymentMethod')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Check if current month is paid
        $currentMonth = Carbon::now()->format('F');
        $currentYear = Carbon::now()->year;

        $currentMonthPaid = $user->payments()
            ->where('month', $currentMonth)
            ->where('year', $currentYear)
            ->whereIn('status', ['approved', 'pending'])
            ->exists();

        return view('livewire.member.dashboard', [
            'user' => $user,
            'duesInfo' => $duesInfo,
            'recentPayments' => $recentPayments,
            'currentMonthPaid' => $currentMonthPaid,
            'currentMonth' => $currentMonth,
            'currentYear' => $currentYear,
        ])->layout('layouts.app');
    }
}
