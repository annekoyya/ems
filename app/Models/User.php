<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; // so it works with Auth
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'employee_id',
        'first_name',
        'last_name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
    ];

    // Relationships
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    // Automatically hash passwords
    public function setPasswordAttribute($value)
{
    if (!empty($value)) {
        // Prevent double hashing
        $this->attributes['password'] =
            Hash::needsRehash($value) ? Hash::make($value) : $value;
    }
}
}
