@extends('layouts.app')

@section('title', 'Patient Details')

@section('content')
    <div class="min-h-screen bg-gray-50">
        <x-header>
            <h1 class="text-2xl font-bold text-gray-800">{{ $patient->first_name }} {{ $patient->last_name }}</h1>
        </x-header>

        <div class="bg-white border-b border-gray-200 shadow-md">
            <div class="max-w-full px-6 py-4">
                <div class="flex justify-between items-center">
                    <x-button href="{{ route('patient.index') }}" variant="secondary" icon="chevron-left">
                        {{ __('patients.back_to') }}
                    </x-button>
                    <x-button hx-get="{{ route('patient.edit', $patient) }}" hx-target="#dialog" icon="plus">
                        {{ __('patients.edit') }}
                    </x-button>
                </div>
            </div>
        </div>

        <div class="max-w-full px-6 py-6">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <x-patients.info :patient="$patient" />
                <x-patients.appointments :patient="$patient" />
            </div>

            <x-patients.attachments :patient="$patient" />
        </div>
    </div>
@endsection
