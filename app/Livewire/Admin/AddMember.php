<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\User;
use App\Services\MemberService;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AddMember extends Component
{
    use WithFileUploads;

    public $name;
    public $email;
    public $phone;
    public $password;
    public $father_name;
    public $dob;
    public $permanent_address;
    public $present_address;
    public $blood_group;
    public $profession;
    public $religion = 'Islam';
    public $nationality = 'Bangladeshi';
    public $position;
    public $profile_pic;
    public $auto_approve = true;
    public $same_address = false;

    protected $memberService;

    public function boot(MemberService $memberService)
    {
        $this->memberService = $memberService;
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

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|unique:users,phone|min:11|max:14',
            'password' => 'required|min:8',
            'father_name' => 'nullable|string|max:255',
            'dob' => 'nullable|date',
            'permanent_address' => 'nullable|string|max:500',
            'present_address' => 'nullable|string|max:500',
            'blood_group' => 'nullable|string|max:10',
            'profession' => 'nullable|string|max:255',
            'religion' => 'nullable|string|max:50',
            'nationality' => 'nullable|string|max:50',
            'position' => 'nullable|string|max:255',
            'profile_pic' => 'nullable|image|max:2048',
            'auto_approve' => 'boolean',
        ];
    }

    public function addMember()
    {
        $this->validate();

        // If same address is checked, copy permanent to present
        if ($this->same_address) {
            $this->present_address = $this->permanent_address;
        }

        $data = [
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
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
            'status' => $this->auto_approve ? 'active' : 'pending',
        ];

        // Handle profile picture upload
        if ($this->profile_pic) {
            $path = $this->profile_pic->store('profile-pics', 'public');
            $data['profile_pic'] = $path;
        }

        // Generate membership ID if auto-approved
        if ($this->auto_approve) {
            $data['membership_id'] = $this->memberService->generateMembershipId();
            $data['joined_at'] = now();
        }

        // Create user
        $user = User::create($data);

        // Assign member role (role_id = 9)
        $user->roles()->attach(9);

        session()->flash('success', $this->auto_approve
            ? 'সদস্য সফলভাবে যুক্ত হয়েছে! সদস্য নম্বর: ' . $user->membership_id
            : 'সদস্য যুক্ত হয়েছে এবং অনুমোদনের জন্য অপেক্ষমাণ রয়েছে।');

        // Reset form
        $this->reset();

        // Redirect to member list
        return redirect()->route('admin.members');
    }

    public function render()
    {
        return view('livewire.admin.add-member')->layout('layouts.app');
    }
}
