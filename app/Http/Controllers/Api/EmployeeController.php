<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeStoreRequest;
use App\Models\Employee;
use App\Services\EmployeeService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class EmployeeController extends Controller
{
    use AuthorizesRequests;

    protected $employeeService;

    public function __construct(EmployeeService $employeeService)
    {
        $this->employeeService = $employeeService;
    }

    public function index(Request $request)
    {
        try {
            $this->authorize('viewAny', Employee::class);

            $result = $this->employeeService->getAllEmployees(
                search: $request->input('search'),
                sortBy: $request->input('sort_by', 'id'),
                sortDir: $request->input('sort_dir', 'asc'),
                perPage: $request->input('per_page', 10),
                page: $request->input('page', 1),
            );

            return response()->json([
                'success' => true,
                'message' => 'Employees Fetched Successfully',
                'data' => $result['data'],
                'meta' => $result['meta'],
            ], 200);

        } catch (\Throwable $th) {
            Log::error('Error in fetching employees: '.$th->getMessage());

            return response()->json([
                'success' => false,
                'error' => 'Error in fetching employees',
            ], 500);
        }
    }

    public function store(EmployeeStoreRequest $request)
    {
        try {
            $this->authorize('create', Employee::class);

            $data = $request->validated();

            $employee = $this->employeeService->store($data);

            return response()->json([
                'success' => true,
                'message' => 'Employee Added Successfully',
                'data' => $employee,
            ], 201);

        } catch (\Throwable $th) {
            // dd($th->getMessage());
            Log::error('Error in adding employee'.$th->getMessage());

            return response()->json([
                'success' => false,
                'error' => 'Error in adding employee',
            ], 500);
        }
    }

    public function edit($id)
    {
        try {
            $employee = $this->employeeService->getEmployeeById($id);

            if (! $employee) {
                return response()->json([
                    'success' => false,
                    'message' => 'Employee Not Found',
                ], 404);
            }

            return response()->json([
                'success' => true,
                'employee' => $employee,
            ], 200);
        } catch (\Throwable $th) {
            Log::error('Error in fetching Employee '.$th->getMessage());

            return response()->json([
                'success' => false,
                'error' => 'Error in fetching employee',
            ], 500);
        }
    }

    public function show(int $id)
    {
        try {
            $employee = $this->employeeService->getEmployeeById($id);

            return response()->json([
                'success' => true,
                'employee' => $employee,
            ], 200);

        } catch (\Throwable $th) {
            Log::error('Error in fetching employee '.$th->getMessage());

            return response()->json([
                'success' => false,
                'error' => 'Error in fetching employee',
            ], 500);
        }
    }

    public function update($id)
    {
        try {
            $employee = Employee::findOrFail($id);

            return response()->json([
                'success' => true,
                'messasge' => 'Employee Updated Successfully',
            ], 200);

        } catch (\Throwable $th) {
            Log::error('Error in updating employee '.$th->getMessage());

            return response()->json([
                'success' => true,
                'error' => 'Error in updating employee',
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $employee = $this->employeeService->getEmployeeById($id);
            $employee->delete();

            return response()->json([
                'success' => true,
                'message' => 'Employee Deleted Successfully',
            ], 200);

        } catch (\Throwable $th) {
            Log::error('Error in deleting employee: '.$th->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Error deleting employee',
            ], 500);
        }
    }
}
