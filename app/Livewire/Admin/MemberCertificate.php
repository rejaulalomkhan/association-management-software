<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\User;

class MemberCertificate extends Component
{
    public $member;
    public $memberId;

    public function mount($memberId)
    {
        $this->memberId = $memberId;
        $this->member = User::with('payments')->findOrFail($memberId);
        
        // Ensure member is active
        if ($this->member->status !== 'active') {
            abort(403, 'This certificate is only available for active members.');
        }
    }

    public function render()
    {
        return view('livewire.admin.member-certificate')
            ->layout('layouts.guest'); // Use guest layout for clean print view
    }
}
