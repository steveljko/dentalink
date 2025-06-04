@extends('layouts.app')

@section('title', 'Patient Details')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <!-- Header -->
        <div class="bg-white shadow-sm rounded-lg p-6 mb-6">
            <div class="flex justify-between items-start">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900 mb-2">Appointment Details</h1>
                    <div class="flex items-center space-x-4 text-sm text-gray-600">
                        <span class="flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                            {{ $appointment->scheduled_start->format('M d, Y \a\t g:i A') }}
                        </span>
                        <span class="flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            {{ $appointment->duration }} minutes
                        </span>
                    </div>
                </div>
                <div class="flex items-center space-x-3">
                    <!-- Status Badge -->
                    <span
                        class="px-3 py-1 rounded-full text-xs font-medium
                    @switch($appointment->status)
                        @case('scheduled')
                            bg-blue-100 text-blue-800
                            @break
                        @case('confirmed')
                            bg-green-100 text-green-800
                            @break
                        @case('completed')
                            bg-purple-100 text-purple-800
                            @break
                        @case('cancelled')
                            bg-red-100 text-red-800
                            @break
                        @case('no_show')
                            bg-gray-100 text-gray-800
                            @break
                    @endswitch
                ">
                        {{ ucfirst(str_replace('_', ' ', $appointment->status)) }}
                    </span>

                    <!-- Payment Status Badge -->
                    <span
                        class="px-3 py-1 rounded-full text-xs font-medium
                    @switch($appointment->payment_status)
                        @case('pending')
                            bg-yellow-100 text-yellow-800
                            @break
                        @case('paid')
                            bg-green-100 text-green-800
                            @break
                        @case('partially_paid')
                            bg-orange-100 text-orange-800
                            @break
                    @endswitch
                ">
                        {{ ucfirst(str_replace('_', ' ', $appointment->payment_status)) }}
                    </span>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Patient & Dentist Information -->
                <div class="bg-white shadow-sm rounded-lg p-6">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Appointment Information</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h3 class="text-sm font-medium text-gray-500 mb-2">Patient</h3>
                            <div class="flex items-center">
                                <div>
                                    <p class="font-medium text-gray-900">{{ $appointment->patient->first_name }}
                                        {{ $appointment->patient->last_name }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if ($appointment->notes)
                        <div class="mt-6 pt-4 border-t border-gray-200">
                            <h3 class="text-sm font-medium text-gray-500 mb-2">Notes</h3>
                            <p class="text-gray-700">{{ $appointment->notes }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
