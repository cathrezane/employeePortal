<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //
    public function logout(Request $request)
    {
        Auth::logout(); // Logout the currently authenticated user
        $request->session()->invalidate(); // Invalidate the session
        $request->session()->regenerateToken(); // Regenerate the CSRF token

        return redirect('/login'); // Redirect to the login page after logout
    }
}
