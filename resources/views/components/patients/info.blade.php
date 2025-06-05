@props(['patient'])

<div class="lg:col-span-1 h-full">
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 flex flex-col h-[600px]">
        <div class="px-6 py-4 border-b border-gray-200 flex-shrink-0">
            <h2 class="text-lg font-semibold text-gray-900">{{ __('patients.patient_info') }}</h2>
        </div>
        <div class="p-6 flex-1 overflow-y-auto">
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-600">{{ __('patients.fullname') }}</label>
                    <p class="mt-1 text-sm text-gray-900">{{ $patient->first_name }}
                        {{ $patient->last_name }}
                    </p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-600">{{ __('patients.gender') }}</label>
                    <p class="mt-1 text-sm text-gray-900 capitalize">{{ __("patients.$patient->gender") }}
                    </p>
                </div>
                @if ($patient->date_of_birth)
                    <div>
                        <label
                            class="block text-sm font-medium text-gray-600">{{ __('patients.age_and_date_of_birth') }}</label>
                        <div class="mt-1 text-sm text-gray-900">
                            <p class="font-medium">{{ \Carbon\Carbon::parse($patient->date_of_birth)->age }}
                                godina
                            </p>
                            <p class="text-gray-500 text-xs">
                                {{ \Carbon\Carbon::parse($patient->date_of_birth)->format('j. M Y') }}
                            </p>
                        </div>
                    </div>
                @endif
                @if ($patient->email)
                    <div>
                        <label class="block text-sm font-medium text-gray-600">Email</label>
                        <p class="mt-1 text-sm text-gray-900">
                            <a href="mailto:{{ $patient->email }}"
                                class="text-blue-600 hover:text-blue-800">{{ $patient->email }}</a>
                        </p>
                    </div>
                @endif
                @if ($patient->phone)
                    <div>
                        <label class="block text-sm font-medium text-gray-600">{{ __('patients.phone') }}</label>
                        <p class="mt-1 text-sm text-gray-900">
                            <a href="tel:{{ $patient->phone }}"
                                class="text-blue-600 hover:text-blue-800">{{ $patient->phone }}</a>
                        </p>
                    </div>
                @endif
                @if ($patient->emergency_contact_name || $patient->emergency_contact_phone)
                    <div class="pt-4 border-t border-gray-200">
                        <h3 class="text-sm font-medium text-gray-900 mb-2">
                            {{ __('patients.emergency_contact') }}</h3>
                        @if ($patient->emergency_contact_name)
                            <p class="text-sm text-gray-600">{{ $patient->emergency_contact_name }}</p>
                        @endif
                        @if ($patient->emergency_contact_phone)
                            <p class="text-sm text-gray-600">
                                <a href="tel:{{ $patient->emergency_contact_phone }}"
                                    class="text-blue-600 hover:text-blue-800">{{ $patient->emergency_contact_phone }}</a>
                            </p>
                        @endif
                    </div>
                @endif
                @if ($patient->notes)
                    <div class="pt-4 border-t border-gray-200">
                        <label class="block text-sm font-medium text-gray-600 mb-2">Notes</label>
                        <p class="text-sm text-gray-700 bg-gray-50 p-3 rounded">{{ $patient->notes }}</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
