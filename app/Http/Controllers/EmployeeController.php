<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeStoreRequest;
use App\Models\Department;
use App\Models\Designation;
use App\Models\Employee;
use App\Services\EmployeeService;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class EmployeeController extends Controller
{
    protected EmployeeService $employeeService;

    public function __construct(EmployeeService $employeeService)
    {
        $this->employeeService = $employeeService;
    }

    public function index()
    {
        return view('admin.employees.index');
    }

    public function getData(Request $request)
    {
        $query = Employee::with(['department', 'designation'])
            ->select('id', 'employee_code', 'department_id', 'designation_id', 'first_name', 'last_name', 'joining_date', 'email', 'status');

        return DataTables::eloquent($query)->make(true);
    }

    public function create()
    {
        $departments = Department::select('id', 'name')->get();
        $designations = Designation::select('id', 'name')->get();

        return view('admin.employees.create', compact('departments', 'designations'));
    }

    public function store(EmployeeStoreRequest $request)
    {
        try {
            $employee = $this->employeeService->store($request->validated());

            return redirect()
                ->route('employees.index')
                ->with('success', 'Employee created successfully.');
        } catch (\Throwable $th) {

            return back()
                ->withInput()
                ->with('error', $th->getMessage());
        }
    }

    public function show($id, EmployeeService $employeeService)
    {
        $employee = $employeeService->getEmployeeById($id);

        return view('admin.employees.show', compact('employee'));
    }
}
