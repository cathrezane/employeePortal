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
    {
        $latestAttendancesAndOut = User::with(['attendances' => function ($query) {
            $query->whereIn('status', [1, 4]) // Filter by statuses 1 and 4
                ->orderBy('time_logged', 'desc'); // Order by time_logged descending
        }, 'roles'])
        ->whereHas('roles', function ($query) {
            $query->where('role_id', 1); // Filter roles by role_id
        })
        ->select('users.id', 'users.name')
        ->get()
        ->map(function ($user) {
            // Process attendances for each user
            $latestAttendances = $user->attendances->groupBy('status');
            $latestIn = $latestAttendances->has(1) ? $latestAttendances->get(1)->first()->time_logged : null;
            $latestOut = $latestAttendances->has(4) ? $latestAttendances->get(4)->first()->time_logged : null;
            
            // Add latest_in and latest_out to the user object
            $user->latest_in = $latestIn;
            $user->latest_out = $latestOut;
            
            return $user;
        });

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
