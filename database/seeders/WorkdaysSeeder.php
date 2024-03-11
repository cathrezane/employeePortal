<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Workdays;

class WorkdaysSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Workdays::create([
            'name' => 'Monday',
        ]);
        Workdays::create([
            'name' => 'Tuesday',
        ]);
        Workdays::create([
            'name' => 'Wednesday',
        ]);
        Workdays::create([
            'name' => 'Thursday',
        ]);
        Workdays::create([
            'name' => 'Friday',
        ]);
        Workdays::create([
            'name' => 'Saturday',
        ]);
        Workdays::create([
            'name' => 'Sunday',
        ]);
    }
}
