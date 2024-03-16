<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Employee;

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
        return [
            'user_id' => rand(1,9999),
            'name' => fake()->name(),
            'phone' => fake()->phoneNumber(),
            'employee_type_id' => 2,
            'join_date' => fake()->date('Y-m-d'),
            'salary' => rand(1000000,3000000),
            'father_name' => fake()->name(),
            'gender' => rand(1,3),
            'date_of_birth' => fake()->date('Y-m-d'),
            'education' => 'B.Sc',
        ];
    }

    public function configure(): static
    {
        return $this->afterCreating(function (Employee $employee) {
           \App\Models\SalaryFormat::factory()->create([
            'employee_id' => $employee->id,
        ]);
        });
    }
}
