@extends('layouts.app')

@section('title', 'Dashboard')

@section('page-header')
    <h4 class="mb-0 fw-bold">Dashboard</h4>
    <p class="text-muted mb-0">Welcome back, here's what's happening today.</p>
@endsection

@push('styles')
    <link href="{{ asset('admin/css/dashboard.css') }}" rel="stylesheet">
@endpush

@section('content')

    {{-- ===================== Stat cards ===================== --}}
    {{--
        $stats would normally come from the controller, e.g.:
            return view('dashboard', ['stats' => $this->dashboardService->getSummary()]);
        Hardcoded here so the page is viewable standalone; swap the literals
        below for $stats->total_employees etc. once that method exists.
    --}}
    <div class="row g-4 mb-4">
        <div class="col-sm-6 col-xl-3">
            <div class="stat-card">
                <div class="stat-icon bg-primary-soft text-primary">
                    <i class="bi bi-people-fill"></i>
                </div>
                <div class="stat-body">
                    <p class="stat-label">Total Employees</p>
                    <h3 class="stat-value">142</h3>
                    <span class="stat-trend trend-up"><i class="bi bi-arrow-up-short"></i> 4 this month</span>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="stat-card">
                <div class="stat-icon bg-success-soft text-success">
                    <i class="bi bi-calendar-check-fill"></i>
                </div>
                <div class="stat-body">
                    <p class="stat-label">Present Today</p>
                    <h3 class="stat-value">128</h3>
                    <span class="stat-trend trend-neutral">90% attendance</span>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="stat-card">
                <div class="stat-icon bg-warning-soft text-warning">
                    <i class="bi bi-calendar-x-fill"></i>
                </div>
                <div class="stat-body">
                    <p class="stat-label">On Leave</p>
                    <h3 class="stat-value">6</h3>
                    <span class="stat-trend trend-neutral">4.2% of staff</span>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="stat-card">
                <div class="stat-icon bg-danger-soft text-danger">
                    <i class="bi bi-hourglass-split"></i>
                </div>
                <div class="stat-body">
                    <p class="stat-label">Pending Approvals</p>
                    <h3 class="stat-value">4</h3>
                    <span class="stat-trend trend-down"><i class="bi bi-arrow-down-short"></i> 2 since yesterday</span>
                </div>
            </div>
        </div>
    </div>

    {{-- ===================== Chart + Quick Actions ===================== --}}
    <div class="row g-4 mb-4">

        {{-- Attendance trend chart --}}
        <div class="col-xl-8">
            <div class="panel-card h-100">
                <div class="panel-card-header">
                    <div>
                        <h6 class="panel-title">Attendance Overview</h6>
                        <p class="panel-subtitle">Last 7 days</p>
                    </div>
                    <select class="form-select form-select-sm panel-select" style="width: auto;">
                        <option>This Week</option>
                        <option>Last Week</option>
                        <option>This Month</option>
                    </select>
                </div>
                <div class="panel-card-body">
                    <canvas id="attendanceChart" height="260"></canvas>
                </div>
            </div>
        </div>

        {{-- Quick actions --}}
        <div class="col-xl-4">
            <div class="panel-card h-100">
                <div class="panel-card-header">
                    <h6 class="panel-title">Quick Actions</h6>
                </div>
                <div class="panel-card-body quick-actions-body">
                    <a href="{{ Route::has('attendance.create') ? route('attendance.create') : '#' }}"
                        class="quick-action-item">
                        <span class="quick-action-icon bg-primary-soft text-primary"><i class="bi bi-clock-fill"></i></span>
                        <span class="quick-action-text">
                            <span class="quick-action-title">Mark Attendance</span>
                            <span class="quick-action-desc">Log today's check-in/out</span>
                        </span>
                        <i class="bi bi-chevron-right quick-action-arrow"></i>
                    </a>
                    <a href="{{ Route::has('leaves.index') ? route('leaves.index') : '#' }}" class="quick-action-item">
                        <span class="quick-action-icon bg-warning-soft text-warning"><i
                                class="bi bi-check2-square"></i></span>
                        <span class="quick-action-text">
                            <span class="quick-action-title">Approve Leave Requests</span>
                            <span class="quick-action-desc">4 requests waiting</span>
                        </span>
                        <i class="bi bi-chevron-right quick-action-arrow"></i>
                    </a>
                    <a href="{{ Route::has('employees.create') ? route('employees.create') : '#' }}"
                        class="quick-action-item">
                        <span class="quick-action-icon bg-success-soft text-success"><i
                                class="bi bi-person-plus-fill"></i></span>
                        <span class="quick-action-text">
                            <span class="quick-action-title">Add Employee</span>
                            <span class="quick-action-desc">Onboard a new hire</span>
                        </span>
                        <i class="bi bi-chevron-right quick-action-arrow"></i>
                    </a>
                    <a href="{{ Route::has('payroll.index') ? route('payroll.index') : '#' }}" class="quick-action-item">
                        <span class="quick-action-icon bg-danger-soft text-danger"><i class="bi bi-cash-stack"></i></span>
                        <span class="quick-action-text">
                            <span class="quick-action-title">Run Payroll</span>
                            <span class="quick-action-desc">Process this month's pay</span>
                        </span>
                        <i class="bi bi-chevron-right quick-action-arrow"></i>
                    </a>
                </div>
            </div>
        </div>

    </div>

    {{-- ===================== Pending approvals table ===================== --}}
    <div class="panel-card">
        <div class="panel-card-header">
            <div>
                <h6 class="panel-title">Pending Leave Approvals</h6>
                <p class="panel-subtitle">Requests awaiting your action</p>
            </div>
            <a href="{{ Route::has('leaves.index') ? route('leaves.index') : '#' }}" class="panel-link">View all</a>
        </div>
        <div class="panel-card-body p-0">
            <div class="table-responsive">
                <table class="table align-middle mb-0 dashboard-table">
                    <thead>
                        <tr>
                            <th>Employee</th>
                            <th>Leave Type</th>
                            <th>Duration</th>
                            <th>Applied On</th>
                            <th>Status</th>
                            <th class="text-end">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{--
                            Real version: @foreach ($pendingLeaves as $leave) ... @endforeach
                            Each row hardcoded here just to show the intended layout.
                        --}}
                        <tr>
                            <td>
                                <div class="employee-cell">
                                    <span class="employee-avatar">RP</span>
                                    <span>Rohan Patil</span>
                                </div>
                            </td>
                            <td>Sick Leave</td>
                            <td>Jun 30 &ndash; Jul 1</td>
                            <td>Jun 28, 2026</td>
                            <td><span class="status-badge status-pending">Pending</span></td>
                            <td class="text-end">
                                <button type="button" class="btn-icon-approve" title="Approve"><i
                                        class="bi bi-check-lg"></i></button>
                                <button type="button" class="btn-icon-reject" title="Reject"><i
                                        class="bi bi-x-lg"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="employee-cell">
                                    <span class="employee-avatar">SK</span>
                                    <span>Sneha Kulkarni</span>
                                </div>
                            </td>
                            <td>Casual Leave</td>
                            <td>Jul 3</td>
                            <td>Jun 27, 2026</td>
                            <td><span class="status-badge status-pending">Pending</span></td>
                            <td class="text-end">
                                <button type="button" class="btn-icon-approve" title="Approve"><i
                                        class="bi bi-check-lg"></i></button>
                                <button type="button" class="btn-icon-reject" title="Reject"><i
                                        class="bi bi-x-lg"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="employee-cell">
                                    <span class="employee-avatar">AJ</span>
                                    <span>Amit Joshi</span>
                                </div>
                            </td>
                            <td>Earned Leave</td>
                            <td>Jul 5 &ndash; Jul 9</td>
                            <td>Jun 26, 2026</td>
                            <td><span class="status-badge status-pending">Pending</span></td>
                            <td class="text-end">
                                <button type="button" class="btn-icon-approve" title="Approve"><i
                                        class="bi bi-check-lg"></i></button>
                                <button type="button" class="btn-icon-reject" title="Reject"><i
                                        class="bi bi-x-lg"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="employee-cell">
                                    <span class="employee-avatar">PD</span>
                                    <span>Priya Deshmukh</span>
                                </div>
                            </td>
                            <td>Sick Leave</td>
                            <td>Jul 1</td>
                            <td>Jun 26, 2026</td>
                            <td><span class="status-badge status-pending">Pending</span></td>
                            <td class="text-end">
                                <button type="button" class="btn-icon-approve" title="Approve"><i
                                        class="bi bi-check-lg"></i></button>
                                <button type="button" class="btn-icon-reject" title="Reject"><i
                                        class="bi bi-x-lg"></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.4/dist/chart.umd.min.js"></script>
    <script>
        const attendanceLabels = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Today'];
        const presentData = [132, 129, 135, 130, 128, 60, 128];
        const absentData = [10, 13, 7, 12, 14, 2, 14];

        // Theme-aware colors: read CSS variables so the chart matches
        // whichever theme (light/dark) is currently active on <body>.
        const rootStyles = getComputedStyle(document.body);
        const gridColor = rootStyles.getPropertyValue('--shell-border').trim();
        const textColor = rootStyles.getPropertyValue('--shell-text-muted').trim();

        const ctx = document.getElementById('attendanceChart');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: attendanceLabels,
                datasets: [{
                        label: 'Present',
                        data: presentData,
                        backgroundColor: '#4f5ff0',
                        borderRadius: 6,
                        maxBarThickness: 28,
                    },
                    {
                        label: 'Absent / Leave',
                        data: absentData,
                        backgroundColor: '#e7e9ee',
                        borderRadius: 6,
                        maxBarThickness: 28,
                    },
                ],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                        align: 'end',
                        labels: {
                            color: textColor,
                            boxWidth: 10,
                            boxHeight: 10,
                            usePointStyle: true,
                            pointStyle: 'circle'
                        },
                    },
                },
                scales: {
                    x: {
                        stacked: true,
                        grid: {
                            display: false
                        },
                        ticks: {
                            color: textColor
                        },
                    },
                    y: {
                        stacked: true,
                        grid: {
                            color: gridColor
                        },
                        ticks: {
                            color: textColor
                        },
                    },
                },
            },
        });
    </script>
@endpush
