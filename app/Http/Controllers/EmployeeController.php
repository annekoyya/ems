<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\NewHire;
use App\Models\Employee;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;



class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */

      // In your EmployeeController
public function index()
{
    $employees = Employee::all();
    
    // Get unique values for filters
    $departments = Employee::distinct('department')->pluck('department');
    $jobTitles = Employee::distinct('job_category')->pluck('job_category');
    // $statuses = Employee::distinct('employee_status')->pluck('employee_status');
    
    return view('employees.index', compact('employees', 'departments', 'jobTitles'));
}

    public function view(Employee $employee)
    {
        return view('employees.view', compact('employee'));
    }

    public function generatePdf(Employee $employee)
    {
        $pdf = Pdf::loadView('employees.pdf', compact('employee'));
        return $pdf->download('employee_'.$employee->id.'.pdf');
    }




    /**
     * Show the form for creating a new resource.
     */
    // EmployeeController.php
public function create(NewHire $newHire)
{
    return view('employees.create', compact('newHire'));
}




public function store(Request $request, NewHire $newHire)
{
    $validated = $request->validate([
        // Personal Information
        'first_name' => 'required|string|max:255',
        'last_name'  => 'required|string|max:255',
        'middle_name' => 'nullable|string|max:255',
        'name_extension' => 'nullable|string|max:10',
        'date_of_birth' => 'required|date',

        // Contact Information
        'home_address' => 'nullable|string|max:500',
        'phone_number' => 'nullable|string|max:50',
        'email' => 'required|email|unique:employees,email',
        'emergency_contact_name' => 'nullable|string|max:255',
        'emergency_contact_number' => 'nullable|string|max:50',
        'relationship' => 'nullable|string|max:100',

        // Financial
        'tin' => 'nullable|string|max:50',
        'sss_number' => 'nullable|string|max:50',
        'pagibig_number' => 'nullable|string|max:50',
        'bank_name' => 'nullable|string|max:255',
        'account_name' => 'nullable|string|max:255',
        'account_number' => 'nullable|string|max:50',

        // Job Information
        'start_date' => 'required|date',
        'department' => 'required|string|max:255',
        'job_category' => 'nullable|string|max:255',
        'employment_type' => 'nullable|string|max:100',
        'reporting_manager' => 'required|string|max:255',
    ]);

    // Optional: link to NewHire before deleting it
    // $validated['new_hire_id'] = $newHire->id;
    $newHire->delete();

    // Create employee record
    $employee = Employee::create($validated);

    // ✅ Auto-create user account for HR/Admin/Manager
    $role = strtolower($validated['department']);
    if (in_array($role, ['hr', 'admin', 'manager'])) {
        User::create([
            'employee_id' => $employee->id,
            'first_name' => $employee->first_name,
            'last_name' => $employee->last_name,
            'email' => $employee->email,
            'password' => Hash::make('defaultPassword123'), // Temporary password
            'role' => $role,
        ]);
    }

    return redirect()->route('newhires.index')->with('success', 'Employee profile created successfully!');
}




    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */


    /**
     * Update the specified resource in storage.
     */
    // Show the edit page
    public function edit(Employee $employee)
    {
        return view('employees.edit', compact('employee'));
    }

    // Update the employee
    public function update(Request $request, Employee $employee)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'name_extension' => 'nullable|string|max:10',
            'email' => 'required|email|unique:employees,email,'.$employee->id,
            'home_address' => 'nullable|string|max:500',
            'phone_number' => 'nullable|string|max:50',
            'department' => 'required|string|max:255',
            'job_category' => 'nullable|string|max:255',
            'reporting_manager' => 'required|string|max:255',
            'bank_name' => 'nullable|string|max:255',
            'account_number' => 'nullable|string|max:50',
        ]);

        // Update only editable fields
        $employee->update($validated);

        return redirect()->route('employees.index')->with('success', 'Employee updated successfully.');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    // In Employee model

    public function accessRights()
{
    $employees = Employee::all(); // or Employee::paginate(10) if you want pagination
    
    return view('admin.access-rights', compact('employees'));
}


}
