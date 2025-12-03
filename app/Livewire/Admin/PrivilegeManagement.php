<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use HasinHayder\Tyro\Models\Privilege;

class PrivilegeManagement extends Component
{
    use WithPagination;

    public $name = '';
    public $slug = '';
    public $description = '';
    public $selectedPrivilegeId = null;
    public $showModal = false;
    public $isEditing = false;
    public $search = '';

    protected $rules = [
        'name' => 'required|string|max:255',
        'slug' => 'required|string|max:255|regex:/^[a-z0-9.-]+$/|unique:privileges,slug',
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

    public function openEditModal($privilegeId)
    {
        $privilege = Privilege::findOrFail($privilegeId);
        $this->selectedPrivilegeId = $privilege->id;
        $this->name = $privilege->name;
        $this->slug = $privilege->slug;
        $this->description = $privilege->description ?? '';
        $this->isEditing = true;
        $this->showModal = true;
    }

    public function save()
    {
        if ($this->isEditing) {
            $this->rules['slug'] = 'required|string|max:255|regex:/^[a-z0-9.-]+$/|unique:privileges,slug,' . $this->selectedPrivilegeId;
        }

        $this->validate();

        try {
            if ($this->isEditing) {
                $privilege = Privilege::findOrFail($this->selectedPrivilegeId);
                $privilege->update([
                    'name' => $this->name,
                    'slug' => $this->slug,
                    'description' => $this->description,
                ]);
                session()->flash('success', 'প্রিভিলেজ সফলভাবে আপডেট করা হয়েছে');
            } else {
                Privilege::create([
                    'name' => $this->name,
                    'slug' => $this->slug,
                    'description' => $this->description,
                ]);
                session()->flash('success', 'প্রিভিলেজ সফলভাবে তৈরি করা হয়েছে');
            }

            $this->closeModal();
        } catch (\Exception $e) {
            session()->flash('error', 'একটি ত্রুটি ঘটেছে: ' . $e->getMessage());
        }
    }

    public function deletePrivilege($privilegeId)
    {
        try {
            $privilege = Privilege::findOrFail($privilegeId);
            $privilege->delete();
            session()->flash('success', 'প্রিভিলেজ সফলভাবে মুছে ফেলা হয়েছে');
        } catch (\Exception $e) {
            session()->flash('error', 'একটি ত্রুটি ঘটেছে: ' . $e->getMessage());
        }
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->resetForm();
    }

    private function resetForm()
    {
        $this->name = '';
        $this->slug = '';
        $this->description = '';
        $this->selectedPrivilegeId = null;
        $this->resetErrorBag();
    }

    public function render()
    {
        $query = Privilege::query();

        if ($this->search) {
            $query->where(function($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                  ->orWhere('slug', 'like', '%' . $this->search . '%');
            });
        }

        $privileges = $query->orderBy('name')->paginate(15);

        return view('livewire.admin.privilege-management', [
            'privileges' => $privileges,
        ])->layout('layouts.app');
    }
}
