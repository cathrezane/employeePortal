<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;
use App\Models\Shift;
use Illuminate\Support\Facades\Auth;
use App\Models\Workdays;

class ScheduleController extends Controller
{
    public function index()
    {
        $userSchedule = Schedule::where('user_id', Auth::user()->id)->with('user', 'shift')->first();

        // $userSchedule->shift->days;


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

        return view('pages.agent.schedule', compact('userSchedule', 'workdayNames'));
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
