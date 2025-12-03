<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            [
                'key' => 'organization_name',
                'value' => 'প্রজন্ম উন্নয়ন মিশন',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'organization_name_en',
                'value' => 'Projonmo Unnayan Mission',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'organization_start_month',
                'value' => '2025-01', // Year-Month format
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'monthly_fee',
                'value' => '500', // Default monthly fee in BDT
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'organization_logo',
                'value' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'organization_address',
                'value' => 'ঢাকা, বাংলাদেশ',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'organization_phone',
                'value' => '01700000000',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'currency',
                'value' => 'BDT',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'currency_symbol',
                'value' => '৳',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('settings')->insert($settings);
    }
}
