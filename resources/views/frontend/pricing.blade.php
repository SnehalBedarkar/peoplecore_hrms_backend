@extends('layouts.frontend')

@section('title', 'Pricing - PeopleCore HRMS')

@section('content')

    @php
        $plans = [
            [
                'name' => 'Starter',
                'price' => '₹999',
                'desc' => 'For small teams getting started',
                'features' => ['Up to 25 employees', 'Attendance tracking', 'Basic reports', 'Email support'],
                'highlight' => false,
            ],
            [
                'name' => 'Growth',
                'price' => '₹2,499',
                'desc' => 'For growing companies',
                'features' => [
                    'Up to 150 employees',
                    'Leave management',
                    'Payroll automation',
                    'Priority support',
                    'Custom roles',
                ],
                'highlight' => true,
            ],
            [
                'name' => 'Enterprise',
                'price' => 'Custom',
                'desc' => 'For large organizations',
                'features' => [
                    'Unlimited employees',
                    'Advanced analytics',
                    'Dedicated manager',
                    'SLA guarantee',
                    'API access',
                ],
                'highlight' => false,
            ],
        ];
    @endphp

    <section class="max-w-7xl mx-auto px-6 pt-16 pb-24">

        <div class="text-center mb-14">
            <h1 class="text-3xl md:text-4xl font-bold text-white mb-3">Simple, transparent pricing</h1>
            <p class="text-gray-400">Choose the plan that fits your team. Upgrade anytime.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-5xl mx-auto">
            @foreach ($plans as $plan)
                <div
                    class="rounded-2xl p-7 border {{ $plan['highlight'] ? 'border-accent bg-bg-800 relative' : 'border-bg-600 bg-bg-800' }}">

                    @if ($plan['highlight'])
                        <span
                            class="absolute -top-3 left-1/2 -translate-x-1/2 bg-accent text-white text-xs font-medium px-3 py-1 rounded-full">
                            Most Popular
                        </span>
                    @endif

                    <h3 class="text-white font-semibold text-lg mb-1">{{ $plan['name'] }}</h3>
                    <p class="text-gray-500 text-sm mb-5">{{ $plan['desc'] }}</p>

                    <div class="mb-6">
                        <span class="text-3xl font-bold text-white">{{ $plan['price'] }}</span>
                        @if ($plan['price'] !== 'Custom')
                            <span class="text-gray-500 text-sm">/month</span>
                        @endif
                    </div>

                    <ul class="space-y-3 mb-7">
                        @foreach ($plan['features'] as $feature)
                            <li class="flex items-center gap-2.5 text-sm text-gray-300">
                                <svg class="w-4 h-4 text-emerald-400 flex-shrink-0" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                {{ $feature }}
                            </li>
                        @endforeach
                    </ul>

                    <a href="{{ route('register') }}"
                        class="block text-center {{ $plan['highlight'] ? 'bg-accent hover:bg-accent-light text-white' : 'border border-bg-600 hover:bg-bg-700 text-gray-300' }} transition font-medium py-2.5 rounded-lg">
                        Get Started
                    </a>
                </div>
            @endforeach
        </div>

    </section>

@endsection
