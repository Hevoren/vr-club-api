<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call(ComputerSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(StatuseSeeder::class);
        $this->call(VrDevicesSeeder::class);
        $this->call(EmployeeSeeder::class);
        $this->call(RoomSeeder::class);
        $this->call(GameSeeder::class);
    }
}
