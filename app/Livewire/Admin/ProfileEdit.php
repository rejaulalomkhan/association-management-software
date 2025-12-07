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

    public function mount()
    {
        $user = auth()->user();
        
        // Load all user data with null coalescing to handle missing fields
        $this->name = $user->name ?? '';
        $this->email = $user->email ?? '';
        $this->phone = $user->phone ?? '';
        $this->father_name = $user->father_name ?? '';
        $this->dob = $user->dob ?? '';
        $this->permanent_address = $user->permanent_address ?? '';
        $this->present_address = $user->present_address ?? '';
        $this->same_address = ($user->permanent_address && $user->permanent_address === $user->present_address);
        $this->profession = $user->profession ?? '';
        $this->religion = $user->religion ?? '';
        $this->nationality = $user->nationality ?? '';
        $this->position = $user->position ?? '';
        $this->blood_group = $user->blood_group ?? '';
        $this->profile_pic = $user->profile_pic ?? '';
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
        $userId = auth()->id();

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

        $user = auth()->user();
        
        // If same address is checked, copy permanent to present
        if ($this->same_address) {
            $this->present_address = $this->permanent_address;
        }

        $user->name = $this->name;
        $user->email = $this->email;
        $user->phone = $this->phone;
        $user->father_name = $this->father_name;
        $user->dob = $this->dob;
        $user->permanent_address = $this->permanent_address;
        $user->present_address = $this->present_address;
        $user->profession = $this->profession;
        $user->religion = $this->religion;
        $user->nationality = $this->nationality;
        $user->position = $this->position;
        $user->blood_group = $this->blood_group;

        // Handle profile picture upload
        if ($this->new_profile_pic) {
            try {
                // Delete old profile pic if exists
                if ($user->profile_pic && Storage::disk('public')->exists($user->profile_pic)) {
                    Storage::disk('public')->delete($user->profile_pic);
                }

                // Store new photo
                $path = $this->new_profile_pic->store('profile-pics', 'public');
                $user->profile_pic = $path;
                $this->profile_pic = $path;
            } catch (\Exception $e) {
                session()->flash('error', 'ছবি আপলোড করতে সমস্যা হয়েছে: ' . $e->getMessage());
                return;
            }
        }

        $user->save();

        session()->flash('success', 'প্রোফাইল সফলভাবে আপডেট করা হয়েছে।');
        $this->reset(['new_profile_pic']);
    }

    public function updatePassword()
    {
        $this->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        $user = auth()->user();

        if (!Hash::check($this->current_password, $user->password)) {
            $this->addError('current_password', 'বর্তমান পাসওয়ার্ড সঠিক নয়।');
            return;
        }

        $user->password = Hash::make($this->new_password);
        $user->save();

        session()->flash('password_message', 'পাসওয়ার্ড সফলভাবে পরিবর্তন করা হয়েছে।');
        $this->reset(['current_password', 'new_password', 'new_password_confirmation']);
    }

    public function render()
    {
        return view('livewire.admin.profile-edit')->layout('layouts.app');
    }
}

