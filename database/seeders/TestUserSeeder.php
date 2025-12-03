<?php

namespace Database\Seeders;

use App\Models\User;
use HasinHayder\Tyro\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TestUserSeeder extends Seeder
{
    public function run(): void
    {
        // Update existing admin user
        $admin = User::find(1);
        if ($admin) {
            $admin->update([
                'phone' => '01700000000',
                'password' => Hash::make('password'),
            ]);
            // Assign admin role
            $adminRole = Role::where('name', 'admin')->first();
            if ($adminRole && !$admin->hasRole('admin')) {
                $admin->assignRole($adminRole);
            }
        }

        // Create or update test member
        $member = User::where('phone', '01711111111')->first();
        if (!$member) {
            $member = User::create([
                'name' => 'Test Member',
                'email' => 'member@test.com',
                'phone' => '01711111111',
                'password' => Hash::make('password'),
                'father_name' => 'Father Name',
                'dob' => '1990-01-01',
                'blood_group' => 'A+',
                'profession' => 'Software Developer',
                'religion' => 'Islam',
                'nationality' => 'Bangladeshi',
                'present_address' => 'Dhaka, Bangladesh',
                'permanent_address' => 'Dhaka, Bangladesh',
                'status' => 'active',
            ]);
        }
        // Assign member role
        $memberRole = Role::where('name', 'member')->first();
        if ($memberRole && !$member->hasRole('member')) {
            $member->assignRole($memberRole);
        }

        // Create or update test accountant
        $accountant = User::where('phone', '01722222222')->first();
        if (!$accountant) {
            $accountant = User::create([
                'name' => 'Test Accountant',
                'email' => 'accountant@test.com',
                'phone' => '01722222222',
                'password' => Hash::make('password'),
                'father_name' => 'Father Name',
                'dob' => '1985-01-01',
                'blood_group' => 'B+',
                'profession' => 'Accountant',
                'religion' => 'Islam',
                'nationality' => 'Bangladeshi',
                'present_address' => 'Dhaka, Bangladesh',
                'permanent_address' => 'Dhaka, Bangladesh',
                'status' => 'active',
            ]);
        }
        // Assign accountant role
        $accountantRole = Role::where('name', 'accountant')->first();
        if ($accountantRole && !$accountant->hasRole('accountant')) {
            $accountant->assignRole($accountantRole);
        }

        echo "Test users created/updated successfully!\n";
    }
}
