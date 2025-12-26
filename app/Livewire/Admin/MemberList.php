<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class MemberList extends Component
{
    use WithPagination;

    public $search = '';
    public $statusFilter = 'active';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $members = User::query()
            ->where('status', $this->statusFilter)
            ->whereHas('roles', function($query) {
                $query->where('name', 'member');
            })
            ->when($this->search, function($query) {
                $query->where(function($q) {
                    $q->where('name', 'like', '%' . $this->search . '%')
                      ->orWhere('phone', 'like', '%' . $this->search . '%')
                      ->orWhere('membership_id', 'like', '%' . $this->search . '%');
                });
            })
            ->orderBy('joined_at', 'desc')
            ->paginate(15);

        // Get total members count (all active members regardless of search/filter)
        $totalMembers = User::whereHas('roles', function($query) {
            $query->where('name', 'member');
        })->where('status', 'active')->count();

        return view('livewire.admin.member-list', [
            'members' => $members,
            'totalMembers' => $totalMembers,
        ])->layout('layouts.app');
    }
}
