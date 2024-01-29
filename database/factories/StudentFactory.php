<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => $this->faker->numberBetween(1, 100),
            'family_id' => $this->faker->numberBetween(1, 100),
            'name' => $this->faker->name(),
            'registration' => $this->faker->unique()->numberBetween(1000,1200),
            'picture' => $this->faker->imageUrl(),
            'admission_date' => $this->faker->date('Y-m-d'),
            'phone' => $this->faker->phoneNumber(),
            'address' => $this->faker->address(),
            'date_of_birth' => $this->faker->date('Y-m-d'),
            'gender' => $this->faker->randomElement(['male', 'female', 'other']),
            'previous_school' => $this->faker->sentence(),
        ];
    }
}
