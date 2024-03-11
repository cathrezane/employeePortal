<?php

namespace App\Http\Controllers\HRController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attendances;
use App\Models\User;

class EmployeeAttendanceLogController extends Controller
{
    //
    public function index()
    {
        $attendances = Attendances::all();

        // dd($attendances);

        return view('hr.employee-attendance-log')->with(['attendances' => $attendances]);
    }
}
