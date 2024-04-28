<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;
use App\Models\Shift;
use Illuminate\Support\Facades\Auth;
use App\Models\Workdays;
use App\Models\Attendances;
use Carbon\Carbon;

class ScheduleController extends Controller
{
    public function index()
    {
        $userSchedule = Schedule::where('user_id', Auth::user()->id)->with('user', 'shift')->first();

        // $totalHoursStartTime = Attendances::where('user_id', Auth::user()->id)->where('status', 1)->diffInMinutes(Attendances::where('user_id', Auth::user()->id)->where('status', 4));

        // dd($totalHoursStartTime);

        $user = Auth::user();

        $clockIns = Attendances::where('user_id', $user->id)
        ->where('status', 1)
        ->orderBy('time_logged')
        ->get();

        $clockOuts = Attendances::where('user_id', $user->id)
        ->where('status', 4)
        ->orderBy('time_logged', 'desc')
        ->get();

            if (!empty($clockIns) && !empty($clockOuts)) {
                try {
                  $firstClockIn = $clockIns->first()?->time_logged; // Nullish coalescing operator
                  $lastClockOut = $clockOuts->first()?->time_logged;
                  $castFirstClockIn = Carbon::parse($firstClockIn ?? null); // Set to null if empty
                  $castLastClockOut = Carbon::parse($lastClockOut ?? null);
                  $totalMinutes = $castLastClockOut->diffInMinutes($castFirstClockIn);
                  $totalHours = round($totalMinutes / 60, 2); // Convert to hours with 2 decimal places
                } catch (Exception $e) {
                  // Handle potential errors
                  $totalHours = 0;
                }
              } else {
                $totalHours = 0; // Empty arrays, set totalHours to 0
              }
              $workdayNames = [];

try {
  // Check if $userSchedule is not empty
  if (!empty($userSchedule)) {
    // Check if $userSchedule has a 'shift' property before accessing it
    if (isset($userSchedule->shift)) {
      foreach ($userSchedule->shift->days as $dayId) {
        $workday = Workdays::find($dayId);
        if ($workday) {
          $workdayNames[] = $workday->name;
        } else {
          // Handle missing workday (optional: log error, display message)
        }
      }
    } else {
      // Handle missing 'shift' property (show message or handle differently)
      $message = 'User schedule does not have a shift assigned.'; // Replace with your desired message
    }
  } else {
    // Handle empty user schedule (show message)
    $message = 'No schedule found for this user.'; // Replace with your desired message
  }
} catch (Exception $e) {
  // Handle potential errors during access (optional: log error, display generic message)
  $message = 'An error occurred while processing the schedule.'; // Replace with your desired message
}
        // $workdayNames = [];
        // foreach ($userSchedule->shift->days as $dayId) 
        // {
        //     $workday = Workdays::find($dayId);
        //         if ($workday) { // Check if workday is found
        //             $workdayNames[] = $workday->name;
        //         } else {
        //             // Handle missing workday (optional: log error, display message)
        //         }
        // }
        // dd($workdayNames);

        return view('pages.agent.schedule', compact('userSchedule', 'workdayNames', 'totalHours'));
    }

    public function create()
    {
        // Fetch all shifts
        $shifts = Shift::all();

        return view('schedule.create', compact('shifts'));
    }

    public function store(Request $request)
    {
        // Validate and store schedule
    }
}
