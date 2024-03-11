<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;

class UserRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // Create roles
        $roleUser = Role::create(['name' => 'user']);
        $roleAdmin = Role::create(['name' => 'admin']);
        $roleHR = Role::create(['name' => 'HR']);
    }
}
