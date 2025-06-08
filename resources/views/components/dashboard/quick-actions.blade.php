@props(['notifications'])

<div class="bg-white rounded-lg shadow">
    <div class="p-6 border-b border-gray-200">
        <h3 class="text-lg font-semibold text-gray-800">{{ __('dashboard.quick_actions') }}</h3>
    </div>
    <div class="p-6">
        <div class="grid grid-cols-2 gap-4">
            <button hx-get="{{ route('patient.create') }}" hx-target="#dialog"
                class="cursor-pointer flex flex-col items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                <i class="fas fa-user-plus text-2xl text-blue-600 mb-2"></i>
                <span class="text-sm font-medium text-gray-800">{{ __('dashboard.add_patient') }}</span>
            </button>

            <button
                class="cursor-pointer flex flex-col items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                <i class="fas fa-calendar-plus text-2xl text-green-600 mb-2"></i>
                <span class="text-sm font-medium text-gray-800">{{ __('dashboard.schedule_appointment') }}</span>
            </button>
        </div>

        <div class="mt-6 pt-6 border-t border-gray-200">
            <h4 class="font-medium text-gray-800 mb-3">{{ __('dashboard.recent_notifications') }}</h4>
            @if ($notifications->isEmpty())
                <p class="text-gray-500">Nema notifikacija.</p>
            @else
                @foreach ($notifications as $notification)
                    <div
                        class="mb-4 p-4 rounded-lg
                                    @if ($notification->level === 'debug') bg-blue-100 border border-blue-300 @endif
                                    @if ($notification->level === 'info') bg-green-100 border border-green-300 @endif
                                    @if ($notification->level === 'notice') bg-yellow-100 border border-yellow-300 @endif
                                    @if ($notification->level === 'warning') bg-orange-100 border border-orange-300 @endif
                                    @if ($notification->level === 'error') bg-red-100 border border-red-300 @endif
                                    @if ($notification->level === 'critical') bg-red-200 border border-red-400 @endif
                                    @if ($notification->level === 'alert') bg-pink-100 border border-pink-300 @endif
                                    @if ($notification->level === 'emergency') bg-purple-100 border border-purple-300 @endif">

                        <div class="flex justify-between items-start">
                            <div class="flex-1">
                                <div class="flex items-center mb-2">
                                    <span
                                        class="px-2 py-1 text-xs font-semibold rounded-full
                                                    @if ($notification->level === 'debug') bg-blue-200 text-blue-800 @endif
                                                    @if ($notification->level === 'info') bg-green-200 text-green-800 @endif
                                                    @if ($notification->level === 'notice') bg-yellow-200 text-yellow-800 @endif
                                                    @if ($notification->level === 'warning') bg-orange-200 text-orange-800 @endif
                                                    @if ($notification->level === 'error') bg-red-200 text-red-800 @endif
                                                    @if ($notification->level === 'critical') bg-red-300 text-red-900 @endif
                                                    @if ($notification->level === 'alert') bg-pink-200 text-pink-800 @endif
                                                    @if ($notification->level === 'emergency') bg-purple-200 text-purple-800 @endif">
                                        {{ strtoupper($notification->level) }}
                                    </span>
                                    @if ($notification->channel !== 'default')
                                        <span class="ml-2 text-xs text-gray-500">[{{ $notification->channel }}]</span>
                                    @endif
                                </div>
                                <p class="text-gray-800 mb-2">{{ $notification->message }}</p>
                                @if ($notification->additional)
                                    <details class="mt-2">
                                        <summary class="text-sm text-gray-600 cursor-pointer hover:text-gray-800">
                                            {{ __('dashboard.show_details') }}</summary>
                                        <div class="mt-2 p-2 bg-gray-50 rounded text-sm text-gray-700">
                                            {{ $notification->additional }}
                                        </div>
                                    </details>
                                @endif
                            </div>
                            <div class="ml-4 text-right">
                                <small class="text-gray-500">
                                    {{ $notification->created_at->diffForHumans() }}
                                </small>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>
