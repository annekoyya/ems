<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Show login page
    public function showLogin()
    {
        return view('auth.login');
    }

    // Handle login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $role = Auth::user()->role;

            // Redirect based on role
            switch ($role) {
                case 'hr':
                    return redirect()->route('employees.index');
                case 'manager':
                case 'admin':
                    return redirect()->route('admin.access-rights');
                default:
                    // Prevent employees from logging in
                    Auth::logout();
                    return back()->withErrors([
                        'email' => 'Employees do not have access to the system.',
                    ]);
            }
        }

        return back()->withErrors([
            'email' => 'Invalid credentials.',
        ]);
    }

    // Handle logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
