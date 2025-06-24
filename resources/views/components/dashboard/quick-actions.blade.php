@props(['logs'])

<div class="bg-white rounded-lg shadow">
    <div class="p-6 border-b border-gray-200">
        <h3 class="text-lg font-semibold text-gray-800">{{ __('dashboard.quick_actions') }}</h3>
    </div>
    <div class="p-6">
        <div class="grid grid-cols-2 gap-4">
            <button hx-get="{{ route('patient.create') }}" hx-target="#dialog"
                class="cursor-pointer flex flex-col items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                <i class="fas fa-user-plus text-2xl text-blue-600 mb-2"></i>
                <span class="text-sm font-medium text-gray-800">{{ __('dashboard.add_patient') }}</span>
            </button>

            <button
                class="cursor-pointer flex flex-col items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                <i class="fas fa-calendar-plus text-2xl text-green-600 mb-2"></i>
                <span class="text-sm font-medium text-gray-800">{{ __('dashboard.schedule_appointment') }}</span>
            </button>
        </div>
    </div>
</div>
