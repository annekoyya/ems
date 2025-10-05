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

        // Create employee from new hire
        $validated['new_hire_id'] = $newHire->id;
        
        Employee::create($validated);

        // Delete the new hire record
        $newHire->delete();

        return redirect()->route('employees.index')->with('success', 'Employee profile created successfully!');
    }

    public function edit(Employee $employee)
    {
        return view('employees.edit', compact('employee'));
    }

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

        $employee->update($validated);

        return redirect()->route('employees.index')->with('success', 'Employee updated successfully.');
    }
}