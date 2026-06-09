<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;

class AdminController extends Controller
{
    public function userList()
    {
        $users = User::latest()->get();

        return view('admin.users', compact('users'));
    }
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    // public function userList(Request $request)
    // {
    //     $users = User::latest()->get();
    //     return view('admin.users', compact('users'));
    // }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users')
            ->with('success', 'User deleted successfully!');
    }

    public function getSignupForm()
    {
        return view('signup');
    }
    public function signup(Request $request)
    {
        $request->validate([
            'fullname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'fullname' => $request->fullname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'email_verified_at' => null,
        ]);

        return redirect()->route('signin')
            ->with('success', 'Account created! Please verify your email.');
    }
}

