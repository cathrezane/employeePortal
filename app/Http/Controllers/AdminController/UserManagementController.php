<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;

class UserManagementController extends Controller
{
    //

    public function index(Request $request)
    {
        $searchTerm = $request->query('search');
        $users = User::where('status', '<>', 100)
            ->where(function ($query) use ($searchTerm) {
                $query->where('name', 'like', "%{$searchTerm}%")
                    ->orWhere('email', 'like', "%{$searchTerm}%");
            })
            ->paginate(15);

        return view('admin.pages.user-management', compact('users'));
    }

    public function edit(User $user)
    {
        return view('admin.pages.user-edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->save();

        return redirect()->back()->with('success', 'User updated successfully');
    }

    public function disable($id)
    {
        $user = User::find($id);
        $user->update(['status' => 20]);

        return redirect()->back()->with('success', 'User disabled successfully');
    }

    public function enable($id)
    {
        $user = User::find($id);
        $user->update(['status' => 0]);

        return redirect()->back()->with('success', 'User enabled successfully');
    }

    public function store(Request $request)
    {
        // $user = new User();
        // $password = Str::random(8);
        // $user->name = $request->input('name');
        // $user->email = $request->input('email');
        // $user->password = bcrypt($password);
        // $user->roles()->sync([1]);
        // $user->save();
        $password = Str::random(8);
        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => bcrypt($password),
        ]);

        $user->roles()->sync([1]); 

        $newUser = session()->put('newUser', $user);
        session()->put('generatedPassword', $password);

        return redirect()->back()
            ->with([
                'success' => 'User created successfully',
                'generatedPassword' => $password,
                'newUser' => $user,
            ]);
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->update(['status' => 100]);

        return redirect()->back()->with('success', 'User deleted successfully');
    }

    public function resetPassword($id)
    {
        $user = User::find($id);
        $password = Str::random(8);
        $user->update(['password' => bcrypt($password)]);

        session()->put('resetPassword', $password);

        return redirect()->back()
            ->with([
                'info' => 'Reset Password Successfully',
                'resetPassword' => $password,
                'username' => $user->name,
            ]);
    }
}
