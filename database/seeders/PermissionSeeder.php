<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            // Roles Module
            [
                'name' => 'Add Role',
                'slug' => 'add.role',
                'module' => 'Roles',
            ],
            [
                'name' => 'Edit Role',
                'slug' => 'edit.role',
                'module' => 'Roles',
            ],
            [
                'name' => 'Update Role',
                'slug' => 'update.role',
                'module' => 'Roles',
            ],
            [
                'name' => 'Delete Role',
                'slug' => 'delete.role',
                'module' => 'Roles',
            ],

            // Users Module
            [
                'name' => 'Add User',
                'slug' => 'add.user',
                'module' => 'Users',
            ],
            [
                'name' => 'Edit User',
                'slug' => 'edit.user',
                'module' => 'Users',
            ],
            [
                'name' => 'Update User',
                'slug' => 'update.user',
                'module' => 'Users',
            ],
            [
                'name' => 'Delete User',
                'slug' => 'delete.user',
                'module' => 'Users',
            ],
            [
                'name' => 'View User',
                'slug' => 'view.user',
                'module' => 'Users',
            ],
            // Employees Module
            [
                'name' => 'View Employee',
                'slug' => 'view.employee',
                'module' => 'Employees',
            ],
            [
                'name' => 'Add Employee',
                'slug' => 'add.employee',
                'module' => 'Employees',
            ],
            [
                'name' => 'Edit Employee',
                'slug' => 'edit.employee',
                'module' => 'Employees',
            ],
            [
                'name' => 'Update Employee',
                'slug' => 'update.employee',
                'module' => 'Employees',
            ],
            [
                'name' => 'Delete Employee',
                'slug' => 'delete.employee',
                'module' => 'Employees',
            ],
            [
                'name' => 'Import Employee',
                'slug' => 'import.employee',
                'module' => 'Employees',
            ],
            [
                'name' => 'Export Employee',
                'slug' => 'export.employee',
                'module' => 'Employees',
            ],
        ];

        foreach ($permissions as $permission) {
            Permission::updateOrCreate(
                ['slug' => $permission['slug']],
                [
                    'name' => $permission['name'],
                    'module' => $permission['module'],
                    'slug' => $permission['slug'],
                ]
            );
        }
    }
}
