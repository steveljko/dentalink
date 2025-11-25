@extends('layouts.app')

@section('title', 'DentaLink | Patients')
@section('page', 'Pacijenti')

@section('content')
<div class="card bg-base-100 shadow-sm mb-4">
    <div class="card-body p-6">
        <form method="GET" action="{{ route('patient.index') }}" class="flex gap-4">
            <div class="flex-1">
                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    hx-get="{{ route('patient.index') }}"
                    hx-trigger="input changed delay:500ms"
                    hx-target="#table"
                    hx-push-url="true"
                    placeholder="{{ __('patients.search_by_name') }}"
                    class="input input-bordered w-full"
                />
            </div>
            <button
                type="button"
                class="btn btn-primary gap-2"
                hx-get="{{ route('patient.create') }}"
                hx-target="#dialog"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                {{ __('patients.create') }}
            </button>
        </form>
    </div>
</div>

@fragment('table')
<div class="overflow-x-auto rounded-box border border-base-content/5 bg-base-100" hx-get="{{ route('patient.index') }}" hx-trigger="loadPatients from:body">
    <table class="table">
        <thead>
            <tr>
                <th>{{ __('patients.health_card_number') }}</th>
                <th>{{ __('patients.name') }}</th>
                <th>Godište</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @forelse($patients as $patient)
            <tr class="hover">
                <td class="w-[8%]">
                    <span>{{ $patient->health_card_number }}</span>
                </td>
                <td>
                    <div class="font-medium">
                        {{ $patient->first_name }} {{ $patient->last_name }}
                    </div>
                </td>
                <td>
                    @if ($patient->date_of_birth)
                    <span class="font-medium">
                        {{ $patient->date_of_birth->format('Y') }}
                    </span>
                    @else
                    <span class="text-base-content/40">N/A</span>
                    @endif
                </td>
                <td class="text-right">
                    <a
                        href="{{ route('patient.show', $patient) }}"
                        class="btn btn-success btn-sm gap-2"
                    >
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                        Pogledaj
                    </a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="text-center py-12">
                    <div class="text-base-content/60">
                        @if (request('search'))
                        <div class="mb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto mb-3 opacity-30" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        Nema pacijenta sa "{{ request('search') }}"
                        @else
                        <div class="mb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto mb-3 opacity-30" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        Nema pacijenta u bazi, dodajte novog.
                        @endif
                    </div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    @if ($patients->hasPages())
    <div class="border-t border-base-300 p-4">
        <div class="join flex justify-center">
            {{ $patients->links() }}
        </div>
    </div>
    @endif
</div>
@endfragment
@endsection
