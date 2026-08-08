@extends('layouts.app')

@section('title', 'Create Role')

@section('content')
    <div class="container-fluid">

        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="mb-1">Create Role</h3>
                <p class="text-muted mb-0">
                    Create a new role and assign permissions.
                </p>
            </div>

            <a href="{{ route('roles.index') }}" class="btn btn-light">
                <i class="bi bi-arrow-left"></i>
                Back
            </a>
        </div>

        <form action="{{ route('roles.store') }}" method="POST">

            @csrf

            <div class="row">

                <!-- Left Side -->
                <div class="col-lg-4">

                    <div class="card shadow-sm mb-4">
                        <div class="card-header">
                            <h5 class="mb-0">Role Details</h5>
                        </div>

                        <div class="card-body">

                            <div class="mb-3">
                                <label class="form-label">
                                    Role Name
                                </label>

                                <input type="text" name="name"
                                    class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}"
                                    placeholder="Enter role name">

                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div>
                                <label class="form-label">
                                    Guard
                                </label>

                                <select name="guard_name" class="form-select">

                                    <option value="web">
                                        Web
                                    </option>

                                </select>
                            </div>

                        </div>
                    </div>

                </div>

                <!-- Right Side -->
                <div class="col-lg-8">

                    <div class="card shadow-sm">

                        <div class="card-header d-flex justify-content-between align-items-center">

                            <h5 class="mb-0">
                                Permissions
                            </h5>

                            <button type="button" id="checkAll" class="btn btn-sm btn-primary">

                                Select All

                            </button>

                        </div>

                        <div class="card-body">

                            @foreach ($permissions->groupBy('module') as $module => $modulePermissions)
                                <div class="border rounded p-3 mb-3">

                                    <div class="d-flex justify-content-between align-items-center mb-3">

                                        <h6 class="mb-0 text-capitalize">

                                            {{ $module }}

                                        </h6>

                                        <button type="button" class="btn btn-sm btn-outline-primary module-check">

                                            Select All

                                        </button>

                                    </div>

                                    <div class="row">

                                        @foreach ($modulePermissions as $permission)
                                            <div class="col-md-4 mb-2">

                                                <div class="form-check">

                                                    <input class="form-check-input permission-checkbox" type="checkbox"
                                                        name="permissions[]" value="{{ $permission->id }}"
                                                        id="permission{{ $permission->id }}">

                                                    <label class="form-check-label" for="permission{{ $permission->id }}">

                                                        {{ ucfirst(str_replace('_', ' ', $permission->name)) }}

                                                    </label>

                                                </div>

                                            </div>
                                        @endforeach

                                    </div>

                                </div>
                            @endforeach

                        </div>

                        <div class="card-footer text-end">

                            <button type="submit" class="btn btn-success">

                                <i class="bi bi-check-circle"></i>

                                Save Role

                            </button>

                        </div>

                    </div>

                </div>

            </div>

        </form>

    </div>
@endsection

@push('scripts')
    <script>
        $('#checkAll').click(function() {

            $('.permission-checkbox').prop(
                'checked',
                !$('.permission-checkbox:first').prop('checked')
            );

        });

        $('.module-check').click(function() {

            $(this)
                .closest('.border')
                .find('.permission-checkbox')
                .prop('checked', true);

        });
    </script>
@endpush
