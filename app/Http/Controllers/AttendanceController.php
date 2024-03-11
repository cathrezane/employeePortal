<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendances;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    //
    public function index()
    {

        $userId = Auth::user()->id;
        $results = Attendances::where('user_id', $userId)
    ->with([
        'schedules' => function ($query) use ($userId) { // Eager load schedules
            $query->where('user_id', $userId); // Filter by user_id
            $query->with('shift'); // Eager load shift for each schedule
        }
    ])
    ->orderBy('time_logged', 'desc')
    // ->select('status', 'time_logged') // Commented out for full data retrieval
    ->get();
        // $results = Attendances::where('user_id', $userId)
        // ->with([
        // 'schedules' => function ($query) use ($userId) { // Eager load schedules
        //     $query->where('user_id', $userId); // Filter by user_id
        // },
        // 'schedules.shifts' => function ($query) { // Eager load shifts through schedules
        //     // Optional: Add filtering or other conditions for shifts here (if needed)
        // }
        // ])
        // ->orderBy('time_logged', 'desc')
        // // ->select('status', 'time_logged') // Select desired columns from Attendances
        // ->get();

        dd($results);

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
