<?php

namespace App\Http\Controllers;

use App\Models\NewHire;
use App\Models\Employee;
use Illuminate\Http\Request;

class NewHireController extends Controller
{
    public function index(Request $request)
    {
        // Fix null dates
        NewHire::whereNull('date_submitted')->update(['date_submitted' => now()]);
        
        $query = NewHire::query();
        
        // Apply filters
        if ($request->filled('department')) {
            $query->where('department', $request->department);
        }
        
        if ($request->filled('position')) {
            $query->where('position', $request->position);
        }
        
        if ($request->filled('date_from')) {
            $query->whereDate('date_submitted', '>=', $request->date_from);
        }
        
        if ($request->filled('date_to')) {
            $query->whereDate('date_submitted', '<=', $request->date_to);
        }
        
        // Search by name
        if ($request->filled('search')) {
            $query->where('fullname', 'like', '%' . $request->search . '%');
        }
        
        $newHires = $query->paginate(10);
        
        // Get unique values for filters
        $departments = NewHire::distinct('department')->pluck('department')->filter();
        $positions = NewHire::distinct('position')->pluck('position')->filter();
        
        return view('newhires.index', compact('newHires', 'departments', 'positions'));
    }

    public function approve(NewHire $newHire)
    {
        // Redirect to employee creation form
        return redirect()->route('employees.create', $newHire);
    }

    public function destroy(NewHire $newHire)
    {
        $newHire->delete();
        return redirect()->route('newhires.index')->with('success', 'New hire removed successfully!');
    }
}