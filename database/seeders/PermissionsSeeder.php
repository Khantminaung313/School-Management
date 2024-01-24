<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::insert([
            ['name' => 'user_view'],
            ['name' => 'user_create'],
            ['name' => 'user_update'],
            ['name' => 'user_delete'],
            ['name' => 'role_view'],
            ['name' => 'role_create'],
            ['name' => 'role_update'],
            ['name' => 'role_delete'],
        ]);
    }
}
