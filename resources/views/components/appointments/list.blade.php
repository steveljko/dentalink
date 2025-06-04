@props(['appointment'])

<div class="border border-gray-200 rounded-lg p-4 hover:shadow-sm transition-shadow">
    <div class="flex justify-between mb-2">
        <h3 class="font-medium text-gray-900">
            {{ \Carbon\Carbon::parse($appointment->scheduled_start)->locale('sr')->format('j. M \u H:i') }}

        </h3>
        <x-appointments.status :status="$appointment->status" />
    </div>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm text-gray-600">
        <div>
            <span class="font-medium">{{ __('appointments.duration') }}:</span>
            {{ $appointment->duration }} min
        </div>

        @if ($appointment->payment_status)
            <div>
                <span class="font-medium">{{ __('appointments.payment') }}:</span>
                <span
                    class="
                            @if ($appointment->payment_status === 'paid') text-green-600
                            @elseif($appointment->payment_status === 'pending') text-yellow-600
                            @else text-red-600 @endif">
                    {{ __("appointments.$appointment->payment_status") }}
                </span>
            </div>
        @endif
    </div>

    @if ($appointment->notes)
        <div class="mt-3">
            <p class="text-sm text-gray-700 bg-gray-50 p-2 rounded">
                {{ $appointment->notes }}</p>
        </div>
    @endif

    <a href="#"
        class="mt-2 block text-green-600 hover:text-green-800 text-sm cursor-pointer font-medium">Pogledaj</a>
</div>
