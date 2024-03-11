<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Campaigns;
use Faker\Factory as Faker;

class CampsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        $faker = Faker::create();

        for ($i = 0; $i < 50; $i++) { // Adjust the number of companies as needed
            $name = $faker->company;

            // Optionally, combine with random words for more variety
            $name .= " " . $faker->word;

            Campaigns::create([
                'name' => $name,
                // other company attributes
            ]);
        }
    }
}
