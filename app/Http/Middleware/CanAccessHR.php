<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth; // Add this import

class CanAccessHR
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $user = Auth::user();
        
        // FIXED: Direct role checking instead of calling canAccessHR()
        if (!in_array($user->role, ['admin', 'hr'])) {
            return redirect('/dashboard')->with('error', 'You do not have permission to access this page.');
        }

        return $next($request);
    }
}