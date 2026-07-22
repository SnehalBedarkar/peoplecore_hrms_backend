@extends('layouts.app')

@section('title', 'Add Employee')

@section('page-header')
    <nav aria-label="breadcrumb" class="mb-2">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item">
                <a href="{{ route('employees.index') }}">Employees</a>
            </li>
            <li class="breadcrumb-item active">Add Employee</li>
        </ol>
    </nav>

    <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-3">
        <div>
            <h2 class="fw-bold mb-1">Add Employee</h2>
            <p class="text-muted mb-0">
                Create a new employee record with personal, contact and employment details.
            </p>
        </div>

        <div class="d-flex gap-2">
            <a href="{{ route('employees.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left me-2"></i>
                Back to Employees
            </a>
        </div>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('admin/css/employees/create.css') }}">
@endpush

@section('content')

    <form action="{{ route('employees.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row g-3">

            {{-- ============ LEFT COLUMN: Photo + Status ============ --}}
            <div class="col-lg-4">

                <div class="card border-0 shadow-sm mb-3">
                    <div class="card-body text-center">

                        <div class="mb-3">
                            <img id="photoPreview" src="{{ asset('images/default-avatar.png') }}"
                                class="rounded-circle border" width="120" height="120" style="object-fit: cover;"
                                alt="Employee photo preview">
                        </div>

                        <label for="photo" class="btn btn-outline-secondary btn-sm">
                            <i class="bi bi-camera me-1"></i>
                            Upload Photo
                        </label>
                        <input type="file" name="photo" id="photo" class="d-none" accept="image/*">

                        <div class="form-text mt-2">
                            JPG or PNG. Max 2MB.
                        </div>

                        @error('photo')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror

                    </div>
                </div>

                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-transparent fw-semibold">
                        Status
                    </div>
                    <div class="card-body">

                        <label class="form-label">Employee Status</label>
                        <select name="status" class="form-select @error('status') is-invalid @enderror">
                            <option value="1" selected>Active</option>
                            <option value="0">Inactive</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        <div class="form-text mt-2">
                            Inactive employees won't appear in active employee lists or payroll runs.
                        </div>

                    </div>
                </div>

            </div>

            {{-- ============ RIGHT COLUMN: Form sections ============ --}}
            <div class="col-lg-8">

                {{-- ---------- Personal Information ---------- --}}
                <div class="card border-0 shadow-sm mb-3">
                    <div class="card-header bg-transparent fw-semibold">
                        Personal Information
                    </div>
                    <div class="card-body">

                        <div class="row g-3">

                            <div class="col-md-6">
                                <label for="first_name" class="form-label">
                                    First Name <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="first_name" id="first_name" maxlength="30"
                                    value="{{ old('first_name') }}"
                                    class="form-control @error('first_name') is-invalid @enderror" placeholder="e.g. John"
                                    required>
                                @error('first_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="last_name" class="form-label">
                                    Last Name <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="last_name" id="last_name" maxlength="30"
                                    value="{{ old('last_name') }}"
                                    class="form-control @error('last_name') is-invalid @enderror" placeholder="e.g. Doe"
                                    required>
                                @error('last_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="gender" class="form-label">
                                    Gender <span class="text-danger">*</span>
                                </label>
                                <select name="gender" id="gender"
                                    class="form-select @error('gender') is-invalid @enderror" required>
                                    <option value="" disabled selected>Select gender</option>
                                    <option value="male" @selected(old('gender') == 'male')>Male</option>
                                    <option value="female" @selected(old('gender') == 'female')>Female</option>
                                </select>
                                @error('gender')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="date_of_birth" class="form-label">
                                    Date of Birth
                                </label>
                                <input type="date" name="date_of_birth" id="date_of_birth"
                                    value="{{ old('date_of_birth') }}" max="{{ now()->subYears(18)->format('Y-m-d') }}"
                                    class="form-control @error('date_of_birth') is-invalid @enderror">
                                @error('date_of_birth')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>

                    </div>
                </div>

                {{-- ---------- Contact Information ---------- --}}
                <div class="card border-0 shadow-sm mb-3">
                    <div class="card-header bg-transparent fw-semibold">
                        Contact Information
                    </div>
                    <div class="card-body">

                        <div class="row g-3">

                            <div class="col-md-6">
                                <label for="email" class="form-label">
                                    Email <span class="text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                    <input type="email" name="email" id="email" value="{{ old('email') }}"
                                        class="form-control @error('email') is-invalid @enderror"
                                        placeholder="john@example.com" required>
                                </div>
                                @error('email')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="mobile_number" class="form-label">
                                    Mobile Number <span class="text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-telephone"></i></span>
                                    <input type="text" name="mobile_number" id="mobile_number" maxlength="15"
                                        value="{{ old('mobile_number') }}"
                                        class="form-control @error('mobile_number') is-invalid @enderror"
                                        placeholder="9876543210" required>
                                </div>
                                @error('mobile_number')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>

                    </div>
                </div>

                {{-- ---------- Employment Details ---------- --}}
                <div class="card border-0 shadow-sm mb-3">
                    <div class="card-header bg-transparent fw-semibold">
                        Employment Details
                    </div>
                    <div class="card-body">

                        <div class="row g-3">

                            <div class="col-md-6">
                                <label for="employee_code" class="form-label">
                                    Employee Code
                                </label>
                                <input type="text" name="employee_code" id="employee_code"
                                    value="{{ old('employee_code') }}"
                                    class="form-control @error('employee_code') is-invalid @enderror"
                                    placeholder="Auto-generated if left blank">
                                @error('employee_code')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="joining_date" class="form-label">
                                    Joining Date
                                </label>
                                <input type="date" name="joining_date" id="joining_date"
                                    value="{{ old('joining_date') }}"
                                    class="form-control @error('joining_date') is-invalid @enderror">
                                @error('joining_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="department_id" class="form-label">
                                    Department
                                </label>
                                <select name="department_id" id="department_id"
                                    class="form-select @error('department_id') is-invalid @enderror">
                                    <option value="" selected>Select department</option>
                                    @foreach ($departments ?? [] as $department)
                                        <option value="{{ $department->id }}" @selected(old('department_id') == $department->id)>
                                            {{ $department->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('department_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="designation_id" class="form-label">
                                    Designation
                                </label>
                                <select name="designation_id" id="designation_id"
                                    class="form-select @error('designation_id') is-invalid @enderror">
                                    <option value="" selected>Select designation</option>
                                    @foreach ($designations ?? [] as $designation)
                                        <option value="{{ $designation->id }}" @selected(old('designation_id') == $designation->id)>
                                            {{ $designation->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('designation_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="employment_type" class="form-label">
                                    Employment Type
                                </label>
                                <select name="employment_type" id="employment_type"
                                    class="form-select @error('employment_type') is-invalid @enderror">
                                    <option value="" selected>Select type</option>
                                    <option value="full_time" @selected(old('employment_type') == 'full_time')>Full Time</option>
                                    <option value="part_time" @selected(old('employment_type') == 'part_time')>Part Time</option>
                                    <option value="contract" @selected(old('employment_type') == 'contract')>Contract</option>
                                    <option value="intern" @selected(old('employment_type') == 'intern')>Intern</option>
                                </select>
                                @error('employment_type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>

                    </div>
                </div>

                {{-- ---------- Actions ---------- --}}
                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('employees.index') }}" class="btn btn-outline-secondary">
                        Cancel
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-lg me-2"></i>
                        Save Employee
                    </button>
                </div>

            </div>

        </div>

    </form>

@endsection

@push('scripts')
    <script>
        (function() {
            "use strict";
            const photoInput = document.getElementById("photo");
            const photoPreview = document.getElementById("photoPreview");

            if (photoInput && photoPreview) {
                photoInput.addEventListener("change", function() {
                    const file = this.files && this.files[0];
                    if (!file) return;
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        photoPreview.src = e.target.result;
                    };
                    reader.readAsDataURL(file);
                });
            }
        })();
    </script>
@endpush
