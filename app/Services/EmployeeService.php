<?php

namespace App\Services;

use App\Repositories\EmployeeRepository;

class EmployeeService
{
    protected $employeeRepo;

    public function __construct(EmployeeRepository $employeeRepo)
    {
        $this->employeeRepo = $employeeRepo;
    }

    /**
     * Get all employees
     */
    public function getAllEmployees(
        $search = null,
        $sortBy = 'id',
        $sortDir = 'asc',
        $perPage = 10,
        $page = 1
    ) {
        $allowedSortColumns = [
            'id', 'employee_code', 'first_name', 'email',
            'mobile_number', 'gender', 'date_of_birth',
            'joining_date', 'employment_type', 'status',
        ];

        $sortBy = in_array($sortBy, $allowedSortColumns) ? $sortBy : 'id';
        $sortDir = in_array($sortDir, ['asc', 'desc']) ? $sortDir : 'asc';

        $employees = $this->employeeRepo->getEmployees(
            search: $search,
            sortBy: $sortBy,
            sortDir: $sortDir,
            perPage: $perPage,
            page: $page,
        );

        return [
            'data' => $employees->map(function ($emp) {
                return [
                    'id' => $emp->id,
                    'employee_code' => $emp->employee_code,
                    'full_name' => $emp->first_name.' '.$emp->last_name,
                    'email' => $emp->email,
                    'mobile_number' => $emp->mobile_number,
                    'gender' => $emp->gender,
                    'date_of_birth' => $emp->date_of_birth,
                    'joining_date' => $emp->joining_date,
                    'employment_type' => $emp->employment_type,
                    'status' => $emp->status,
                    'department' => $emp->department->name ?? null,
                    'designation' => $emp->designation->name ?? null,
                ];
            }),
            'meta' => [
                'total' => $employees->total(),
                'per_page' => $employees->perPage(),
                'current_page' => $employees->currentPage(),
                'last_page' => $employees->lastPage(),
                'from' => $employees->firstItem(),
                'to' => $employees->lastItem(),
            ],
        ];
    }

    /**
     * Create new employee
     */
    public function store(array $data)
    {

        return $this->employeeRepo->create($data);
    }

    public function getEmployeeById($id)
    {
        return $this->employeeRepo->getEmployeeById($id);
    }
}
