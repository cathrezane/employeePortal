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

        // dd( $clockOuts);

        if (!empty($clockIns) && !empty($clockOuts) && $clockOuts === null) {
            $firstClockIn = $clockIns->first()->time_logged; // Assuming Carbon object
            $lastClockOut = $clockOuts->first()->time_logged; // Assuming Carbon object
            
            $castFirstClockIn = Carbon::parse($firstClockIn);
            $castLastClockOut = Carbon::parse($lastClockOut);

            $totalMinutes = $castLastClockOut->diffInMinutes($castFirstClockIn);
            $totalHours = round($totalMinutes / 60, 2); // Convert to hours with 2 decimal places

        }else{
            $totalHours = 0;
        }

        // dd($totalHours);

        $workdayNames = [];
        foreach ($userSchedule->shift->days as $dayId) {
            $workday = Workdays::find($dayId);
            if ($workday) { // Check if workday is found
                $workdayNames[] = $workday->name;
            } else {
                // Handle missing workday (optional: log error, display message)
            }
    }
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
