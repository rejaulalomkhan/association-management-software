<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use HasinHayder\Tyro\Models\Role;
use HasinHayder\Tyro\Models\Privilege;

class RoleManagement extends Component
{
    use WithPagination;

    public $name = '';
    public $slug = '';
    public $description = '';
    public $selectedRoleId = null;
    public $showModal = false;
    public $isEditing = false;
    public $search = '';

    // Privilege assignment
    public $selectedRoleForPrivileges = null;
    public $showPrivilegeModal = false;
    public $selectedPrivileges = [];

    protected $rules = [
        'name' => 'required|string|max:255',
        'slug' => 'required|string|max:255|regex:/^[a-z0-9-]+$/|unique:roles,slug',
        'description' => 'nullable|string|max:500',
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function openCreateModal()
    {
        $this->resetForm();
        $this->isEditing = false;
        $this->showModal = true;
    }

    public function openEditModal($roleId)
    {
        $role = Role::findOrFail($roleId);
        $this->selectedRoleId = $role->id;
        $this->name = $role->name;
        $this->slug = $role->slug;
        $this->description = $role->description ?? '';
        $this->isEditing = true;
        $this->showModal = true;
    }

    public function save()
    {
        if ($this->isEditing) {
            $this->rules['slug'] = 'required|string|max:255|regex:/^[a-z0-9-]+$/|unique:roles,slug,' . $this->selectedRoleId;
        }

        $this->validate();

        try {
            if ($this->isEditing) {
                $role = Role::findOrFail($this->selectedRoleId);
                $role->update([
                    'name' => $this->name,
                    'slug' => $this->slug,
                    'description' => $this->description,
                ]);
                session()->flash('success', 'রোল সফলভাবে আপডেট করা হয়েছে');
            } else {
                Role::create([
                    'name' => $this->name,
                    'slug' => $this->slug,
                    'description' => $this->description,
                ]);
                session()->flash('success', 'রোল সফলভাবে তৈরি করা হয়েছে');
            }

            $this->closeModal();
        } catch (\Exception $e) {
            session()->flash('error', 'একটি ত্রুটি ঘটেছে: ' . $e->getMessage());
        }
    }

    public function deleteRole($roleId)
    {
        try {
            $role = Role::findOrFail($roleId);

            // Check if role has users
            if ($role->users()->count() > 0) {
                session()->flash('error', 'এই রোলটি মুছে ফেলা যাবে না কারণ এটি ব্যবহারকারীদের সাথে সংযুক্ত আছে');
                return;
            }

            $role->delete();
            session()->flash('success', 'রোল সফলভাবে মুছে ফেলা হয়েছে');
        } catch (\Exception $e) {
            session()->flash('error', 'একটি ত্রুটি ঘটেছে: ' . $e->getMessage());
        }
    }

    public function openPrivilegeModal($roleId)
    {
        $role = Role::with('privileges')->findOrFail($roleId);
        $this->selectedRoleForPrivileges = $role;
        $this->selectedPrivileges = $role->privileges->pluck('id')->toArray();
        $this->showPrivilegeModal = true;
    }

    public function savePrivileges()
    {
        try {
            $this->selectedRoleForPrivileges->privileges()->sync($this->selectedPrivileges);
            session()->flash('success', 'প্রিভিলেজ সফলভাবে আপডেট করা হয়েছে');
            $this->closePrivilegeModal();
        } catch (\Exception $e) {
            session()->flash('error', 'একটি ত্রুটি ঘটেছে: ' . $e->getMessage());
        }
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->resetForm();
    }

    public function closePrivilegeModal()
    {
        $this->showPrivilegeModal = false;
        $this->selectedRoleForPrivileges = null;
        $this->selectedPrivileges = [];
    }

    private function resetForm()
    {
        $this->name = '';
        $this->slug = '';
        $this->description = '';
        $this->selectedRoleId = null;
        $this->resetErrorBag();
    }

    public function render()
    {
        $query = Role::withCount('users');

        if ($this->search) {
            $query->where(function($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                  ->orWhere('slug', 'like', '%' . $this->search . '%');
            });
        }

        $roles = $query->orderBy('name')->paginate(15);
        $allPrivileges = Privilege::orderBy('name')->get();

        return view('livewire.admin.role-management', [
            'roles' => $roles,
            'allPrivileges' => $allPrivileges,
        ])->layout('layouts.app');
    }
}
