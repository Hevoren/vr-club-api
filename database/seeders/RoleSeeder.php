<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create([
            'role_id' => 1,
            'role' => 'admin'
        ]);

        Role::create([
            'role_id' => 2,
            'role' => 'user'
        ]);

        Role::create([
            'role_id' => 3,
            'role' => 'superadmin'
        ]);
    }
}
