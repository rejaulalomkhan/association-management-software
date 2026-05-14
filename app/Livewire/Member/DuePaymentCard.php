<?php

namespace App\Livewire\Member;

use Livewire\Component;
use App\Models\Payment;
use App\Models\User;
use App\Services\SettingsService;
use App\Services\MemberService;
use Carbon\Carbon;

class DuePaymentCard extends Component
{
    // When null, the card targets the currently-authenticated user.
    // When set (e.g. by an admin viewing a member profile), it targets
    // the specified user so the card shows *their* dues, not the viewer's.
    public ?int $userId = null;

    public function render()
    {
        $memberService = app(MemberService::class);
        $user = $this->userId ? \App\Models\User::find($this->userId) : auth()->user();

        if (!$user) {
            return view('livewire.member.due-payment-card', [
                'totalMonths' => 0,
                'paidMonths' => 0,
                'dueMonths' => 0,
                'dueAmount' => 0,
                'monthlyFee' => 0,
                'hasDue' => false,
                'onlyCurrentMonthDue' => false,
                'allCleared' => true,
            ]);
        }

        $dues = $memberService->calculateOutstandingDues($user);

        $totalMonths = (int) $dues['total_months'];
        $paidMonths = (int) $dues['paid_months'];
        $dueMonths = (int) $dues['unpaid_months'];
        $dueAmount = (float) $dues['total_due'];
        $monthlyFee = (float) $dues['monthly_fee'];
        $hasDue = (bool) $dues['has_due'];
        $onlyCurrentMonthDue = (bool) $dues['only_current_month_due'];
        $allCleared = (bool) $dues['all_cleared'];

        return view('livewire.member.due-payment-card', [
            'totalMonths' => $totalMonths,
            'paidMonths' => $paidMonths,
            'dueMonths' => $dueMonths,
            'dueAmount' => $dueAmount,
            'monthlyFee' => $monthlyFee,
            'hasDue' => $hasDue,
            'onlyCurrentMonthDue' => $onlyCurrentMonthDue,
            'allCleared' => $allCleared,
            'targetUserId' => $this->userId,
        ]);
    }
}
