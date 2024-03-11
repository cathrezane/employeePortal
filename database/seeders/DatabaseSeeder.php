<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Test User1',
            'email' => 'test1@example.com',
            'password' => '12345678'
        ]);
        \App\Models\User::factory()->create([
            'name' => 'Test User2',
            'email' => 'test2@example.com',
            'password' => '12345678'
        ]);
        \App\Models\User::factory()->create([
            'name' => 'Test User3',
            'email' => 'test3@example.com',
            'password' => '12345678'
        ]);
    }
}
