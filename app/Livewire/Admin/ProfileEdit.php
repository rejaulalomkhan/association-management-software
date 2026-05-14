<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ProfileEdit extends Component
{
    use WithFileUploads;

    public $memberId;
    public $user;

    public $name;
    public $email;
    public $phone;
    public $father_name;
    public $dob;
    public $permanent_address;
    public $present_address;
    public $same_address = false;
    public $profession;
    public $religion;
    public $nationality;
    public $position;
    public $blood_group;
    public $profile_pic;
    public $new_profile_pic;
    public $current_password;
    public $new_password;
    public $new_password_confirmation;

    public function mount($memberId = null)
    {
        $this->memberId = $memberId;

        // If memberId is provided and current user is admin, load that member.
        // Otherwise load the authenticated user.
        $currentUser = auth()->user();
        $roleSlugs   = collect($currentUser?->tyroRoleSlugs() ?? []);
        $isAdmin     = $roleSlugs->contains(fn ($s) => in_array($s, ['admin', 'super-admin']));

        if ($isAdmin && $this->memberId) {
            $this->user = \App\Models\User::findOrFail($this->memberId);
        } else {
            $this->user = $currentUser;
        }

        // Load all user data with null coalescing to handle missing fields
        $this->name = $this->user->name ?? '';
        $this->email = $this->user->email ?? '';
        $this->phone = $this->user->phone ?? '';
        $this->father_name = $this->user->father_name ?? '';
        $this->dob = $this->user->dob ?? '';
        $this->permanent_address = $this->user->permanent_address ?? '';
        $this->present_address = $this->user->present_address ?? '';
        $this->same_address = ($this->user->permanent_address && $this->user->permanent_address === $this->user->present_address);
        $this->profession = $this->user->profession ?? '';
        $this->religion = $this->user->religion ?? '';
        $this->nationality = $this->user->nationality ?? '';
        $this->position = $this->user->position ?? '';
        $this->blood_group = $this->user->blood_group ?? '';
        $this->profile_pic = $this->user->profile_pic ?? '';
    }

    public function updatedSameAddress($value)
    {
        if ($value) {
            $this->present_address = $this->permanent_address;
        }
    }

    public function updatedPermanentAddress($value)
    {
        if ($this->same_address) {
            $this->present_address = $value;
        }
    }

    public function updateProfile()
    {
        $userId = $this->user->id;

        $this->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($userId)],
            'phone' => ['required', 'string', 'max:20', Rule::unique('users')->ignore($userId)],
            'father_name' => 'nullable|string|max:255',
            'dob' => 'nullable|date',
            'permanent_address' => 'nullable|string|max:500',
            'present_address' => 'nullable|string|max:500',
            'profession' => 'nullable|string|max:255',
            'religion' => 'nullable|string|max:100',
            'nationality' => 'nullable|string|max:100',
            'position' => 'nullable|string|max:255',
            'blood_group' => 'nullable|string|max:10',
            'new_profile_pic' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:5120', // 5MB
        ]);

        // If same address is checked, copy permanent to present
        if ($this->same_address) {
            $this->present_address = $this->permanent_address;
        }

        $this->user->name = $this->name;
        $this->user->email = $this->email;
        $this->user->phone = $this->phone;
        $this->user->father_name = $this->father_name ?: null;
        $this->user->dob = $this->dob ?: null;
        $this->user->permanent_address = $this->permanent_address ?: null;
        $this->user->present_address = $this->present_address ?: null;
        $this->user->profession = $this->profession ?: null;
        $this->user->religion = $this->religion ?: null;
        $this->user->nationality = $this->nationality ?: null;
        $this->user->position = $this->position ?: null;
        $this->user->blood_group = $this->blood_group ?: null;

        // Handle profile picture upload
        if ($this->new_profile_pic) {
            try {
                // Delete old profile pic if exists
                if ($this->user->profile_pic && Storage::disk('public')->exists($this->user->profile_pic)) {
                    Storage::disk('public')->delete($this->user->profile_pic);
                }

                // Store new photo
                $path = $this->new_profile_pic->store('profile-pics', 'public');
                $this->user->profile_pic = $path;
                $this->profile_pic = $path;
            } catch (\Exception $e) {
                session()->flash('error', 'ছবি আপলোড করতে সমস্যা হয়েছে: ' . $e->getMessage());
                return;
            }
        }

        $this->user->save();

        session()->flash('success', 'প্রোফাইল সফলভাবে আপডেট করা হয়েছে।');
        $this->reset(['new_profile_pic']);
    }

    public function updatePassword()
    {
        $this->validate([
            'new_password' => 'required|min:8|confirmed',
        ]);

        $this->user->password = Hash::make($this->new_password);
        $this->user->save();

        session()->flash('password_message', 'পাসওয়ার্ড সফলভাবে পরিবর্তন করা হয়েছে।');
        $this->reset(['current_password', 'new_password', 'new_password_confirmation']);
    }

    public function render()
    {
        return view('livewire.admin.profile-edit', [
            'editingMember' => $this->user,
            'isEditingOther' => $this->memberId && $this->user->id !== auth()->id(),
        ])->layout('layouts.app');
    }
}

