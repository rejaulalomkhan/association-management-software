<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use HasinHayder\Tyro\Models\Role;

class UserRoleAssignment extends Component
{
    use WithPagination;

    public $search = '';
    public $selectedUser = null;
    public $showModal = false;
    public $selectedRoles = [];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function openRoleModal($userId)
    {
        $user = User::with('roles')->findOrFail($userId);
        $this->selectedUser = $user;
        $this->selectedRoles = $user->roles->pluck('id')->toArray();
        $this->showModal = true;
    }

    public function saveRoles()
    {
        try {
            $this->selectedUser->roles()->sync($this->selectedRoles);
            session()->flash('success', 'রোল সফলভাবে আপডেট করা হয়েছে');
            $this->closeModal();
        } catch (\Exception $e) {
            session()->flash('error', 'একটি ত্রুটি ঘটেছে: ' . $e->getMessage());
        }
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->selectedUser = null;
        $this->selectedRoles = [];
    }

    public function render()
    {
        $query = User::with('roles');

        if ($this->search) {
            $query->where(function($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                  ->orWhere('email', 'like', '%' . $this->search . '%')
                  ->orWhere('phone', 'like', '%' . $this->search . '%')
                  ->orWhere('membership_id', 'like', '%' . $this->search . '%');
            });
        }

        $users = $query->orderBy('name')->paginate(15);
        $allRoles = Role::orderBy('name')->get();

        return view('livewire.admin.user-role-assignment', [
            'users' => $users,
            'allRoles' => $allRoles,
        ])->layout('layouts.app');
    }
}
