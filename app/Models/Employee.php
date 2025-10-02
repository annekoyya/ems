<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'new_hire_id',
        'first_name',
        'last_name',
        'middle_name',
        'name_extension',
        'date_of_birth',
        'home_address',
        'emergency_contact_name',
        'email',
        'emergency_contact_number',
        'phone_number',
        'relationship',
        'tin',
        'sss_number',
        'pagibig_number',
        'bank_name',
        'account_name',
        'account_number',
        'start_date',
        'department',
        'job_category',
        'employment_type',
        'reporting_manager',
    ];


        public function employee()
{
    return $this->hasOne(Employee::class, 'new_hire_id');
    // This is CORRECT: NewHire has one Employee
    // One NewHire can become one Employee
}

public function newHire()
{
    return $this->belongsTo(NewHire::class, 'new_hire_id');
}
}
