@props([
    'name' => '',
    'label' => '',
    'tooltip' => '',
    'required' => false,
])

@php
    $id = $attributes->get('id', $name);
    $value = old($name, $attributes->get('value', ''));
    $hasError = $errors->has($name);

    $baseClasses =
        'w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200';

    if ($hasError) {
        $baseClasses .= ' border-red-300 focus:ring-red-500 focus:border-red-500';
    } else {
        $baseClasses .= ' border-gray-300';
    }

    $class = $baseClasses . ' ' . $attributes->get('class', '');

    $inputAttributes = $attributes->except(['class', 'value', 'id']);
@endphp

<div class="mb-4">
    @if ($label)
        <label for="{{ $id }}" class="block text-sm font-medium text-gray-700 mb-1">
            {{ $label }}
            @if ($required)
                <span class="text-red-500">*</span>
            @endif
            @if ($tooltip)
                <span class="ml-1 text-gray-400 hover:text-gray-600 cursor-help relative"
                    data-tooltip="{{ $tooltip }}">
                    <svg class="inline-block w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z"
                            clip-rule="evenodd"></path>
                    </svg>
                </span>
            @endif
        </label>
    @endif

    <input type="{{ $attributes->get('type', 'text') }}" id="{{ $id }}" name="{{ $name }}"
        value="{{ $value }}" class="{{ $class }}" @if ($required) required @endif
        {{ $inputAttributes }}>
    <div id="{{ $name }}-error" class="mt-1 text-sm text-red-600"></div>
</div>
