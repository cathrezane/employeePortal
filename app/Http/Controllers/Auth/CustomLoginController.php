<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class CustomLoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // public function login(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'email' => 'required|email',
    //         'password' => 'required',
    //     ]);

    //     if ($validator->fails()) {
    //         return redirect('login')
    //                     ->withErrors($validator)
    //                     ->withInput();
    //     }

    //     // If the validation passes, continue with the login logic
    //     // For example, authenticate the user using the input email and password

    //     // Return a response or redirect to a different page
    // }
    public function login(Request $request)
    {
        
        // Validate credentials
        $this->validate($request, [
            'email' => 'required|email|string',
            'password' => 'required|string|min:6',
        ]);

        // Attempt login
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->boolean('remember'))) {
            $user = Auth::user();

            // dd($user->role_id);

            // Determine redirect based on user role
            if (method_exists($user, 'hasRole')) { // Check for `hasRole` method
                $role = $user->hasRole('hr') ? 'hr' : // Use 'hasRole' if available
                       ($user->hasRole('admin') ? 'admin' :
                       ($user->hasRole('user') ? 'user' : null));
            } else { // Fallback if no `hasRole` method
                $role = $user->role_id === 3 ? 'hr' :
                       ($user->role_id === 2 ? 'admin' :
                       ($user->role_id === 1 ? 'user' : null));
            }

            if ($role) {
                return redirect()->route($role . '.home');
            }
        }

        // Return to login with error message
        return back()->withInput()->withErrors([
            'email' => 'The provided credentials are invalid.',
        ]);
    }

}
