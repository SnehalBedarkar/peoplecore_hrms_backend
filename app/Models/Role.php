<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use SoftDeletes;

    protected $hidden = ['pivot'];

    protected $fillable = [
        'name',
        'slug',
        'description',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // Role has many users (through pivot)
    public function users()
    {
        return $this->belongsToMany(User::class, 'role_user');
    }

    // Role has many permissions (through pivot)
    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'permission_role');
        // ->withPivot('assigned_by', 'assigned_at')
        // ->withTimestamps();
    }
}
