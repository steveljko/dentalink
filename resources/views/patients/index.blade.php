@extends('layouts.app')

@section('title', 'DentaLink | Patients')

@section('content')
    <x-header>
        <h2 class="text-2xl font-semibold text-gray-800">Pacijenti</h2>
    </x-header>

    <div class="px-6 py-4 border-b border-gray-200">
        <form method="GET" action="{{ route('patient.index') }}" class="flex gap-4">
            <div class="flex-1">
                <input type="text" name="search" value="{{ request('search') }}" hx-get="{{ route('patient.index') }}"
                    hx-trigger="input changed delay:500ms" hx-target="#table" hx-push-url="true"
                    placeholder="{{ __('patients.search_by_name') }}"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>
            <x-button hx-get="{{ route('patient.create') }}" hx-target="#dialog">{{ __('patients.create') }}</x-button>
        </form>
    </div>

    <!-- Table -->
    @fragment('table')
        <div id="table" hx-get="{{ route('patient.index') }}" hx-trigger="loadPatients from:body" class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            {{ __('patients.name') }}
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Godište
                        </th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($patients as $patient)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">
                                    {{ $patient->first_name }} {{ $patient->last_name }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                @if ($patient->date_of_birth)
                                    <div class="text-gray-700">
                                        {{ \Carbon\Carbon::parse($patient->date_of_birth)->format('Y') }}</div>
                                @else
                                    <span class="text-gray-400">N/A</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex justify-end space-x-2">
                                    <a href="{{ route('patient.show', $patient) }}"
                                        class="inline-flex items-center px-3 py-1 bg-green-100 text-green-700 rounded-md hover:bg-green-200 transition-colors duration-200">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        Pogledaj
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-8 text-center text-gray-500">
                                @if (request('search'))
                                    Nema pacijenta sa "{{ request('search') }}"
                                @else
                                    Nema pacijenta u bazi, dodajte novog.
                                @endif
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            @if ($patients->hasPages())
                <div class="px-6 py-4 border-t border-gray-200">
                    <div class="flex items-center justify-between">
                        <div class="text-sm text-gray-700">
                            Showing {{ $patients->firstItem() ?? 0 }} to {{ $patients->lastItem() ?? 0 }}
                            of {{ $patients->total() }} results
                        </div>
                        <div>
                            {{ $patients->links() }}
                        </div>
                    </div>
                </div>
            @endif
        </div>
    @endfragment
@endsection
