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
        $statuses = Statuse::factory()->count(3)->create();

        // Создаем 10 сотрудников
        Employee::factory()->count(20)->create([
            'status_id' => $statuses->random()->status_id,
        ]);
    }
}
