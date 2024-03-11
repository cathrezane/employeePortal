<?php

namespace App\Http\Controllers\HRController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Shift;
use App\Models\Schedule;
use Carbon\Carbon;

class EmployeesController extends Controller
{
    //
    public function index()
    {
        // 1. Fetch Employees with Eager Loading
        $employees = User::with(['roles', 'schedules.shift:id,name,days,start_time,end_time'])->get();

        // dd($employees);

        // 2. Fetch Shifts
        $shifts = Shift::all();

        // 3. dd($employees) (for debugging, you can comment this out)

        // 4. Return View Data
        return view('hr.employees')->with([
            'employees' => $employees,
            'shifts' => $shifts
        ]);
    }

    public function addSchedule(Request $request)
    {
        $sched = new Schedule();

        $sched->user_id = $request->input('user_id');
        $sched->shift_id = $request->input('shift_id');
        $sched->date = Carbon::now();
        $sched->save();

        return redirect()->route('hr.employees')->with('success', 'Schedule assigned successfully');

    }
}
