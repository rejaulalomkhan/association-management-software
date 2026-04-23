<?php

namespace Database\Seeders;

use HasinHayder\Tyro\Models\Role;
use Illuminate\Database\Seeder;

/**
 * Seeds application-specific roles that are not provided by the
 * default Tyro package seeders (member, accountant).
 *
 * Safe to re-run – uses firstOrCreate keyed on slug.
 */
class ApplicationRolesSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            ['name' => 'member',     'slug' => 'member'],
            ['name' => 'accountant', 'slug' => 'accountant'],
        ];

        foreach ($roles as $role) {
            Role::firstOrCreate(
                ['slug' => $role['slug']],
                ['name' => $role['name']]
            );
        }
    }
}
