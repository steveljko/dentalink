@extends('layouts.app')

@section('title', 'DentaLink | Patients')

@section('content')
    <main class="flex-1 overflow-y-auto">
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
