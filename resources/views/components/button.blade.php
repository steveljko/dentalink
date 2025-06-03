@props([
    'type' => 'button',
    'size' => 'md',
    'variant' => 'primary',
    'class' => '',
    'text',
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
        ' rounded-md cursor-pointer inline-block text-center no-underline transition-colors';
@endphp

@if ($attributes->has('href'))
    <a href="{{ $attributes->get('href') }}" class="{{ $baseClasses }}" {{ $attributes }}>
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}" class="{{ $baseClasses }}" {{ $attributes }}>
        {{ $slot }}
    </button>
@endif
