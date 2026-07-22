<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'code',
        'description',
        'parent_id',
        'manager_id',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // Self-referencing — parent department
    public function parent()
    {
        return $this->belongsTo(Department::class, 'parent_id');
    }

    // Self-referencing — child departments
    public function children()
    {
        return $this->hasMany(Department::class, 'parent_id');
    }

    // Department manager
    public function manager()
    {
        return $this->belongsTo(Employee::class, 'manager_id');
    }

    // All employees in this department
    public function employees()
    {
        return $this->hasMany(Employee::class, 'department_id');
    }

    // All designations in this department
    public function designations()
    {
        return $this->hasMany(Designation::class, 'department_id');
    }
}
