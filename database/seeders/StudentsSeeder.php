<?php

namespace Database\Seeders;

use App\Models\Family;
use App\Models\Student;
use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Student::factory(5)
            ->create([
                'user_id' => function() {
                    return User::factory()->create()->id;
                },
                'family_id' => function() {
                    return Family::factory()->create()->id;
                }
            ]);
    }
}
