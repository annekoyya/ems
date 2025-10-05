<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Termination extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'last_working_day',
        'reason',
        'documentation',
        'exit_interview',
        'clearance_form',
        'final_pay_acknowledgment',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
