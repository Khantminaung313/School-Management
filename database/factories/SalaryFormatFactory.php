<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\salaryFormat>
 */
class SalaryFormatFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "basic_salary" => rand(1000000, 6000000),
            "bonus" => rand(20000, 40000),
            "meat_allowance" => rand(20000,50000),
        ];
    }
}
