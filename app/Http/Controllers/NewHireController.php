<?php

namespace App\Http\Controllers;

use App\Models\NewHire;
use App\Models\Employee;
use Illuminate\Http\Request;

class NewHireController extends Controller
{

public function index(Request $request)
    {
        $query = NewHire::query();

        // Filters
        if ($request->filled('department')) {
            $query->where('department', $request->department);
        }

        if ($request->filled('date_from')) {
            $query->whereDate('date_submitted', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('date_submitted', '<=', $request->date_to);
        }

        // Order newest first
        $newHires = $query->orderBy('date_submitted', 'desc')->get();

        // For department select options
        $departments = NewHire::query()
            ->select('department')
            ->distinct()
            ->whereNotNull('department')
            ->pluck('department')
            ->filter()
            ->values();

        return view('newhires.index', compact('newHires', 'departments'));
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
