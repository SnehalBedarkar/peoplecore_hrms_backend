<?php

namespace App\Services;

use App\Repositories\EmployeeRepository;

class DashboardService
{
    public function __construct(
        protected EmployeeRepository $employeeRepo,
    ) {}

    public function getSummary(): array
    {
        return [
            'total_employees' => $this->employeeRepo->getTotalCount(),
            'active_employees' => $this->employeeRepo->getActiveCount(),
        ];
    }
}
