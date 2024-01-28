<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Family>
 */
class FamilyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'father_name' => $this->faker->name(),
            'mother_name' => $this->faker->name(),
            'father_info' => $this->faker->sentence(),
            'mother_info' => $this->faker->sentence()
        ];
    }
}
