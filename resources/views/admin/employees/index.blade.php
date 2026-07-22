@extends('layouts.app')

@section('title', 'Employees')

@section('page-header')
    <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-3">
        <div>
            <h2 class="fw-bold mb-1">Employees</h2>
            <p class="text-muted mb-0">
                Manage employee records, departments and employment information.
            </p>
        </div>

        <div class="d-flex gap-2">
            <button class="btn btn-outline-secondary">
                <i class="bi bi-download me-2"></i>
                Export
            </button>

            <a href="{{ route('employees.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-lg me-2"></i>
                Add Employee
            </a>
        </div>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('admin/css/employees/index.css') }}">
@endpush

@section('content')

    <div class="row g-3 mb-4">

        <div class="col-xl-3 col-md-6">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <div class="text-muted small mb-2">
                        Total Employees
                    </div>

                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="fw-bold mb-0">245</h3>

                        <div class="rounded-circle bg-primary-subtle p-3">
                            <i class="bi bi-people text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <div class="text-muted small mb-2">
                        Active
                    </div>

                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="fw-bold mb-0">228</h3>

                        <div class="rounded-circle bg-success-subtle p-3">
                            <i class="bi bi-person-check text-success"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <div class="text-muted small mb-2">
                        On Leave
                    </div>

                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="fw-bold mb-0">8</h3>

                        <div class="rounded-circle bg-warning-subtle p-3">
                            <i class="bi bi-calendar-week text-warning"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <div class="text-muted small mb-2">
                        Departments
                    </div>

                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="fw-bold mb-0">12</h3>

                        <div class="rounded-circle bg-info-subtle p-3">
                            <i class="bi bi-diagram-3 text-info"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="card border-0 shadow-sm">

        <div class="card-header bg-transparent">

            <div class="row g-3 align-items-center">

                <div class="col-lg-4">

                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="bi bi-search"></i>
                        </span>

                        <input type="text" class="form-control" placeholder="Search employees...">
                    </div>

                </div>

                <div class="col-lg-8">

                    <div class="d-flex justify-content-lg-end flex-wrap gap-2">

                        <select class="form-select w-auto">
                            <option>All Departments</option>
                            <option>IT</option>
                            <option>HR</option>
                            <option>Finance</option>
                        </select>

                        <select class="form-select w-auto">
                            <option>All Status</option>
                            <option>Active</option>
                            <option>Inactive</option>
                            <option>On Leave</option>
                        </select>

                        <button class="btn btn-outline-secondary">
                            <i class="bi bi-funnel me-1"></i>
                            Filter
                        </button>

                    </div>

                </div>

            </div>

        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0" id="employeesTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Employee</th>
                        <th>Department</th>
                        <th>Designation</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Status</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
            </table>
        </div>



    </div>

@endsection

@push('scripts')
    <script src="{{ asset('admin/js/employees/index.js') }}"></script>
@endpush
