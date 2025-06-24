<div id="notificationDropdown"
    class="absolute top-full right-0 mt-2 w-128 bg-white rounded-2xl shadow-2xl border border-slate-200 opacity-0 invisible -translate-y-2 transition-all duration-300 ease-out z-50 max-h-96 overflow-hidden">
    <div class="px-5 py-3 border-b border-gray-100 bg-gray-50">
        <h3 class="text-lg font-semibold text-slate-800 mb-1">Notifikacije</h3>
        @if ($notifications->count() >= 1)
            <p class="text-sm text-slate-600" id="notificationSubtitle">Imate {{ $notifications->count() }} nove
                notifikacije.</p>
        @endif
    </div>

    <div class="max-h-80 overflow-y-auto">
        @if ($notifications->count())
            @foreach ($notifications as $notification)
                @if ($notification->isChannel(\App\Enums\NotificationChannel::DEFAULT))
                    <x-notification.item icon="house" iconWrapperColor="green" :message="$notification->getMessage()" :date="$notification->created_at" />
                @endif

                @if ($notification->isChannel(\App\Enums\NotificationChannel::BACKUP))
                    <x-notification.item icon="cloud-upload-alt" iconWrapperColor="red" :message="$notification->getMessage()"
                        :date="$notification->created_at" />
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
