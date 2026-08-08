@extends('layouts.app')

@section('title', 'Roles')

@section('content')
    <div class="container-fluid">

        <!-- Page Header -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h3 class="mb-0">Roles</h3>
                <small class="text-muted">Manage application roles</small>
            </div>

            <a href="{{ route('roles.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle me-1"></i>
                Create Role
            </a>
        </div>

        <!-- Card -->
        <div class="card shadow-sm">
            <div class="card-header">
                <h5 class="mb-0">Role List</h5>
            </div>

            <div class="card-body">

                <div class="table-responsive">
                    <table id="rolesTable" class="table table-bordered table-hover align-middle w-100">
                        <thead>
                            <tr>
                                <th width="70">#</th>
                                <th>Name</th>
                                <th>Permissions</th>
                                <th>Created At</th>
                                <th width="150">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($roles as $index => $role)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $role->name }}</td>
                                    <td>
                                        @forelse($role->permissions as $permission)
                                            <span class="badge bg-primary me-1 mb-1">
                                                {{ $permission->name }}
                                            </span>
                                        @empty
                                            <span class="badge bg-secondary">
                                                No Permissions
                                            </span>
                                        @endforelse
                                    </td>
                                    <td>{{ $role->created_at->format('d M Y') }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-primary editRole" data-id="{{ $role->id }}">
                                            <i class="bi bi-pencil"></i>
                                        </button>

                                        <button class="btn btn-sm btn-danger deleteRole" data-id="{{ $role->id }}">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">
                                        No roles found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

    </div>
@endsection

@push('scripts')
    <script>
        $(function() {

            $('#rolesTable').DataTable({
                processing: true,
                serverSide: true,


                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        searchable: false,
                        orderable: false
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'guard_name',
                        name: 'guard_name'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        searchable: false,
                        orderable: false
                    }
                ]
            });

        });
    </script>
@endpush
