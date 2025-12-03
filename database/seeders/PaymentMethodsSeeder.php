<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentMethodsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $methods = [
            ['name' => 'Hand Cash', 'name_bn' => 'হাতে নগদ', 'is_active' => true, 'order' => 1],
            ['name' => 'bKash', 'name_bn' => 'বিকাশ', 'is_active' => true, 'order' => 2],
            ['name' => 'Nagad', 'name_bn' => 'নগদ', 'is_active' => true, 'order' => 3],
            ['name' => 'Rocket', 'name_bn' => 'রকেট', 'is_active' => true, 'order' => 4],
            ['name' => 'Bank Transfer', 'name_bn' => 'ব্যাংক ট্রান্সফার', 'is_active' => true, 'order' => 5],
            ['name' => 'Upay', 'name_bn' => 'উপায়', 'is_active' => true, 'order' => 6],
        ];

        foreach ($methods as $method) {
            DB::table('payment_methods')->insert([
                'name' => $method['name'],
                'name_bn' => $method['name_bn'],
                'is_active' => $method['is_active'],
                'order' => $method['order'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
