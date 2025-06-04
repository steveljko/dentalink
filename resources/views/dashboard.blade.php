@extends('layouts.app')

@section('title', 'DentaLink | Dashboard')

@section('content')
    <x-dashboard.header />

    <main class="flex-1 overflow-y-auto p-6">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
            <x-card :title="__('dashboard.total_patients')" :value="number_format($patients->count())" color="blue" icon="users">
                <span class="text-green-500 text-sm font-medium">{{ number_format($createdThisMonth) }}</span>
                <span class="text-gray-600 text-sm">{{ __('dashboard.patients_added_this_month') }}</span>
            </x-card>

            <x-card :title="__('dashboard.today_appoitments')" value="18" color="green" icon="calendar-check">
                <span class="text-blue-500 text-sm font-medium">{{ __('dashboard.more', ['number' => 3]) }}</span>
                <span class="text-gray-600 text-sm">{{ __('dashboard.than_yesterday') }}</span>
            </x-card>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <x-dashboard.today-appoitments :appointments="$appointments" />
            <x-dashboard.quick-actions />
            <x-dashboard.calendar />
        </div>
    </main>
@endsection
