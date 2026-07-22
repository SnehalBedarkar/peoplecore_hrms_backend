<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Designation extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'code',
        'department_id',
        'description',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // Designation belongs to a department
    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    // All employees with this designation
    public function employees()
    {
        return $this->hasMany(Employee::class, 'designation_id');
    }
}
