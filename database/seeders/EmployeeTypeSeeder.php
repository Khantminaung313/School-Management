<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\EmployeeType;

class EmployeeTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        EmployeeType::insert([
            [
                'name' => 'principal',
                'role_id' => 2
            ],
            [
                'name' => 'teacher', 'role_id' => 2
            ],
            [
                'name' => 'accountant', 'role_id' => 2
            ],
        ]);
    }
}
