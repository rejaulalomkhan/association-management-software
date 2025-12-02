<?php

namespace App\Livewire\Member;

use Livewire\Component;

use Illuminate\Support\Facades\Auth;

class Dashboard extends Component
{
    public function render()
    {
        $user = Auth::user();
        $totalPaid = $user->getTotalPaidAmount();
        $recentPayments = $user->payments()->latest()->take(5)->get();

        return view('livewire.member.dashboard', [
            'user' => $user,
            'totalPaid' => $totalPaid,
            'recentPayments' => $recentPayments,
        ])->layout('layouts.app');
    }
}
