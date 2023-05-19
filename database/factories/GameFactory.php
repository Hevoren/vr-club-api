<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Game>
 */
class GameFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $game = $this->faker->randomElement(['CS', 'Minecraft', 'WoT', 'War']);
        $genre = $this->faker->randomElement(['Horror', 'Puzzle', 'Action']);

        return [
            'game' => $game,
            'age_limit' => $this->faker->numberBetween(6, 18),
            'duration' => $this->faker->numberBetween(20, 50),
            'genre' => $genre,
            'price' => $this->faker->numberBetween(600, 1200)
        ];
    }
}
