@props([
    'type' => 'button',
    'size' => 'md',
    'variant' => 'primary',
    'icon' => '',
    'class' => '',
])

@php
    $variants = [
        'primary' => 'bg-blue-600 text-white hover:bg-blue-700',
        'secondary' => 'border border-gray-300 text-gray-700 hover:bg-gray-100',
    ];

    $sizes = [
        'sm' => 'px-2 py-1 text-sm',
        'md' => 'px-4 py-2 text-[0.938rem] font-medium',
        'lg' => 'px-6 py-3 text-lg',
    ];

    $sizeClass = $sizes[$size] ?? $sizes['md'];
    $variantClass = $variants[$variant] ?? $variants['primary'];

    $baseClasses =
        $sizeClass .
        ' ' .
        $variantClass .
        ' ' .
        $class .
        ' rounded-md cursor-pointer inline-flex items-center text-center no-underline transition-colors';
@endphp

@if ($attributes->has('href'))
    <a href="{{ $attributes->get('href') }}" class="{{ $baseClasses }}" {{ $attributes }}>
        @if ($icon)
            <i class="fas fa-{{ $icon }} text-gray-500 mr-1"></i>
        @endif
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}" class="{{ $baseClasses }}" {{ $attributes }}>
        @if ($icon)
            <i class="fas fa-{{ $icon }} text-white mr-1"></i>
        @endif
        {{ $slot }}
    </button>
@endif
