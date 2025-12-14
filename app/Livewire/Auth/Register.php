<?php

namespace App\Livewire\Auth;

use Livewire\Component;

use Livewire\WithFileUploads;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class Register extends Component
{
    use WithFileUploads;

    public $showTerms = true;
    public $termsAccepted = false;
    public $showPassword = false;
    public $showPasswordConfirmation = false;
    public $sameAddress = false;

    public $name;
    public $phone;
    public $password;
    public $password_confirmation;
    public $father_name;
    public $dob;
    public $permanent_address;
    public $present_address;
    public $blood_group;
    public $profession;
    public $religion = 'ইসলাম';
    public $nationality = 'Bangladeshi';
    public $position;
    public $profile_pic;

    protected $rules = [
        'name' => 'required|string|max:255',
        'phone' => 'required|string|unique:users,phone',
        'password' => 'required|string|min:8|confirmed',
        'father_name' => 'required|string|max:255',
        'dob' => 'required|date',
        'permanent_address' => 'required|string',
        'present_address' => 'required|string',
        'blood_group' => 'required|string',
        'profession' => 'required|string',
        'religion' => 'required|string',
        'nationality' => 'required|string',
        'position' => 'nullable|string',
        'profile_pic' => 'nullable|image|max:2048', // 2MB Max
    ];

    public function acceptTerms()
    {
        $this->validate([
            'termsAccepted' => 'accepted'
        ], [
            'termsAccepted.accepted' => 'আপনাকে অবশ্যই শর্তাবলী মেনে নিতে হবে।'
        ]);

        $this->showTerms = false;
    }

    public function updatedSameAddress($value)
    {
        if ($value) {
            $this->permanent_address = $this->present_address;
        }
    }

    public function updatedPresentAddress($value)
    {
        if ($this->sameAddress) {
            $this->permanent_address = $value;
        }
    }

    public function register()
    {
        $this->validate();

        $profilePicPath = null;
        if ($this->profile_pic) {
            $profilePicPath = $this->profile_pic->store('profile-photos', 'public');
        }

        $user = User::create([
            'name' => $this->name,
            'phone' => $this->phone,
            'email' => $this->phone . '@placeholder.com', // Placeholder email as phone is primary
            'password' => Hash::make($this->password),
            'father_name' => $this->father_name,
            'dob' => $this->dob,
            'permanent_address' => $this->permanent_address,
            'present_address' => $this->present_address,
            'blood_group' => $this->blood_group,
            'profession' => $this->profession,
            'religion' => $this->religion,
            'nationality' => $this->nationality,
            'position' => $this->position,
            'profile_pic' => $profilePicPath,
            'status' => 'pending',
        ]);

        // Assign default role - find the role first
        $memberRole = \HasinHayder\Tyro\Models\Role::where('slug', 'member')->first();
        if ($memberRole) {
            $user->assignRole($memberRole);
        }

        session()->flash('message', 'Registration successful! Please wait for admin approval.');

        // Redirect to login or pending page
        return redirect()->route('tyro-login.login');
    }

    public function render()
    {
        return view('livewire.auth.register')->layout('layouts.guest');
    }
}
