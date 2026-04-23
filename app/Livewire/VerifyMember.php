<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

/**
 * Public membership verification page.
 *
 * Rendered when a person scans a member's QR code, which opens
 * /verify/{token}. This page is intentionally accessible without
 * authentication so verifiers (police, banks, shops, etc.) can
 * confirm the membership on the spot.
 */
class VerifyMember extends Component
{
    public ?User $member = null;
    public string $status = 'unknown'; // unknown | active | inactive | not_found

    public function mount(string $token): void
    {
        // Token must look like the ones we issue (32-char hex); short-circuit otherwise.
        if (!preg_match('/^[a-f0-9]{32}$/i', $token)) {
            $this->status = 'not_found';
            return;
        }

        $user = User::where('verification_token', $token)
            ->whereHas('roles', function ($q) {
                $q->where('slug', 'member');
            })
            ->first();

        if (!$user) {
            $this->status = 'not_found';
            return;
        }

        $this->member = $user;
        $this->status = $user->status === 'active' ? 'active' : 'inactive';
    }

    public function render()
    {
        return view('livewire.verify-member')->layout('layouts.guest');
    }
}
