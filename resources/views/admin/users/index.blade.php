@extends('layouts.app')

@section('title', 'Users')

@section('page-header')
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
        <div>
            <h4 class="mb-1 fw-bold">Users</h4>
            <p class="text-muted mb-0">
                Manage users, assign roles and control system access.
            </p>
        </div>

        <a href="{{ route('users.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg me-1"></i>
            Add User
        </a>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('admin/css/users.css') }}">
    <style>
        /* Let the dropdown escape the table's scroll clipping while it's open */
        .table-responsive:has(.dropdown-menu.show) {
            overflow: visible;
        }
    </style>
@endpush

@section('content')

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="panel-card mb-4">
        <div class="panel-card-body">
            <form method="GET" action="{{ route('users.index') }}" class="row g-3 align-items-end">

                <div class="col-lg-4">
                    <label class="form-label">Search</label>
                    <input type="text" name="search" value="{{ request('search') }}"
                           class="form-control" placeholder="Search users...">
                </div>

                <div class="col-lg-2">
                    <label class="form-label">Role</label>
                    <select name="role" class="form-select">
                        <option value="">All Roles</option>
                        <option value="admin" @selected(request('role') === 'admin')>Admin</option>
                        <option value="hr" @selected(request('role') === 'hr')>HR</option>
                        <option value="employee" @selected(request('role') === 'employee')>Employee</option>
                    </select>
                </div>

                <div class="col-lg-2">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select">
                        <option value="">All Status</option>
                        <option value="active" @selected(request('status') === 'active')>Active</option>
                        <option value="inactive" @selected(request('status') === 'inactive')>Inactive</option>
                    </select>
                </div>

                <div class="col-lg-4 text-lg-end">
                    <button type="submit" class="btn btn-light">
                        <i class="bi bi-arrow-clockwise"></i>
                        Refresh
                    </button>

                    <button type="button" class="btn btn-light">
                        <i class="bi bi-download"></i>
                        Export
                    </button>
                </div>

            </form>
        </div>
    </div>


    <div class="panel-card">
        <div class="panel-card-body p-0">
            <div class="table-responsive">
                <table class="table dashboard-table align-middle mb-0">
                    <thead>
                        <tr>
                            <th>User</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Last Login</th>
                            <th width="70"></th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse ($users as $user)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="employee-avatar">
                                            {{ collect(explode(' ', $user->name))->map(fn($n) => strtoupper($n[0]))->take(2)->implode('') }}
                                        </div>
                                        <div>
                                            <div class="fw-semibold">
                                                {{ $user->name }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    {{ $user->email }}
                                </td>
                                <td>
                                    @forelse ($user->roles as $role)
                                        <span class="badge bg-primary-subtle text-primary border">
                                            {{ $role->name }}
                                        </span>
                                    @empty
                                        <span class="badge bg-secondary-subtle text-secondary border">N/A</span>
                                    @endforelse
                                </td>
                                <td>
                                    @if ($user->status === 'active')
                                        <span class="badge bg-success-subtle text-success border">Active</span>
                                    @else
                                        <span class="badge bg-secondary-subtle text-secondary border">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="text-muted">
                                        {{ $user->last_login_at?->diffForHumans() ?? 'Never' }}
                                    </span>
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-light" data-bs-toggle="dropdown"
                                                data-bs-display="static" aria-expanded="false">
                                            <i class="bi bi-three-dots-vertical"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li>
                                                <a class="dropdown-item" href="{{ route('users.edit', $user) }}">
                                                    <i class="bi bi-pencil me-2"></i>
                                                    Edit
                                                </a>
                                            </li>
                                            <li>
                                                <hr class="dropdown-divider">
                                            </li>
                                            <li>
                                                <form action="{{ route('users.destroy', $user) }}" method="POST"
                                                      onsubmit="return confirm('Delete this user?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item text-danger">
                                                        <i class="bi bi-trash me-2"></i>
                                                        Delete
                                                    </button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">
                                    No users found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-between align-items-center mt-4">

        <div class="text-muted">
            Showing {{ $users->firstItem() ?? 0 }} to {{ $users->lastItem() ?? 0 }} of {{ $users->total() }} users
        </div>

        {{ $users->links() }}

    </div>

@endsection