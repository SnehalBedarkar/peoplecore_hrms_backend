<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'employee_code',
        'first_name',
        'last_name',
        'email',
        'mobile_number',
        'gender',
        'date_of_birth',
        'department_id',
        'designation_id',
        'employment_type',
        'status',
        'date_of_joining',
    ];

    protected static function booted()
    {
        static::created(function ($employee) {
            $employee->employee_code = 'EMP'.str_pad($employee->id, 4, '0', STR_PAD_LEFT);
            $employee->saveQuietly();
        });
    }

    protected $casts = [
        'date_of_birth' => 'date',
        'date_of_joining' => 'date',
    ];

    // Full name accessor
    public function getFullNameAttribute()
    {
        return $this->first_name.' '.$this->last_name;
    }

    // Employee belongs to a department
    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    // Employee belongs to a designation
    public function designation()
    {
        return $this->belongsTo(Designation::class, 'designation_id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'employee_id');
    }
}
