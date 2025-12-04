<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class OrganizationSettingsSeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        // Add organization established year if not exists
        Setting::firstOrCreate(
            ['key' => 'organization_established_year'],
            ['value' => '2024']
        );

        // You can add other default settings here
        Setting::firstOrCreate(
            ['key' => 'organization_name'],
            ['value' => 'প্রজন্ম উন্নয়ন মিশন']
        );

        // Monthly fee
        Setting::firstOrCreate(
            ['key' => 'monthly_fee'],
            ['value' => '500']
        );
    }
}
