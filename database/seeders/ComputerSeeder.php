<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Computer;

class ComputerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Computer::create([
            'graphic_card' => 'GTX 1050TI',
            'processor' => 'i5 1550',
            'ram' => '16GB'
        ]);
    }
}
