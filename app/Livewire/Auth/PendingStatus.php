<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Livewire\Component;

class PendingStatus extends Component
{
    public $user;
    public $phone;

    public function mount($phone = null)
    {
        // If phone is provided in URL, use it
        if ($phone) {
            $this->phone = $phone;
            $this->user = User::where('phone', $phone)
                ->where('status', 'pending')
                ->first();
        }

        // If no user found, redirect to login
        if (!$this->user) {
            return redirect()->route('tyro-login.login');
        }
    }

    public function render()
    {
        return view('livewire.auth.pending-status')->layout('layouts.guest');
    }
}
