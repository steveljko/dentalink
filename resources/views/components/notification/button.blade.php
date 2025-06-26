<button
    hx-get="{{ route('notifications.get') }}"
    hx-swap="outerHTML"
    hx-target="#notificationDropdown"
    id="notificationToggle"
    class="h-[40px] relative bg-white border border-gray-300 rounded-xl px-3 cursor-pointer hover:border-blue-500 group"
>
    <i class="fas fa-bell text-xl text-slate-500 group-hover:text-blue-500 transition-colors duration-300"></i>
    @if ($notifications->count() >= 1)
        <span id="notificationBadge"
            class="absolute -top-1.5 -right-1.5 bg-gradient-to-br from-red-500 to-red-600 text-white text-xs font-semibold min-w-5 h-5 rounded-full flex items-center justify-center border-2 border-white animate-pulse-scale">
            {{ $notifications->count() }}
        </span>
    @endif
</button>
