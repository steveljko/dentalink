@props(['appointments'])

<div class="bg-white rounded-lg shadow">
    <div class="p-6 border-b border-gray-200">
        <h3 class="text-lg font-semibold text-gray-800">{{ __('dashboard.today_appoitments') }}</h3>
    </div>
    <div class="p-6">
        @if ($appointments->count())
            <div class="space-y-4">
                @foreach ($appointments as $appointment)
                    <div class="flex items-center justify-between py-3 border-b border-gray-100">
                        <div class="flex items-center space-x-3">
                            <div>
                                <p class="font-medium text-gray-800">{{ $appointment->patient->first_name }}
                                    {{ $appointment->patient->last_name }}</p>
                                <p class="text-sm text-gray-600">Čišćenje i provera</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-sm font-medium text-gray-800">
                                {{ $appointment->scheduled_start->format('H:i') }}</p>
                            <span
                                class="inline-block px-2 py-1 text-xs bg-green-100 text-green-800 rounded-full">Potvrđeno</span>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-8">
                <div class="w-16 h-16 mx-auto mb-4 bg-gray-100 rounded-full flex items-center justify-center">
                    <i class="fa-regular fa-calendar-minus text-2xl text-gray-600"></i>
                </div>
                <h4 class="font-medium text-gray-600 mb-2">Nema zakazanih termina danas.</h4>
            </div>
        @endif
    </div>
</div>
