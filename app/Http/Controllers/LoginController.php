<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('signin');
    }


    public function signin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');

        // Attempt login
        if (!Auth::attempt($credentials)) {
            return redirect()->route('signin')
                ->with('error', 'Invalid email or password.');
        }

        // Get authenticated user
        $user = Auth::user();

        switch ($user->role) {

            case 'admin':
                return redirect()->route('admin.dashboard');

            case 'user':
                if ($user->status === 'active') {
                    return redirect()->route('welcome');
                }

                Auth::logout();
                return redirect()->route('signin')
                    ->with('error', 'Please wait for your account approval.');

            default:
                Auth::logout();
                return redirect()->route('signin')
                    ->with('error', 'Unauthorized access.');
        }
    }
}
