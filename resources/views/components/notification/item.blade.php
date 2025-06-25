@props(['icon', 'iconWrapperColor', 'message', 'date'])

<div
    class="notification-item px-5 py-4 border-b border-gray-50 cursor-pointer transition-colors duration-200 flex items-start gap-3 unread">
    <div
        class="w-10 h-10 rounded-xl bg-{{ $iconWrapperColor }}-500 flex items-center justify-center text-white flex-shrink-0">
        <i class="fas fa-{{ $icon }}"></i>
    </div>
    <div class="flex-1 min-w-0">
        <h4 class="text-sm font-semibold text-gray-800 mb-1">{{ $message }}</h4>
        <div class="flex items-center gap-1 text-xs text-gray-500">
            <i class="fas fa-clock"></i>
            <span>{{ $date->diffForHumans() }}</span>
        </div>
        <div class="mt-2">
            {{ $slot }}
        </div>
    </div>
</div>
