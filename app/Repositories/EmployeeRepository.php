<?php

namespace App\Repositories;

use App\Models\Department;
use App\Models\Employee;

class EmployeeRepository
{
    public function getEmployees(
        $search = null,
        $sortBy = 'id',
        $sortDir = 'asc',
        $perPage = 10,
        $page = 1
    ) {
        $query = Employee::select(
            'id',
            'employee_code',
            'department_id',
            'designation_id',
            'first_name',
            'last_name',
            'email',
            'mobile_number',
            'gender',
            'date_of_birth',
            'joining_date',
            'employment_type',
            'status'
        )
            ->with(['department', 'designation']);

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                    ->orWhere('last_name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('mobile_number', 'like', "%{$search}%")
                    ->orWhere('employee_code', 'like', "%{$search}%");
            });
        }

        $query->orderBy($sortBy, $sortDir);

        return $query->paginate($perPage, ['*'], 'page', $page);
    }

    public function create(array $data)
    {
        return Employee::create([
            'department_id' => $data['department_id'] ?? null,
            'designation_id' => $data['designation_id'] ?? null,
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'mobile_number' => $data['mobile_number'],
            'gender' => $data['gender'],
            'date_of_birth' => $data['date_of_birth'] ?? null,
            'joining_date' => $data['joining_date'] ?? null,
            'employment_type' => $data['employment_type'] ?? null,
            'status' => $data['status'] ?? true,
        ]);
    }

    public function getTotalCount()
    {
        return Employee::count();
    }

    public function getActiveCount()
    {
        return Employee::where('status', 1)->count();
    }

    public function getEmployeesByDepartmentCount()
    {
        return Department::select('departments.id', 'departments.name')
            ->withCount(['employees' => function ($query) {
                $query->where('status', 1);
            }])
            ->orderByDesc('employees_count')
            ->get()
            ->map(fn ($dept) => [
                'department' => $dept->name,
                'count' => $dept->employees_count,
            ]);
    }

    public function getEmployeeById($id)
    {
        $employee = Employee::select(
            'id',
            'first_name',
            'last_name',
            'gender',
            'date_of_birth',
            'mobile_number',
            'email',
            'designation_id',
            'department_id',
            'joining_date'
        )->with([
            'designation:id,name',
            'department:id,name',
        ])->findOrFail($id);

        return $employee;
    }
}
