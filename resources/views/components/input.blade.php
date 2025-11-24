@props([
'name' => '',
'label' => '',
'type' => 'text',
'required' => false,
])

<fieldset class="fieldset">
    <legend class="fieldset-legend">
        {{ $label }}
        @if ($required) <span class="text-red-500">*</span>@endif
    </legend>
    <input type="{{ $type }}" name="{{ $name }}" class="input w-full" placeholder="{{ $label }}" :required="{{ $required }}" />
</fieldset>

