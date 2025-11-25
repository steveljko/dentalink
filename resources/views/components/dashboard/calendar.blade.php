@props(['appointments'])

<div class="bg-white rounded-lg border border-gray-200">
    <div class="p-6 border-b border-gray-200">
        <h3 class="text-lg font-semibold text-gray-800">{{ __('dashboard.today_appoitments') }}</h3>
    </div>
    <div class="px-6 py-2">
        <div id="calendar" data-appointments="{{ json_encode($appointments) }}"></div>
    </div>
</div>
