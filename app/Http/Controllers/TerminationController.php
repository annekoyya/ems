<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; 
use App\Models\Employee;
use App\Models\Termination;


class TerminationController extends Controller
{
    public function create(Employee $employee)
    {
        // Pass the employee to the modal/view
        return view('terminations.create', compact('employee'));
    }

public function store(Request $request, Employee $employee)
{
    // Optional: save termination details
    $termination = new Termination();
    $termination->employee_id = $employee->id;
    $termination->last_working_day = $request->last_working_day;
    $termination->reason = $request->reason;
    $termination->documentation = $request->has('documentation');
    $termination->exit_interview = $request->has('exit_interview');
    $termination->clearance_form = $request->has('clearance_form');
    $termination->final_pay_ack = $request->has('final_pay_ack');
    $termination->save();

    // Delete or deactivate the employee
    $employee->delete(); // or $employee->update(['employee_status' => 'terminated']);

    return redirect()->route('employees.index')->with('success', 'Employee terminated successfully!');
}

}
