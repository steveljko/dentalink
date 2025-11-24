@props([
    'name' => '',
    'label' => '',
    'required' => false,
    'placeholder' => '',
    'options' => [],
    'value' => null,
])

<fieldset class="fieldset">
    <legend class="fieldset-legend">
        {{ $label }}
        @if ($required) <span class="text-red-500">*</span>@endif
    </legend>
    <select id="{{ $name }}" name="{{ $name }}" class="select w-full"
        @if ($required) required @endif>
        @if (is_array($options) && count($options) > 0)
            @foreach ($options as $optionValue => $text)
                <option value="{{ $optionValue }}" {{ $optionValue == $value ? 'selected' : '' }}>
                    {{ $text }}
                </option>
            @endforeach
        @else
            {{ $slot }}
        @endif
    </select>
</fieldset>
