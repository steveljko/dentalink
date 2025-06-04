@props(['patient', 'appointments'])

<div class="lg:col-span-2">
    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
        <div class="px-6 py-4 border-b border-gray-200">
            <div class="flex justify-between items-center">
                <h2 class="text-lg font-semibold text-gray-900">{{ __('patients.appoitments') }}</h2>
                <x-button hx-get="{{ route('patient.create.appointment', $patient) }}" hx-target="#dialog" icon="plus"
                    size="sm">
                    {{ __('patients.new_appointment') }}
                </x-button>
            </div>
        </div>

        <div class="overflow-y-auto h-[480px] p-6">
            @if ($patient->appointments && $patient->appointments->count() > 0)
                <div class="space-y-4">
                    @foreach ($patient->appointments->sortByDesc('scheduled_start') as $appointment)
                        <x-appointments.list :appointment="$appointment" />
                    @endforeach
                </div>

                @if ($patient->appointments->count() > 10)
                    <div class="mt-6 flex justify-center">
                        <button class="text-blue-600 hover:text-blue-800 text-sm font-medium">Load More
                            Appointments</button>
                    </div>
                @endif
            @else
                <div class="text-center py-12">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3a2 2 0 012-2h4a2 2 0 012 2v4m-6 4l6 6m0-6l-6 6" />
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">No appointments</h3>
                    <p class="mt-1 text-sm text-gray-500">This patient doesn't have any appointments
                        yet.
                    </p>
                    <div class="mt-6">
                        <button
                            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition duration-200">
                            Schedule First Appointment
                        </button>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
