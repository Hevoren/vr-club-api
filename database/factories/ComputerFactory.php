<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Computer>
 */
class ComputerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $graphicCard = $this->faker->randomElement(['GTX 1050TI', 'RX580', 'RTX 4090', 'RTX2080']);
        $processor = $this->faker->randomElement(['Xeon E5-1650', 'I7-9990', 'I9-6700', 'I5-4300']);
        $ram = $this->faker->randomElement(['16', '32', '8']);

        return [
            'graphic_card' => $graphicCard,
            'processor' => $processor,
            'ram' => $ram
        ];
    }
}
