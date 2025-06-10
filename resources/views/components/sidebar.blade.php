<div class="hidden lg:block bg-blue-900 text-white w-80 min-h-screen p-4">
    <div class="flex items-center mb-8">
        <i class="fas fa-tooth text-2xl mr-3"></i>
        <h1 class="text-xl font-bold">DentaLink</h1>
    </div>

    <nav class="space-y-2">
        <a href="{{ route('dashboard') }}"
            class="flex items-center p-3 rounded-lg hover:bg-blue-800 transition-colors {{ request()->routeIs('dashboard') ? 'bg-blue-800' : '' }}">
            <i class="fas fa-chart-line mr-3"></i>
            {{ __('dashboard.title') }}
        </a>

        <a href="{{ route('patient.index') }}"
            class="flex items-center p-3 rounded-lg hover:bg-blue-800 transition-colors {{ request()->routeIs('patient.*') ? 'bg-blue-800' : '' }}">
            <i class="fas fa-users mr-3"></i>
            {{ __('patients.title') }}
        </a>

        <a href="{{ route('appointment.index') }}"
            class="flex items-center p-3 rounded-lg hover:bg-blue-800 transition-colors {{ request()->routeIs('appointment.*') ? 'bg-blue-800' : '' }}">
            <i class="fas fa-calendar-alt mr-3"></i>
            {{ __('appointments.title') }}
        </a>
    </nav>
</div>
