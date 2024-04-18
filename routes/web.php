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
use App\Http\Controllers\AdminController\UserManagementController;

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

Route::post('/login', 'LoginController@login');
Route::get('/admin/home',  function () { return view('admin.home'); })->name('admin.home');
Route::get('admin/user-management',  [UserManagementController::class, 'index'] )->name('admin.user-management');
Route::get('admin/user/{id}/edit', [UserManagementController::class, 'edit'])->name('users.edit');
Route::put('admin/user/{id}', [UserManagementController::class, 'update'])->name('users.update');
Route::post('admin/user/disable/{id}', [UserManagementController::class, 'disable'])->name('users.disable');
Route::post('admin/user/enable/{id}', [UserManagementController::class, 'enable'])->name('users.enable');
Route::post('admin/user/destroy/{id}', [UserManagementController::class, 'destroy'])->name('users.destroy');
Route::post('admin/user/reset/{id}', [UserManagementController::class, 'resetPassword'])->name('users.reset');
Route::post('admin/user/store', [UserManagementController::class, 'store'])->name('users.store');
//Reset




Route::get('/user/home', function () {
    // Implement your user home page logic here
    return view('user.home');
})->name('user.home');

Route::get('/attendance', [AttendanceController::class, 'index'])->name('attendance.index');
Route::post('/attendance/store', [AttendanceController::class, 'enterTime']);
Route::post('attendance/store/on-Break', [AttendanceController::class, 'onBreak'])->name('onBreak');
Route::post('attendancne/store/break-in', [AttendanceController::class, 'breakIn'])->name('breakIn');
Route::post('attendance/store/clock-out', [AttendanceController::class, 'clockOut'])->name('clockOut');
Route::get('schedule', [ScheduleController::class, 'index'])->name('schedule.index');


Route::get('/hr', [HRScheduleController::class, 'index'])->name('hr.home');
Route::get('/hr/schedule/', [HRScheduleController::class, 'schedule'])->name('hr_schedule.index');
Route::post('/hr/add-schedule', [EmployeesController::class, 'addSchedule'])->name('add-sched');
Route::get('/hr/{id}/edit-schedule', [HRScheduleController::class, 'editSchedule'])->name('edit-sched');;
Route::post('/hr/schedule/assign', [HRScheduleController::class, 'assign'])->name('hr_schedule.assign');
Route::post('hr/scheudle/update', [HRScheduleController::class, 'update'])->name('hr_schedule.update');
Route::get('hr/employee-attendance-log', [EmployeeAttendanceLogController::class, 'index'])->name('hr_employee_attendance_log');
Route::get('/hr/shift-schedule/', [HRScheduleController::class, 'shiftScheduling'])->name('shift-schedule');
Route::get('/hr/shiftlist/', [HRScheduleController::class, 'shiftList'])->name('shiftlist');
Route::post('hr/shiftlist/add-shift', [HRScheduleController::class, 'addShift'])->name('addShift');
Route::get('hr/employees/', [EmployeesController::class, 'index'])->name('hr.employees');
Route::get('/hr/{id?}/attendance-log', [EmployeeAttendanceLogController::class, 'viewLog'])->name('hr_employee_attendance_log.viewLog');

Auth::routes();


Route::post('calendar-crud-ajax', [CalenderController::class, 'calendarEvents']);
// Route::post('/login', [CustomLoginController::class, 'login'])->name('user-login');
Route::get('/logout', [UserController::class, 'logout'])->name('logout');
Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
