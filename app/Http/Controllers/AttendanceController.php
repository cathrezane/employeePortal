<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendances;
use App\Models\Schedule;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Shift;
use App\Models\Workdays;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    //
    public function index()
    {


        $results = Attendances::where('user_id',Auth::user()->id)->get();

        $attendance = Attendances::where('user_id', Auth::user()->id)->get();

        $userSchedule = Schedule::where('user_id', Auth::user()->id)->with('user', 'shift')->first();

        $shift = Shift::where('id', $userSchedule->shift_id)->with('workdays')->first();

        $today = Carbon::now()->format('l');

        $numberOfDays = count($shift->days);

        $dayChecked = ""; // Initialize $dayChecked outside the loop

        foreach ($shift->days as $dayId) {
        $checkDay = Workdays::find($dayId);
        if ($checkDay->name === $today) {
            $dayChecked = $checkDay->name;
            break; // Exit the loop if a working day is found (optional)
        }
        }
 
        $gracePeriodEnd = Carbon::parse($shift->start_time)->addMinutes(1); // One-minute grace period after start

        //Checks Schedule Status

        if ($dayChecked) {
            $currentTime = Carbon::now();
            // Check for early arrival (before start time)
            if ($currentTime < $shift->start_time) {
              dd("On Time"); // Employee is considered on time if early
            }
          
            // Check for grace period (within one minute after start time)
            elseif ($currentTime <= $gracePeriodEnd) {
              dd("On Time"); // Employee is on time within the grace period
            }
          
            // If not early or within grace period, employee is late
            else {
              dd("Late"); // Employee is late
            }
          } else {
            dd("You are not scheduled to work today! katulog didto!");
          }


        return view('pages.agent.attendance')->with(['results' => $results]);
    }

    public function enterTime(Request $request)
    {
        
        //"AttendanceStatus" checks if user is On-time/Late/Absent

        //Checks if On-time


        $attendanceData = [
            'time_logged' => Carbon::createFromFormat('H:i', $request->time_logged),
            'user_id' => $request->user_id,
            'date' => $request->date,
            'status' => $request->status
        ];

        $user = User::find(Auth::user()->id); // Replace $id with the ID of the specific model instance

        // dd($attendanceData['status']);
        $user->update(['status' => $attendanceData['status']]);


        // dd($attendanceData);
        
        Attendances::create($attendanceData);

        $success = "Data saved successfully";
        
        return redirect('/home')->with('success', $success);
    }
}
