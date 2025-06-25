@extends('layouts.app')

@section('title', 'DentaLink | Dashboard')

@section('content')
    <x-header>
        <h2 class="text-2xl font-semibold text-gray-800">{{ __('dashboard.title') }}</h2>
        <p class="text-gray-600">{{ __('dashboard.welcome_back', ['name' => auth()->user()->name]) }}</p>
    </x-header>

    <main class="flex-1 overflow-y-auto p-6">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
            <x-card :title="__('dashboard.total_patients')" :value="number_format($patients->count())" color="blue" icon="users">
                <span class="text-green-500 text-sm font-medium">{{ number_format($createdThisMonth) }}</span>
                <span class="text-gray-600 text-sm">{{ __('dashboard.patients_added_this_month') }}</span>
            </x-card>

            <x-card :title="__('dashboard.today_appoitments')" :value="$appointments->count()" color="green" icon="calendar-check">
                <span class="text-blue-500 text-sm font-medium">{{ __('dashboard.more', ['number' => 3]) }}</span>
                <span class="text-gray-600 text-sm">{{ __('dashboard.than_yesterday') }}</span>
            </x-card>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <x-dashboard.calendar :appointments="$appointments" />
        </div>
    </main>
@endsection
