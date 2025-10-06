<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NewHire;
use App\Models\Employee;
use Barryvdh\DomPDF\Facade\Pdf;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        $query = Employee::query();
        
        // Apply search filter
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                  ->orWhere('last_name', 'like', "%{$search}%")
                  ->orWhereRaw("CONCAT(first_name, ' ', last_name) like ?", ["%{$search}%"]);
            });
        }
        
        // Apply department filter
        if ($request->filled('department')) {
            $query->where('department', $request->department);
        }
        
        // Apply job category filter
        if ($request->filled('job_category')) {
            $query->where('job_category', $request->job_category);
        }
        
        $employees = $query->paginate(10);
        
        // Get unique values for filters
        $departments = Employee::distinct('department')->pluck('department')->filter();
        $jobTitles = Employee::distinct('job_category')->pluck('job_category')->filter();
        
        return view('employees.index', compact('employees', 'departments', 'jobTitles'));
    }

    // Direct add employee (without new hire approval)
    public function storeDirect(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'date_of_birth' => 'required|date',
            'email' => 'required|email|unique:employees,email',
            'phone_number' => 'nullable|string|max:50',
            'home_address' => 'nullable|string|max:500',
            'department' => 'required|string|max:255',
            'job_category' => 'required|string|max:255',
            'start_date' => 'required|date',
            'employment_type' => 'nullable|string|max:100',
            'reporting_manager' => 'required|string|max:255',
        ]);

        Employee::create($validated);

        return redirect()->route('employees.index')->with('success', 'Employee added successfully!');
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

    public function create(NewHire $newHire)
    {
        return view('employees.create', compact('newHire'));
    }

    public function store(Request $request, NewHire $newHire)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'name_extension' => 'nullable|string|max:10',
            'date_of_birth' => 'required|date',
            'home_address' => 'nullable|string|max:500',
            'phone_number' => 'nullable|string|max:50',
            'email' => 'required|email|unique:employees,email',
            'emergency_contact_name' => 'nullable|string|max:255',
            'emergency_contact_number' => 'nullable|string|max:50',
            'relationship' => 'nullable|string|max:100',
            'tin' => 'nullable|string|max:50',
            'sss_number' => 'nullable|string|max:50',
            'pagibig_number' => 'nullable|string|max:50',
            'bank_name' => 'nullable|string|max:255',
            'account_name' => 'nullable|string|max:255',
            'account_number' => 'nullable|string|max:50',
            'start_date' => 'required|date',
            'department' => 'required|string|max:255',
            'job_category' => 'nullable|string|max:255',
            'employment_type' => 'nullable|string|max:100',
            'reporting_manager' => 'required|string|max:255',
        ]);

        $validated['new_hire_id'] = $newHire->id;
        
        Employee::create($validated);
        $newHire->delete();

        return redirect()->route('employees.index')->with('success', 'Employee profile created successfully!');
    }

    // public function edit(Employee $employee)
    // {
    //     return view('employees.edit', compact('employee'));
    // }

    // public function update(Request $request, Employee $employee)
    // {
    //     $validated = $request->validate([
    //         'first_name' => 'required|string|max:255',
    //         'last_name' => 'required|string|max:255',
    //         'middle_name' => 'nullable|string|max:255',
    //         'name_extension' => 'nullable|string|max:10',
    //         'email' => 'required|email|unique:employees,email,'.$employee->id,
    //         'home_address' => 'nullable|string|max:500',
    //         'phone_number' => 'nullable|string|max:50',
    //         'department' => 'required|string|max:255',
    //         'job_category' => 'nullable|string|max:255',
    //         'reporting_manager' => 'required|string|max:255',
    //         'bank_name' => 'nullable|string|max:255',
    //         'account_number' => 'nullable|string|max:50',
    //     ]);

    //     $employee->update($validated);

    //     return redirect()->route('employees.index')->with('success', 'Employee updated successfully.');
    // }
        // Show the edit form
    public function edit(Employee $employee)
    {
        return view('employees.edit', compact('employee'));
    }

    // Update employee
    public function update(Request $request, Employee $employee)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'name_extension' => 'nullable|string|max:10',
            'date_of_birth' => 'nullable|date',
            'home_address' => 'nullable|string',
            'emergency_contact_name' => 'nullable|string|max:255',
            'email' => 'required|email|unique:employees,email,' . $employee->id,
            'emergency_contact_number' => 'nullable|string|max:20',
            'phone_number' => 'nullable|string|max:20',
            'relationship' => 'nullable|string|max:255',
            'start_date' => 'nullable|date',
            'job_category' => 'nullable|string|max:255',
            'department' => 'nullable|string|max:255',
            'work_status' => 'nullable|string|max:255',
            'reporting_manager' => 'nullable|string|max:255',
            'employment_type' => 'nullable|string|max:255',
        ]);

        $employee->update($validated);

        return redirect()->route('employees.index')->with('success', 'Employee updated successfully!');
    }

    // Show terminate form
    public function terminateForm(Employee $employee)
    {
        return view('employees.terminate', compact('employee'));
    }

    // Process termination
    public function terminate(Request $request, Employee $employee)
    {
        $validated = $request->validate([
            'termination_date' => 'required|date',
            'last_working_day' => 'required|date',
            'termination_reason' => 'required|string',
            'required_paperwork' => 'required|string',
        ]);

        // Update employee status
        $employee->update([
            'department' => $request->input('department'),
            'status' => 'terminated',
            'termination_date' => $validated['termination_date'],
            'last_working_day' => $validated['last_working_day'],
            'termination_reason' => $validated['termination_reason'],
            'required_paperwork' => $validated['required_paperwork'],
        ]);

        return redirect()->route('employees.index')->with('success', 'Employee terminated successfully!');
    }

    // Show view profile
    public function show(Employee $employee)
    {
        return view('employees.view', compact('employee'));
    }
}

    