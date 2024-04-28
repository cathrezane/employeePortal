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
    public function index(Request $request)
    {
      $searchDate = $request->query('searchDate');

      $results = Attendances::where('user_id', Auth::user()->id);

      if ($searchDate) {
        $results->whereDate('time_logged', $searchDate);
      }

       $results = $results->paginate(16);

      $message = $results->isEmpty() ? 'No results found for the selected date.' : '';

      return view('pages.agent.attendance')->with(['results' => $results, 'message' => $message]);
    }

    public function enterTime(Request $request)
    {
        //Clock In 
        //Attendance Status will be Proced only in this function
        $user = User::find(Auth::user()->id);

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

        // Attendance Status 
        // 1 = Ontime 
        // 2 = Late 
        // 3 = Absent 
        // 4 = Break 
        // 5 = OverBreak
        // 6 = Not OverBreak
        // 7 = Clocked Out

        if ($dayChecked) {
          $currentTime = Carbon::now();
        
          // Calculate 4 hours past start time
          $fourHoursAfterStart = Carbon::parse($shift->start_time)->addHours(4);
        
          // Check for early arrival (before start time)
          if ($currentTime < $shift->start_time) {
             // Employee is considered on time if early
             $attendanceData = [
              'attendanceStatus' => 1,
              'time_logged' => Carbon::createFromFormat('H:i', $request->time_logged),
              'user_id' => $request->user_id,
              'date' => $request->date,
              'status' => $request->status
            ];

            $user->update(['status' => $attendanceData['status']]);

            Attendances::create($attendanceData);

            session()->flash('success', "Good Job! You are on time today!");

            return redirect('/home');
          }
        
          // Check for grace period (within one minute after start time)
          elseif ($currentTime <= $gracePeriodEnd) {
            $attendanceData = [
              'attendanceStatus' => 1,
              'time_logged' => Carbon::createFromFormat('H:i', $request->time_logged),
              'user_id' => $request->user_id,
              'date' => $request->date,
              'status' => $request->status
            ]; // Employee is on time within the grace period

            $user->update(['status' => $attendanceData['status']]);

            Attendances::create($attendanceData);
            
            session()->flash('success', "Good Job! You are on time today!");

            return redirect('/home');
          }
        
          // If not early or within grace period, check for absence based on 4-hour mark
          else {
            if ($currentTime > $fourHoursAfterStart) {
              // Employee is absent if 4 hours have passed since start time
              $attendanceData = [
                'attendanceStatus' => 3,
                'time_logged' => Carbon::createFromFormat('H:i', $request->time_logged),
                'user_id' => $request->user_id,
                'date' => $request->date,
                'status' => $request->status
              ]; // Employee is Absent

              Attendances::create($attendanceData);
              
              session()->flash('error', "Can no longer clock-in. Passed 4hrs from Scheduled Time! Absent!");

              return redirect('/home');
            } else {
              $attendanceData = [
                'attendanceStatus' => 2,
                'time_logged' => Carbon::createFromFormat('H:i', $request->time_logged),
                'user_id' => $request->user_id,
                'date' => $request->date,
                'status' => $request->status
              ]; // Employee is late

              $user->update(['status' => $attendanceData['status']]);

              Attendances::create($attendanceData);

              session()->flash('warning', "Good Job! But you are late!");

              return redirect('/home');
            }
          }
        } else {
          // Employee not scheduled to work today (unchanged)

          // dd("Not Today!");
          session()->flash('error', "You are not scheduled to work today!");

          return redirect('/home');
        }
        
        // return redirect('/home')->with('success', "Good Job! You are on time today!");
    }

    public function onBreak(Request $request)
    {
      $attendanceData = [
        'time_logged' => Carbon::createFromFormat('H:i', $request->time_logged),
        'user_id' => $request->user_id,
        'date' => $request->date,
        'status' => $request->status,
        'attendanceStatus' => 4,
      ];
      
        $user = User::find(Auth::user()->id); // Replace $id with the ID of the specific model instance

        $user->update(['status' => $attendanceData['status']]);
        
        Attendances::create($attendanceData);

        session()->flash('success', "Great! Take a break!");

      return redirect('/home');
    }

    public function breakIn(Request $request)
    {
      //Get Date of "Today" Compare the Time Logged where the status is 2.
      //And the instantiation of Time being logged when user Breaking In.
      $today = Carbon::now();
      $user = User::find(Auth::user()->id);

      $breakTimeStarted = Attendances::where('user_id', Auth::user()->id)
          ->where('status', 2)
          ->orderBy('time_logged', 'desc')
          ->first();

      if ($breakTimeStarted) {
        $breakTime = Carbon::parse($breakTimeStarted->time_logged);
        $differenceInMinutes = $breakTime->diffInMinutes($today);

        if ($differenceInMinutes > 60) {
                $attendanceData = [
                  'attendanceStatus' => 5,
                  'time_logged' => Carbon::createFromFormat('H:i', $request->time_logged),
                  'user_id' => $request->user_id,
                  'date' => $request->date,
                  'status' => $request->status
              ];

              $user->update(['status' => $attendanceData['status']]);

              Attendances::create($attendanceData);

              session()->flash('Warning', "Overbreak! Be aware of your break!");

              return redirect('/home');
        } else {
          $attendanceData = [
            'attendanceStatus' => 6,
            'time_logged' => Carbon::createFromFormat('H:i', $request->time_logged),
            'user_id' => $request->user_id,
            'date' => $request->date,
            'status' => $request->status
        ];

        $user->update(['status' => $attendanceData['status']]);

        Attendances::create($attendanceData);

        session()->flash('success', "Welcome Back!");

        return redirect('/home');
        }
      } else {
        // Handle the scenario where no break time is found
        session()->flash('error', "No record found!");
        return redirect('/home');
      }
    }

    public function clockOut(Request $request)
    { 
      $user = User::find(Auth::user()->id);

      $attendanceData = [
        'attendanceStatus' => 7,
        'time_logged' => Carbon::createFromFormat('H:i', $request->time_logged),
        'user_id' => $request->user_id,
        'date' => $request->date,
        'status' => $request->status
      ];

      $user->update(['status' => 7]);

      Attendances::create($attendanceData);

      session()->flash('success', "Good job Today! Rinse and Repeat!");

      return redirect('/home');
    }

    public function tagAgentAsAbsent(Request $request)
    {
      $userID = $request->user_id;

      $user = User::find($userID);
      $user->update(['status' => 3]);

      $now = Carbon::now('Asia/Manila'); 

      $attendanceData = [
        'attendanceStatus' => 3,
        'time_logged' => $now->format('Y-m-d H:i'),
        'user_id' => $userID,
        'date' => $now->format('Y-m-d  H:i'),
        'status' => 3
      ]; // Employee is Absent

      Attendances::create($attendanceData);

      return redirect()->back()->with('success', 'Agent marked as absent!');
    }
}
