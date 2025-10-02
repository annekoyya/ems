<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class NewHire extends Model
{
    protected $fillable = [
        'fullname',
        'department', 
        'position',
        'date_submitted',
    ];

    protected $casts = [
        'date_submitted' => 'date',
    ];

public function employee()
{
    return $this->hasOne(Employee::class, 'new_hire_id');
}
}
