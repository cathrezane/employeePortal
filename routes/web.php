<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CalenderController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\HRController\HRScheduleController;
use App\Http\Controllers\HRController\EmployeeAttendanceLogController;
use App\Http\Controllers\HRController\EmployeesController;
use App\Http\Controllers\ScheduleController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::post('/login', 'LoginController@login');

// Route::get('/hr/home', function () {
//     // Implement your HR home page logic here
//     return view('hr.home');
// })->name('hr.home');

Route::get('/admin/home', function () {
    // Implement your admin home page logic here
    return view('admin.home');
})->name('admin.home');

Route::get('/user/home', function () {
    // Implement your user home page logic here
    return view('user.home');
})->name('user.home');

Route::get('/attendance', [AttendanceController::class, 'index']);
Route::post('/attendance/store', [AttendanceController::class, 'enterTime']);

// Route::get('/schedule', function () {
//     return view('pages.agent.schedule');
// });

Route::get('/my-request', function () {
    return view('pages.agent.my-request');
});

// Route::get('schedule', [CalenderController::class, 'index']);
Route::post('calendar-crud-ajax', [CalenderController::class, 'calendarEvents']);

Route::post('/login', [CustomLoginController::class, 'login'])->name('user-login');
Route::get('/logout', [UserController::class, 'logout'])->name('logout');

Route::get('/', function () {
    return view('welcome');
});


Route::get('schedule', [ScheduleController::class, 'index'])->name('schedule.index');





Route::get('/hr', [HRScheduleController::class, 'index'])->name('hr.home');
Route::get('/hr/schedule/', [HRScheduleController::class, 'schedule'])->name('hr_schedule.index');
Route::post('/hr/add-schedule', [EmployeesController::class, 'addSchedule'])->name('add-sched');
Route::get('/hr/{id}/edit-schedule', [HRScheduleController::class, 'editSchedule']);
Route::post('/hr/schedule/assign', [HRScheduleController::class, 'assign'])->name('hr_schedule.assign');
Route::get('hr/employee-attendance-log', [EmployeeAttendanceLogController::class, 'index'])->name('hr_employee_attendance_log');
Route::get('/hr/shift-schedule/', [HRScheduleController::class, 'shiftScheduling'])->name('shift-schedule');
Route::get('/hr/shiftlist/', [HRScheduleController::class, 'shiftList'])->name('shiftlist');
Route::post('hr/shiftlist/add-shift', [HRScheduleController::class, 'addShift'])->name('addShift');
Route::get('hr/employees/', [EmployeesController::class, 'index'])->name('hr.employees');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
