<?php

namespace App\Http\Controllers\HRController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Schedule;
use App\Models\User;
use App\Models\Shift;
use App\Models\Workdays;
use Carbon\Carbon;

class HRScheduleController extends Controller
{

    public function index()
    {
        $home = 'This is the homepage';

        return view('HR.home', compact('home'));

    }
    public function schedule()
    {
        // Fetch all schedules with user and shift information
        // $schedules = Schedule::with('user', 'shift')->get();

        // Fetch all users
        $users = User::all();

        // Fetch all shifts
        $shifts = Shift::all();

        return view('HR.hr-schedule', compact('users', 'shifts'));
    }

    public function assign(Request $request)
    {
        // Validate and assign schedule to user
        // You can validate input, check for existing schedules, etc.

        Schedule::create([
            'user_id' => $request->input('user_id'),
            'shift_id' => $request->input('shift_id'),
            'date' => $request->input('date'),
        ]);

        return redirect()->route('hr_schedule.index')->with('success', 'Schedule assigned successfully');
    }

    public function addSchedule($id)
    {
        $user = Schedule::find($id);

        if (!$user) {
            abort(404); // Handle the case where user is not found
        }

        $userSchedules = Schedule::where('user_id', $id)->get();

        return view('HR.hr-schedule', ['user' => $user, 'userSchedules' => $userSchedules]);
    }

    public function editSchedule($id)
    {
        $schedules = Schedule::where('user_id',$id)->get();

        $user = User::find($id);

        return view('HR.edit-agent-schedule', ['schedules' => $schedules])->with('user', $user);
    }

    public function shiftScheduling()
    {
        return view('HR.shift-scheduling');
    }

    // public function shiftList()
    // {
    //     // $shift = Shift::with('workdays')->find(1);

    //     // $workdayNames = $shift->workdays->pluck('name');

    //     // dd($shift);
    //     $dayNames = Workdays::all();

    //     $shift = Shift::with('workdays')->get();

        
    //     $shifts = Shift::with('workdays')->get();

    //     $days = [];

    //     foreach($numShiftDay as $day){
    //         $dayName = Workdays::find($shift->days);
    //         $days[] = $dayName->pluck('name');
    //     }

    //     return view('HR.shiftlist')->with(['shifts' => $shifts])->with(['days' => $days])->with(['dayNames' => $dayNames]);
    // }

    public function shiftList()
    {
        $dayNames = Workdays::all();
        $shifts = Shift::with('workdays')->get();
        $days = [];

        foreach($shifts as $shift){
            $dayName = Workdays::find($shift->days);
            $days[] = $dayName->pluck('name');
        }

        return view('HR.shiftlist', compact('shifts', 'days', 'dayNames'));
    }

    public function addShift(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'days' => 'required',
        ]);

        $selectedDays = $request->input('days', []); // Get form input for days

        // Encode selected days to JSON
        $jsonData = $selectedDays;

        $data = new Shift();

        $data->name = $request->input('name');
        $data->start_time = $request->input('start_time');
        $data->end_time = $request->input('end_time');
        $data->days = $jsonData; // Assign JSON data to 'days' field

        $data->save();

        // dd($data);  // Uncomment for debugging (optional)

        return redirect()->route('shiftlist')->with('success', 'Shift added successfully');
    }
}
