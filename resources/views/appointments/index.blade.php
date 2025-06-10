@extends('layouts.app')

@section('title', 'DentaLink | Patients')

@section('content')
    <x-header>
        <h2 class="text-2xl font-semibold text-gray-800">Zakazivanja</h2>
    </x-header>
    <main class="flex-1 overflow-y-auto p-6">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
            <x-card title="Termina danas" :value="$todayAppointmentsCount" color="green" icon="calendar-check"></x-card>
            <x-card title="Termina ove godine" :value="$thisYearAppointmentsCount" color="red" icon="calendar"></x-card>
        </diV>

        <div class="bg-white rounded-lg shadow">
            <div class="p-6 border-b border-gray-200">Pregledi</div>
            <div class="p-6">
                <div id="full-calendar" data-appointments="{{ json_encode($appointments) }}"></div>
            </div>
        </div>
    </main>
@endsection
