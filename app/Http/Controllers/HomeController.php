<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendances;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = User::find(Auth::id());

        $user->roles = $user->roles()->get();

        $roleName = $user->roles->pluck('id')->first();

        $latestActivity = Attendances::latest()->first();

        $latestAttendances = Attendances::where('user_id', Auth::id())->orderBy('created_at', 'desc')->skip(1)->take(6)->get();

        return view('home')->with('latestActivity', $latestActivity)->with(['latestAttendances' => $latestAttendances])->with('roleName', $roleName);
    }
}
