@props(['title', 'value', 'color', 'icon'])

@php
    $borderColor = match ($color) {
        'red' => 'border-red-500',
        'blue' => 'border-blue-500',
        'green' => 'border-green-500',
        'yellow' => 'border-yellow-500',
        'purple' => 'border-purple-500',
        'indigo' => 'border-indigo-500',
        'pink' => 'border-pink-500',
        'gray' => 'border-gray-500',
        default => 'border-blue-500',
    };

    $bgColor = match ($color) {
        'red' => 'bg-red-100',
        'blue' => 'bg-blue-100',
        'green' => 'bg-green-100',
        'yellow' => 'bg-yellow-100',
        'purple' => 'bg-purple-100',
        'indigo' => 'bg-indigo-100',
        'pink' => 'bg-pink-100',
        'gray' => 'bg-gray-100',
        default => 'bg-blue-100',
    };

    $iconColor = match ($color) {
        'red' => 'text-red-600',
        'blue' => 'text-blue-600',
        'green' => 'text-green-600',
        'yellow' => 'text-yellow-600',
        'purple' => 'text-purple-600',
        'indigo' => 'text-indigo-600',
        'pink' => 'text-pink-600',
        'gray' => 'text-gray-600',
        default => 'text-blue-600',
    };
@endphp

<div class="bg-white rounded-lg shadow p-6 border-l-4 border-t-1 border-b-1 border-r-1 {{ $borderColor }}">
    <div class="flex items-center justify-between">
        <div>
            <p class="text-sm font-medium text-gray-600">{{ $title }}</p>
            <p class="text-3xl font-bold text-gray-800">{{ $value }}</p>
        </div>
        <div class="{{ $bgColor }} p-3 rounded-full">
            <i class="fas fa-{{ $icon }} {{ $iconColor }} text-xl"></i>
        </div>
    </div>
    @if ($slot->isNotEmpty())
        <div class="mt-4">
            {{ $slot }}
        </div>
    @endif
</div>
