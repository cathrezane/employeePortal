<?php

namespace App\Http\Controllers\HRController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attendances;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class EmployeeAttendanceLogController extends Controller
{
    //
    public function index()
    {$latestAttendances = Attendances::selectRaw('user_id, MAX(created_at) AS latest_attendance')->with('user')
        ->where('status', 1)
        ->groupBy('user_id');
    
    $latestOut = Attendances::selectRaw('user_id, MAX(created_at) AS latest_out')->with('user')
        ->where('status', 4)
        ->groupBy('user_id');

    $latestAttendancesAndOut = DB::table('attendances as A')
        ->select(
            'A.user_id', 
            'U.name',
            // Assuming 'name' is a column in the 'users' table
            DB::raw('MAX(CASE WHEN A.status = 1 THEN A.created_at ELSE NULL END) AS latest_attendance'), 
            DB::raw('MAX(CASE WHEN A.status = 4 THEN A.created_at ELSE NULL END) AS latest_out'), 
            DB::raw('MAX(A.attendanceStatus) as attendance_status')
        )
        ->join('users as U', 'A.user_id', '=', 'U.id')
        ->where(function ($query) {
            $query->where('A.status', 1)
                ->orWhere('A.status', 4);
        })
        ->groupBy('A.user_id', 'U.name')
        ->get();

        return view('hr.employee-attendance-log')->with(['latestAttendancesAndOut' => $latestAttendancesAndOut]);
    }

    public function viewLog($id = null, Request $request)
    {
        if (is_null($id)) {
            // Handle missing ID case (e.g., redirect to an error page or display a message)
            return redirect()->view('hr.agent-attendance-log');
          }

        $searchDate = $request->query('searchDate');

        $results = Attendances::where('user_id', $id);

        if ($searchDate) {
            $results->whereDate('time_logged', $searchDate);
        }

        $results = $results->paginate(16);

        $message = $results->isEmpty() ? 'No results found for the selected date.' : '';

        return view('hr.agent-attendance-log')->with(['results' => $results, 'message' => $message])->with('id' , $id);
    }
}
