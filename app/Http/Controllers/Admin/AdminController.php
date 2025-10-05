<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
   public function grantAccess(Request $request)
{
    $request->validate([
        'employee_id' => 'required|exists:employees,id',
        'role' => 'required|in:employee,hr,manager,admin',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6',
    ]);

    $employee = Employee::findOrFail($request->employee_id);

    $user = User::updateOrCreate(
        ['employee_id' => $employee->id],
        [
            'first_name' => $employee->first_name,
            'last_name' => $employee->last_name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
        ]
    );

    return response()->json(['success' => true, 'user_id' => $user->id]);
}

}
