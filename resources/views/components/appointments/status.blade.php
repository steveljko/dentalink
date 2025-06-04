@props(['status'])

<span
    class="px-2.5 py-0.5 rounded-full text-xs font-medium
    @if ($status === 'completed') bg-green-100 text-green-800
    @elseif($status === 'scheduled') bg-blue-100 text-blue-800
    @elseif($status === 'cancelled') bg-red-100 text-red-800
    @elseif($status === 'no_show') bg-gray-100 text-gray-800
    @else bg-yellow-100 text-yellow-800 @endif">
    {{ __("appointments.$status") }}
</span>
