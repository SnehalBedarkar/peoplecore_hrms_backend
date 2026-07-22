@extends('layouts.app')

@section('title', 'Employee Profile - PeopleCore HRMS')
@section('page-title', 'Employee Profile')

@section('content')

    {{--
        $employee arrives from:
        EmployeeController::show() -> EmployeeService::getEmployeeById()
        -> EmployeeRepository::getEmployeeById()

        Real columns now selected (confirmed against actual `employees` table):
        id, employee_code, first_name, last_name, gender, date_of_birth,
        mobile_number, email, designation_id, department_id, joining_date,
        employment_type, status
        + designation:id,name and department:id,name relationships.

        No @php fake array here — that was overwriting the real $employee
        every time, since code lower in the file always overwrites code
        above it when both touch the same variable.
    --}}

    @php
        $fullName = $employee->first_name . ' ' . $employee->last_name;

        // status is tinyint(1) in the database: 1 = Active, 0 = Inactive.
        // Comparing against the NUMBER, not the string "active" — same
        // root cause as the earlier .replace() crash in index.js, where
        // status arrived as an integer, not a word.
        $isActive = $employee->status == 1;

        // employment_type is a DB enum: full_time, part_time, contract, intern...
        // Convert the snake_case value into a readable label for display.
        $employmentTypeLabel = $employee->employment_type
            ? ucwords(str_replace('_', ' ', $employee->employment_type))
            : '—';
    @endphp

    <!-- Back link -->
    <a href="{{ route('employees.index') }}"
        class="inline-flex items-center gap-2 text-sm text-gray-400 hover:text-white transition mb-5">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
        Back to Employees
    </a>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">

        <!-- Left: Profile card -->
        <div class="lg:col-span-1">
            <div class="bg-bg-800 border border-bg-600 rounded-xl p-6 text-center">
                <img src="https://ui-avatars.com/api/?name={{ urlencode($fullName) }}&background=6366f1&color=fff&size=128"
                    class="w-24 h-24 rounded-full mx-auto mb-4" alt="">
                <h2 class="text-white font-semibold text-lg">{{ $fullName }}</h2>
                <p class="text-gray-500 text-sm mb-3">{{ $employee->designation->name ?? '—' }}</p>

                @if ($isActive)
                    <span
                        class="inline-block px-3 py-1 rounded-full text-xs font-medium bg-emerald-500/10 text-emerald-400 mb-5">
                        Active
                    </span>
                @else
                    <span class="inline-block px-3 py-1 rounded-full text-xs font-medium bg-rose-500/10 text-rose-400 mb-5">
                        Inactive
                    </span>
                @endif

                <div class="flex items-center justify-center gap-2 mb-6">
                    <button
                        class="flex-1 bg-accent hover:bg-accent-light transition text-white text-sm font-medium px-4 py-2.5 rounded-lg">
                        Edit Profile
                    </button>
                    <button class="p-2.5 rounded-lg border border-bg-600 text-gray-400 hover:bg-bg-700 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                    </button>
                </div>

                <div class="text-left space-y-4 border-t border-bg-600 pt-5">
                    <div class="flex items-center gap-3">
                        <svg class="w-4 h-4 text-gray-500 flex-shrink-0" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        <span class="text-sm text-gray-300 break-all">{{ $employee->email }}</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <svg class="w-4 h-4 text-gray-500 flex-shrink-0" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                        <span class="text-sm text-gray-300">{{ $employee->mobile_number }}</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <svg class="w-4 h-4 text-gray-500 flex-shrink-0" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <span class="text-sm text-gray-300">
                            {{ $employee->date_of_birth ? \Carbon\Carbon::parse($employee->date_of_birth)->format('d M Y') : '—' }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right: Details -->
        <div class="lg:col-span-2 space-y-5">

            <!-- Employment info -->
            <div class="bg-bg-800 border border-bg-600 rounded-xl p-6">
                <h3 class="text-white font-semibold mb-4">Employment Details</h3>
                <div class="grid grid-cols-2 sm:grid-cols-3 gap-5">
                    <div>
                        <p class="text-xs text-gray-500 mb-1">Employee Code</p>
                        <p class="text-sm text-gray-200 font-medium">{{ $employee->employee_code ?? '—' }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 mb-1">Department</p>
                        <p class="text-sm text-gray-200 font-medium">{{ $employee->department->name ?? '—' }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 mb-1">Designation</p>
                        <p class="text-sm text-gray-200 font-medium">{{ $employee->designation->name ?? '—' }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 mb-1">Gender</p>
                        <p class="text-sm text-gray-200 font-medium">{{ ucfirst($employee->gender) }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 mb-1">Date Joined</p>
                        <p class="text-sm text-gray-200 font-medium">
                            {{ $employee->joining_date ? \Carbon\Carbon::parse($employee->joining_date)->format('d M Y') : '—' }}
                        </p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 mb-1">Employment Type</p>
                        <p class="text-sm text-gray-200 font-medium">{{ $employmentTypeLabel }}</p>
                    </div>
                </div>
            </div>

            {{--
                Attendance Summary and Recent Activity below are still
                hardcoded placeholders. There is no Attendance model or
                relationship wired up yet — that's the next page you're
                planning to build. Once it exists, these numbers/items
                should be replaced with real queries the same way every
                field above was just converted from fake to real.
            --}}

            <!-- Attendance summary -->
            <div class="bg-bg-800 border border-bg-600 rounded-xl p-6">
                <h3 class="text-white font-semibold mb-4">Attendance Summary (This Month)</h3>
                <div class="grid grid-cols-3 gap-4">
                    <div class="bg-bg-700/50 rounded-lg p-4 text-center">
                        <p class="text-2xl font-bold text-emerald-400">22</p>
                        <p class="text-xs text-gray-500 mt-1">Present</p>
                    </div>
                    <div class="bg-bg-700/50 rounded-lg p-4 text-center">
                        <p class="text-2xl font-bold text-amber-400">2</p>
                        <p class="text-xs text-gray-500 mt-1">Leave</p>
                    </div>
                    <div class="bg-bg-700/50 rounded-lg p-4 text-center">
                        <p class="text-2xl font-bold text-rose-400">1</p>
                        <p class="text-xs text-gray-500 mt-1">Absent</p>
                    </div>
                </div>
            </div>

            <!-- Recent activity -->
            <div class="bg-bg-800 border border-bg-600 rounded-xl p-6">
                <h3 class="text-white font-semibold mb-4">Recent Activity</h3>
                <div class="space-y-4">
                    @foreach ([['Checked in at 9:42 AM', 'Today', 'emerald'], ['Applied for sick leave', 'Yesterday', 'amber'], ['Updated profile information', '3 days ago', 'indigo'], ['Checked out at 6:30 PM', '4 days ago', 'emerald']] as [$text, $time, $color])
                        <div class="flex items-start gap-3">
                            <div class="w-2 h-2 rounded-full bg-{{ $color }}-400 mt-1.5 flex-shrink-0"></div>
                            <div class="flex-1">
                                <p class="text-sm text-gray-300">{{ $text }}</p>
                                <p class="text-xs text-gray-500">{{ $time }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>

@endsection
