<?php

namespace App\Livewire\Member;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class EditProfile extends Component
{
    use WithFileUploads;

    public $name;
    public $email;
    public $phone;
    public $father_name;
    public $dob;
    public $permanent_address;
    public $present_address;
    public $blood_group;
    public $profession;
    public $religion;
    public $nationality;
    public $position;
    public $profile_pic;
    public $new_profile_pic;
    public $current_password;
    public $new_password;
    public $new_password_confirmation;
    public $same_address = false;

    public function mount()
    {
        $user = Auth::user();
        $this->name = $user->name;
        $this->email = $user->email;
        $this->phone = $user->phone;
        $this->father_name = $user->father_name;
        $this->dob = $user->dob;
        $this->permanent_address = $user->permanent_address;
        $this->present_address = $user->present_address;
        $this->blood_group = $user->blood_group;
        $this->profession = $user->profession;
        $this->religion = $user->religion;
        $this->nationality = $user->nationality;
        $this->position = $user->position;
        $this->profile_pic = $user->profile_pic;

        // Check if addresses are the same
        if ($user->permanent_address && $user->permanent_address === $user->present_address) {
            $this->same_address = true;
        }
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

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('users')->ignore(Auth::id())],
            'phone' => ['required', 'string', Rule::unique('users')->ignore(Auth::id())],
            'father_name' => 'nullable|string|max:255',
            'dob' => 'nullable|date',
            'permanent_address' => 'nullable|string|max:500',
            'present_address' => 'nullable|string|max:500',
            'blood_group' => 'nullable|string|max:10',
            'profession' => 'nullable|string|max:255',
            'religion' => 'nullable|string|max:50',
            'nationality' => 'nullable|string|max:50',
            'position' => 'nullable|string|max:255',
            'new_profile_pic' => 'nullable|image|max:2048',
            'current_password' => 'nullable|required_with:new_password|current_password',
            'new_password' => 'nullable|min:8|confirmed',
        ];
    }

    public function updateProfile()
    {
        $this->validate();

        $user = Auth::user();

        // If same address is checked, copy permanent to present
        if ($this->same_address) {
            $this->present_address = $this->permanent_address;
        }

        $data = [
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'father_name' => $this->father_name,
            'dob' => $this->dob,
            'permanent_address' => $this->permanent_address,
            'present_address' => $this->present_address,
            'blood_group' => $this->blood_group,
            'profession' => $this->profession,
            'religion' => $this->religion,
            'nationality' => $this->nationality,
            'position' => $this->position,
        ];

        // Handle profile picture upload
        if ($this->new_profile_pic) {
            // Delete old profile pic if exists
            if ($user->profile_pic && Storage::disk('public')->exists($user->profile_pic)) {
                Storage::disk('public')->delete($user->profile_pic);
            }

            $path = $this->new_profile_pic->store('profile-pics', 'public');
            $data['profile_pic'] = $path;
            $this->profile_pic = $path;
            $this->new_profile_pic = null;
        }

        // Handle password change
        if ($this->new_password) {
            $data['password'] = bcrypt($this->new_password);
            $this->current_password = '';
            $this->new_password = '';
            $this->new_password_confirmation = '';
        }

        $user->update($data);

        session()->flash('success', 'Profile updated successfully!');
        $this->dispatch('profile-updated');
    }

    public function render()
    {
        return view('livewire.member.edit-profile')->layout('layouts.app');
    }
}
