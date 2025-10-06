<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function showLogin()
    {
        // Redirect if already logged in
        if (Auth::check()) {
            return redirect()->route('employees.index');
        }
        
        // Debug: Log session info
        Log::info('Login page loaded', [
            'session_id' => Session::getId(),
            'has_token' => Session::has('_token'),
            'token' => Session::token(),
        ]);
        
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Debug: Log incoming request
        Log::info('Login attempt', [
            'email' => $request->email,
            'session_id' => Session::getId(),
            'has_token' => $request->has('_token'),
            'token_match' => $request->input('_token') === Session::token(),
        ]);

        try {
            // Validate input
            $credentials = $request->validate([
                'email' => 'required|email',
                'password' => 'required|min:6',
            ]);

            // Attempt login
            if (Auth::attempt($credentials, $request->has('remember'))) {
                $request->session()->regenerate();
                
                Log::info('Login successful', ['user_id' => Auth::id()]);
                
                // Redirect to employees page
                return redirect()->intended(route('employees.index'));
            }

            Log::warning('Login failed - Invalid credentials', ['email' => $request->email]);

            // If login fails, return with error
            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ])->withInput($request->only('email'));
            
        } catch (\Exception $e) {
            Log::error('Login exception', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            
            return back()->withErrors([
                'email' => 'An error occurred. Please try again.',
            ])->withInput($request->only('email'));
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('login');
    }
}