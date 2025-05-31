@props(['appointments'])

<div class="bg-white rounded-lg shadow">
    <div class="p-6 border-b border-gray-200">
        <h3 class="text-lg font-semibold text-gray-800">{{ __('dashboard.today_appoitments') }}</h3>
    </div>
    <div class="p-6">
        <div class="space-y-4">
            @foreach ($appointments as $appointment)
                <div class="flex items-center justify-between py-3 border-b border-gray-100">
                    <div class="flex items-center space-x-3">
                        <img src="https://ui-avatars.com/api/?name={{ $appointment->patient->first_name }}+{{ $appointment->patient->last_name }}&background=e5e7eb&color=374151"
                            alt="Patient" class="w-10 h-10 rounded-full">
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

        <div class="mt-6">
            <a href="#"
                class="text-blue-600 hover:text-blue-800 font-medium text-sm">{{ __('dashboard.view_all_appoitments') }}</a>
        </div>
    </div>
</div>
