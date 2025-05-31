<div class="bg-white rounded-lg shadow">
    <div class="p-6 border-b border-gray-200">
        <h3 class="text-lg font-semibold text-gray-800">{{ __('dashboard.quick_actions') }}</h3>
    </div>
    <div class="p-6">
        <div class="grid grid-cols-2 gap-4">
            <button
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

        <div class="mt-6 pt-6 border-t border-gray-200">
            <h4 class="font-medium text-gray-800 mb-3">{{ __('dashboard.recent_notifications') }}</h4>
            <div class="space-y-2">
                <div class="flex items-start space-x-3 p-3 bg-blue-50 rounded-lg">
                    <i class="fas fa-info-circle text-blue-600 mt-0.5"></i>
                    <div>
                        <p class="text-sm text-gray-800">New patient registration completed</p>
                        <p class="text-xs text-gray-600">2 minutes ago</p>
                    </div>
                </div>
                <div class="flex items-start space-x-3 p-3 bg-yellow-50 rounded-lg">
                    <i class="fas fa-exclamation-triangle text-yellow-600 mt-0.5"></i>
                    <div>
                        <p class="text-sm text-gray-800">Appointment reminder: Sarah Johnson</p>
                        <p class="text-xs text-gray-600">15 minutes ago</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
