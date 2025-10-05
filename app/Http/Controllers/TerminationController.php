<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; 
use App\Models\Employee;
use App\Models\Termination;

class TerminationController extends Controller
{
    public function index()
    {
        $terminations = Termination::with('employee')->paginate(10);
        return view('termination.index', compact('terminations'));
    }

    public function create(Employee $employee)
    {
        return view('termination.create', compact('employee'));
    }

    public function store(Request $request, Employee $employee)
    {
        $validated = $request->validate([
            'last_working_day' => 'required|date',
            'reason' => 'required|string|max:500',
            'documentation' => 'nullable|boolean',
            'exit_interview' => 'nullable|boolean',
            'clearance_form' => 'nullable|boolean',
            'final_pay_ack' => 'nullable|boolean',
        ]);

        $termination = new Termination();
        $termination->employee_id = $employee->id;
        $termination->last_working_day = $validated['last_working_day'];
        $termination->reason = $validated['reason'];
        $termination->documentation = $request->has('documentation');
        $termination->exit_interview = $request->has('exit_interview');
        $termination->clearance_form = $request->has('clearance_form');
        $termination->final_pay_ack = $request->has('final_pay_ack');
        $termination->save();

        // Delete the employee record
        $employee->delete();

        return redirect()->route('terminations.index')->with('success', 'Employee terminated successfully!');
    }
}