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
        $users = User::all();

        $agents = User::whereHas('roles', function ($query) {
            $query->where('role_id', 1);
          })->get();

        return view('HR.home', compact('agents'));

    }
    public function schedule()
    {
        // Fetch all schedules with user and shift information
        // $schedules = Schedule::with('user', 'shift')->get();

        // dd($users);
        // $users = User::with('schedule', 'schedule.shift')->get();
        $users = User::whereHas('roles', function ($query) {
            $query->where('role_id', 1);
          })->get();

    //    dd($users);
        // Fetch all users
        // $users = User::all();

        // Fetch all shifts
        $shifts = Shift::all();

        return view('HR.hr-schedule', compact('users', 'shifts'));
    }

    public function assign(Request $request)
    {
        // Validate and assign schedule to user
        // You can validate input, check for existing schedules, etc.
        $this->validate($request, [
            'user_id' => 'required',
            'shift_id' => 'required',
          ]);
        
          // Create schedule only if validation passes (no null values)
          $schedule = Schedule::create([
            'user_id' => $request->input('user_id'),
            'shift_id' => $request->input('shift_id'),
          ]);

          session()->flash('success', "Good Job! You are on time today!");
        
          // Flash message based on successful creation
          return redirect('/hr/schedule')->with(
            $schedule ? 'success' : 'error',
            $schedule ? 'Schedule assigned successfully' : 'Failed to assign schedule: missing required fields'
          );
    }
    public function update(Request $request)
    {
         // Validate and update schedule data
        $this->validate($request, [
            'user_id' => 'required',
            'shift_id' => 'required',
        ]);

        // Update based on user_id (assuming shift_id is unique per user)
        Schedule::where('user_id', $request->input('user_id'))
                ->update(['shift_id' => $request->input('shift_id')]);

        // Flash message and redirect
        return redirect()->route('hr_schedule.index')->with('info', 'Schedule updated successfully');
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

        $shiftList = Shift::all();

        $user = User::find($id);

        return view('HR.edit-agent-schedule', ['schedules' => $schedules])->with('user', $user)->with(['shiftList', $shiftList]);
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
