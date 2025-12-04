<?php

namespace App\Livewire\Member;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class ProfileEdit extends Component
{
    use WithFileUploads;

    public $name;
    public $email;
    public $phone;
    public $permanent_address;
    public $present_address;
    public $same_address = false;
    public $profession;
    public $religion;
    public $nationality;
    public $position;
    public $blood_group;
    public $photo;
    public $current_password;
    public $new_password;
    public $new_password_confirmation;
    public $showPasswordSection = false;

    public function mount()
    {
        $user = auth()->user();
        $this->name = $user->name;
        $this->email = $user->email;
        $this->phone = $user->phone;
        $this->permanent_address = $user->permanent_address;
        $this->present_address = $user->present_address;
        $this->same_address = ($user->permanent_address === $user->present_address);
        $this->profession = $user->profession;
        $this->religion = $user->religion;
        $this->nationality = $user->nationality;
        $this->position = $user->position;
        $this->blood_group = $user->blood_group;
    }

    public function updatedSameAddress($value)
    {
        if ($value) {
            $this->present_address = $this->permanent_address;
        }
    }

    public function updateProfile()
    {
        $userId = auth()->id();

        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255|unique:users,email,' . $userId . ',id',
            'phone' => 'required|string|max:20|unique:users,phone,' . $userId . ',id',
            'permanent_address' => 'nullable|string|max:500',
            'present_address' => 'nullable|string|max:500',
            'profession' => 'nullable|string|max:255',
            'religion' => 'nullable|string|max:100',
            'nationality' => 'nullable|string|max:100',
            'position' => 'nullable|string|max:255',
            'blood_group' => 'nullable|string|max:10',
            'photo' => 'nullable|image|max:2048',
        ]);

        $user = auth()->user();
        $user->name = $this->name;
        $user->email = $this->email;
        $user->phone = $this->phone;
        $user->permanent_address = $this->permanent_address;
        $user->present_address = $this->same_address ? $this->permanent_address : $this->present_address;
        $user->profession = $this->profession;
        $user->religion = $this->religion;
        $user->nationality = $this->nationality;
        $user->position = $this->position;
        $user->blood_group = $this->blood_group;

        if ($this->photo) {
            if ($user->photo) {
                Storage::disk('public')->delete($user->photo);
            }
            $user->photo = $this->photo->store('photos', 'public');
        }

        $user->save();

        session()->flash('message', 'প্রোফাইল সফলভাবে আপডেট করা হয়েছে।');
        $this->reset(['photo']);

        return redirect(role_route('profile'));
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
        $this->showPasswordSection = false;
    }

    public function render()
    {
        return view('livewire.member.profile-edit')->layout('layouts.app');
    }
}
