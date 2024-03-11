<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Schedule;
use App\Models\User;
use App\Models\Shift;

class ScheduleSeeder extends Seeder
{
    public function run()
    {
        // Assuming you have users and shifts in the database
        $users = User::all();
        $shifts = Shift::all();

        foreach ($users as $user) {
            foreach ($shifts as $shift) {
                $date = now()->addDays(rand(1, 30))->toDateString();

                // Check if a schedule already exists for this user and date
                $existingSchedule = Schedule::where('user_id', $user->id)
                    ->where('date', $date)
                    ->first();

                if (!$existingSchedule) {
                    // Create a new schedule if none exists
                    Schedule::create([
                        'user_id' => $user->id,
                        'shift_id' => $shift->id,
                        'date' => $date,
                    ]);
                }
            }
        }
    }
}
