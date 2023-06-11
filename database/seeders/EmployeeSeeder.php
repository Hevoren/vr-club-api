<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Employee::create([
            'status_id' => 1,
            'name' => 'vasek',
            'surname' => 'vasiliev',
            'mid_name' => 'vasilievich',
            'salary' => 12000,
            'title' => 'admin',
            'phone_number' => '8(123) 123-13-12'
        ]);
    }
}
