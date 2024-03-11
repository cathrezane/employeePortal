<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\OperationsManager;
use Faker\Factory as Faker;

class OperationsManagerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $faker = Faker::create();
        
        for ($i = 0; $i < 10; $i++) {
            OperationsManager::create([
                'name' => $faker->name,
            ]);
        }
    }
}
