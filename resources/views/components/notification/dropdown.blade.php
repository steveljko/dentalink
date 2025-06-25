<div id="notificationDropdown"
    class="absolute top-full right-0 mt-2 w-128 bg-white shadow">
    <div class="px-5 py-3 border-b border-gray-100 bg-gray-50">
        <h3 class="text-lg font-semibold text-slate-800 mb-1">Notifikacije</h3>
        @if ($notifications->count() >= 1)
            <p class="text-sm text-slate-600" id="notificationSubtitle">Imate {{ $notifications->count() }} nove
                notifikacije.</p>
        @endif
    </div>

    <div class="max-h-80 overflow-y-auto">
        @php
            use App\Enums\NotificationChannel;
        @endphp
        @if ($notifications->count())
            @foreach ($notifications as $notification)
                @if ($notification->isChannel(NotificationChannel::DEFAULT))
                    <x-notification.item icon="house" iconWrapperColor="green" :message="$notification->getMessage()" :date="$notification->created_at" />
                @endif

                @if ($notification->isChannel(NotificationChannel::BACKUP))
                    <x-notification.item icon="cloud-upload-alt" iconWrapperColor="red" :message="$notification->getMessage()"
                        :date="$notification->created_at" />
                @endif

                @if ($notification->isChannel(NotificationChannel::APPOINTMENT))
                    <x-notification.item icon="calendar" iconWrapperColor="red" :message="$notification->getMessage()"
                        :date="$notification->created_at">
                        <a href="{{ route('patient.show', json_decode($notification->additional, true)['patient_id']) }}" class="font-semibold text-blue-500 uppercase hover:underline">Go to Patient</a>
                    </x-notification.item>
                @endif
            @endforeach
        @else
            <div class="text-center py-8">
                <div class="mb-4">
                    <i class="fas fa-bell-slash text-4xl text-gray-300"></i>
                </div>
                <p class="text-gray-500 text-lg font-medium mb-2">Nema novih notifikacija</p>
                <p class="text-gray-400 text-sm">Sve je u redu, nema novih obaveštenja za Vas.</p>
            </div>
        @endif

        <div class="p-3 border-t border-gray-100 bg-gray-50 text-center">
            <a href="#"
                class="text-blue-500 hover:text-blue-600 text-sm font-medium transition-colors duration-200">
                Pogledajte sve notifikacije
            </a>
        </div>
    </div>
</div>
