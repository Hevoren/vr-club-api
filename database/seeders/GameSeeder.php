<?php

namespace Database\Seeders;

use App\Models\Game;
use Illuminate\Database\Seeder;

class GameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Game::create([
            'game' => 'minecraft',
            'genre' => 'horror',
            'duration' => 12,
            'price' => 1000,
            'age_limit' => 12
        ]);
    }
}
