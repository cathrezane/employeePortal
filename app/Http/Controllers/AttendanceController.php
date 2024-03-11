<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendances;
use App\Models\Schedule;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Shift;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    //
    public function index()
    {
        // $results = Attendances::where('user_id', $userId)->get();

        $attendance = Attendances::where('user_id', Auth::user()->id)->get();
        
        $userSchedule = Schedule::where('user_id', Auth::user()->id)->with('user', 'shift')->first();

        $shift = Shift::where('id', $userSchedule->shift_id)->first();

        dd($shift->days);

        // dd($results);

        return view('pages.agent.attendance')->with(['results' => $results]);
    }

    public function enterTime(Request $request)
    {
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
