<header class="bg-white border-b border-gray-300 px-6 py-4">
    <div class="flex items-center justify-between">
        <div>
            {{ $slot }}
        </div>

        <div class="flex items-center space-x-5">
            <div class="flex items-center relative">
                <div class="relative">
                    <input type="text" placeholder="{{ __('dashboard.search_patients') }}"
                        class="w-[360px] pl-10  pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        name="name" hx-post="{{ route('search.patient') }}" hx-trigger="input changed delay:500ms"
                        hx-target="#suggestions" hx-swap="outerHTML" autocomplete="off">
                    <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                </div>
                <ul id="suggestions" class="absolute top-full" />
            </div>

            <div
                id="notifications"
                class="relative"
                hx-get="{{ route('notification.button') }}"
                hx-trigger="reloadNotifications from:body"
                hx-target="#notificationToggle"
                hx-swap="outerHTML"
            >
                <x-notification.button />
                <div id="notificationDropdown" class="absolute fade-me-in"></div>
            </div>

            <x-dashboard.user-menu :name="auth()->user()->name" />
        </div>
    </div>
</header>
