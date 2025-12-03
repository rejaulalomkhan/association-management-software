<?php

namespace App\Livewire\Admin;

use App\Models\User;
use App\Services\MemberService;
use Livewire\Component;
use Livewire\WithPagination;

class PendingRegistrations extends Component
{
    use WithPagination;

    public $selectedUser = null;
    public $showModal = false;
    public $rejectionReason = '';

    public function viewDetails($userId)
    {
        $this->selectedUser = User::with('roles')->find($userId);
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->selectedUser = null;
        $this->rejectionReason = '';
    }

    public function approveMember($userId, MemberService $memberService)
    {
        $user = User::find($userId);

        if ($user && $memberService->approveMember($user)) {
            session()->flash('success', 'সদস্য সফলভাবে অনুমোদিত হয়েছে! সদস্য নম্বর: ' . $user->membership_id);
            $this->closeModal();
        } else {
            session()->flash('error', 'সদস্য অনুমোদন করতে সমস্যা হয়েছে।');
        }
    }

    public function rejectMember($userId, MemberService $memberService)
    {
        $this->validate([
            'rejectionReason' => 'required|string|min:10',
        ], [
            'rejectionReason.required' => 'প্রত্যাখ্যানের কারণ লিখুন।',
            'rejectionReason.min' => 'ন্যূনতম ১০টি অক্ষর লিখুন।',
        ]);

        $user = User::find($userId);

        if ($user && $memberService->rejectMember($user)) {
            // TODO: Send notification with reason
            session()->flash('success', 'সদস্য প্রত্যাখ্যান করা হয়েছে।');
            $this->closeModal();
        } else {
            session()->flash('error', 'সদস্য প্রত্যাখ্যান করতে সমস্যা হয়েছে।');
        }
    }

    public function render()
    {
        $pendingUsers = User::where('status', 'pending')
            ->whereHas('roles', function($query) {
                $query->where('name', 'member');
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.admin.pending-registrations', [
            'pendingUsers' => $pendingUsers,
        ])->layout('layouts.app');
    }
}
