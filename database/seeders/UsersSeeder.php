<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert([
            [
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('password'),
                'email_verified_at' => Carbon::now()
            ],
            [
                'name' => 'principle',
                'email' => 'principle@gmail.com',
                'password' => bcrypt('password'),
                'email_verified_at' => Carbon::now()
            ],
            [
                'name' => 'teacher',
                'email' => 'teacher@gmail.com',
                'password' => bcrypt('password'),
                'email_verified_at' => Carbon::now()
            ],
            [
                'name' => 'student',
                'email' => 'student@gmail.com',
                'password' => bcrypt('password'),
                'email_verified_at' => Carbon::now()
            ],
            ]);
    }
}
