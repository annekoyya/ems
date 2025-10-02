<?php

namespace App\Http\Controllers;

use App\Models\NewHire;
use App\Models\Employee;
use Illuminate\Http\Request;

class NewHireController extends Controller
{

public function index(Request $request)
{

    // Temporary fix for null dates
    NewHire::whereNull('date_submitted')->update(['date_submitted' => now()]);
    
    // Rest of your code...
    $newHires = NewHire::all();
    $departments = NewHire::all()->pluck('department')->unique()->values();
    $positions = NewHire::all()->pluck('position')->unique()->values();
    
    return view('newhires.index', compact('newHires', 'departments', 'positions'));
    $query = NewHire::query();
    
    // Filter by department
    if ($request->has('department') && $request->department != '') {
        $query->where('department', $request->department);
    }
    
    // Filter by position
    if ($request->has('position') && $request->position != '') {
        $query->where('position', $request->position);
    }
    
    // Filter by date range
    if ($request->has('date_from') && $request->date_from != '') {
        $query->whereDate('date_submitted', '>=', $request->date_from);
    }
    
    if ($request->has('date_to') && $request->date_to != '') {
        $query->whereDate('date_submitted', '<=', $request->date_to);
    }

    $newHires = $query->get();
    
    // Get unique values for dropdowns - FIXED: Use correct collection method
    $departments = NewHire::select('department')->distinct()->get()->pluck('department');
    $positions = NewHire::select('position')->distinct()->get()->pluck('position');
    
    return view('newhires.index', compact('newHires', 'departments', 'positions'));
}
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'job_title' => 'required|string|max:255',
        'department' => 'required|string|max:255',
        'submitted_at' => 'nullable|date',
    ]);

    NewHire::create($validated);

    return redirect()->route('newhires.index')->with('success', 'New hire added!');
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function activate(NewHire $newHire)
{
    // Check if employee already exists (if you have the relationship)
    if ($newHire->employee) {
        return redirect()->route('new-hires.index')
            ->with('error', 'Employee profile already exists!');
    }

    // Create employee from new hire data
    $employee = Employee::create([
        'new_hire_id' => $newHire->id,
        'first_name' => $newHire->first_name,
        'last_name' => $newHire->last_name,
        'department' => $newHire->department,
        'job_category' => $newHire->position,
        'start_date' => $newHire->date_submitted,
        // Add any other fields you need
    ]);

    // HARD DELETE: Remove from new_hires table completely
    $newHire->delete();

    return redirect()->route('employees.index')
        ->with('success', 'Employee activated successfully! New hire removed from pending list.');
}

    
}
