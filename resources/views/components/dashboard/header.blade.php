<header class="bg-white border-b border-gray-300 px-6 py-4">
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-semibold text-gray-800">{{ __('dashboard.title') }}</h2>
            <p class="text-gray-600">{{ __('dashboard.welcome_back', ['name' => auth()->user()->name]) }}</p>
        </div>

        <div class="flex items-center space-x-10">
            <div class="relative">
                <input type="text" placeholder="{{ __('dashboard.search_patients') }}"
                    class="w-[360px] pl-10  pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
            </div>

            <x-dashboard.user-menu :name="auth()->user()->name" />
        </div>
    </div>
</header>
