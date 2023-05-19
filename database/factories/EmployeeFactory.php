<?php

namespace Database\Factories;

use App\Models\Statuse;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $title = $this->faker->randomElement(['admin', 'animator', 'director']);
        $phoneNumber = $this->faker->phoneNumber;

        return [
            'status_id' => Statuse::factory()->create()->id,
            'name' => $this->faker->name(),
            'surname' => $this->faker->name(),
            'mid_name' => $this->faker->name,
            'salary' => $this->faker->numberBetween(10000, 1000000),
            'title' => $title,
            'phone_number' => $phoneNumber,
        ];
    }
}
