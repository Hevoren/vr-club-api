<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\Statuse;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatuseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Statuse::create([
            'status' => 'active'
        ]);

        Statuse::create([
            'status' => 'faired'
        ]);

        Statuse::create([
            'status' => 'pending'
        ]);
    }
}
