<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Shift;

class ShiftSeeder extends Seeder
{
    public function run()
    {
        Shift::create([
            'name' => 'Morning Shift',
            'start_time' => '08:00:00',
            'end_time' => '12:00:00',
        ]);

        Shift::create([
            'name' => 'Afternoon Shift',
            'start_time' => '12:00:00',
            'end_time' => '16:00:00',
        ]);

        Shift::create([
            'name' => 'Night Shift',
            'start_time' => '18:00:00',
            'end_time' => '22:00:00',
        ]);

        // Add more shifts as needed
    }
}
