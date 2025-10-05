<?php

namespace App\Http\Controllers;

use App\Models\NewHire;
use App\Models\Employee;
use Illuminate\Http\Request;

class NewHireController extends Controller
{
    public function index(Request $request)
    {
        NewHire::whereNull('date_submitted')->update(['date_submitted' => now()]);
        
        $query = NewHire::query();
        
        if ($request->filled('department')) {
            $query->where('department', $request->department);
        }
        
        if ($request->filled('position')) {
            $query->where('position', $request->position);
        }
        
        if ($request->filled('search')) {
            $query->where('fullname', 'like', '%' . $request->search . '%');
        }
        
        $newHires = $query->paginate(10);
        
        $departments = NewHire::distinct('department')->pluck('department')->filter();
        $positions = NewHire::distinct('position')->pluck('position')->filter();
        
        return view('newhires.index', compact('newHires', 'departments', 'positions'));
    }

    // Bulk approve selected new hires
    public function approveBulk(Request $request)
    {
        $request->validate([
            'selected' => 'required|array|min:1',
            'selected.*' => 'exists:new_hires,id'
        ]);

        $selectedIds = $request->selected;
        $newHires = NewHire::whereIn('id', $selectedIds)->get();

        foreach ($newHires as $newHire) {
            // Create employee with basic info from new hire
            Employee::create([
                'new_hire_id' => $newHire->id,
                'first_name' => explode(' ', $newHire->fullname)[0] ?? $newHire->fullname,
                'last_name' => explode(' ', $newHire->fullname)[1] ?? '',
                'email' => strtolower(str_replace(' ', '.', $newHire->fullname)) . '@bluelotus.com',
                'department' => $newHire->department,
                'job_category' => $newHire->position,
                'start_date' => $newHire->date_submitted,
                'date_of_birth' => now()->subYears(25), // Default age
                'employment_type' => 'Full time',
                'reporting_manager' => 'TBD',
            ]);

            $newHire->delete();
        }

        return redirect()->route('employees.index')
            ->with('success', count($selectedIds) . ' new hire(s) approved and added to employees!');
    }

    public function approve(NewHire $newHire)
    {
        return redirect()->route('employees.create', $newHire);
    }

    public function destroy(NewHire $newHire)
    {
        $newHire->delete();
        return redirect()->route('newhires.index')->with('success', 'New hire removed successfully!');
    }
}