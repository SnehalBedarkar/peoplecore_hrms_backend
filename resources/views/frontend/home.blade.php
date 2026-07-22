@extends('layouts.frontend')

@section('title', 'PeopleCore HRMS - Modern HR Management')

@section('content')

    <section class="max-w-7xl mx-auto px-6 pt-20 pb-24 text-center">
        <h1 class="text-4xl md:text-5xl font-bold text-white mb-5 leading-tight">
            HR Management,<br>Simplified.
        </h1>
        <p class="text-gray-400 text-lg max-w-xl mx-auto mb-8">
            Manage employees, attendance, leave, and payroll — all from one modern dashboard.
        </p>
        <div class="flex items-center justify-center gap-4">
            <a href="#"
                class="bg-accent hover:bg-accent-light transition text-white font-medium px-6 py-3 rounded-lg">
                Start Free Trial
            </a>
            <a href="{{ route('pricing') }}"
                class="border border-bg-600 hover:bg-bg-700 transition text-gray-300 font-medium px-6 py-3 rounded-lg">
                View Pricing
            </a>
        </div>
    </section>

@endsection
