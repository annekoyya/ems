<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AccessRightsController extends Controller
{
    public function accessRights()
    {
        $employees = Employee::all();
        return view('admin.access-rights', compact('employees'));
    }

    public function grantAccess(Request $request)
    {
        // Custom validation based on role
        $validator = Validator::make($request->all(), [
            'employee_id' => 'required|exists:employees,id',
            'role' => 'required|in:employee,hr,manager,admin',
            'admin_email' => 'required_if:role,hr,manager,admin|email',
            'admin_password' => 'required_if:role,hr,manager,admin'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        // Verify admin credentials for elevated roles
        if ($request->role !== 'employee') {
            if (!Auth::attempt(['email' => $request->admin_email, 'password' => $request->admin_password])) {
                return response()->json(['message' => 'Invalid admin credentials'], 401);
            }

            $admin = Auth::user();
            if (!in_array($admin->role, ['admin', 'hr'])) {
                return response()->json(['message' => 'Insufficient privileges. Only Admin or HR can grant access.'], 403);
            }
        }

        $employee = Employee::findOrFail($request->employee_id);

        // Check if employee has an email
        if (!$employee->email) {
            return response()->json([
                'message' => 'Employee does not have an email address. Please update their profile first.'
            ], 422);
        }

        try {
            // Handle role assignment
            if ($request->role === 'employee') {
                // Remove system access - delete user account if exists
                User::where('employee_id', $employee->id)->delete();
                
                return response()->json([
                    'success' => true,
                    'message' => 'System access removed. Employee now has basic employee access.',
                    'role' => 'employee'
                ]);
            } else {
                // Grant system access - create or update user account
                $userData = [
                    'employee_id' => $employee->id,
                    'first_name' => $employee->first_name,
                    'last_name' => $employee->last_name,
                    'email' => $employee->email,
                    'role' => $request->role,
                    'password' => Hash::make('password123'), // Use password123
                ];

                $user = User::updateOrCreate(
                    ['employee_id' => $employee->id],
                    $userData
                );

                $message = "Access granted successfully! {$employee->first_name} now has {$request->role} access. Temporary password: password123";

                return response()->json([
                    'success' => true,
                    'message' => $message,
                    'role' => $request->role,
                    'temp_password' => 'password123'
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error updating access rights: ' . $e->getMessage()
            ], 500);
        }
    }
}