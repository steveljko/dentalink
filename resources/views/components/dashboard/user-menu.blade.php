@props(['username'])

<div class="relative">
    <button id="userMenuButton" class="flex cursor-pointer items-center space-x-3 rounded-lg  ">
        <img src="https://ui-avatars.com/api/?name=Ema+R&background=3b82f6&color=ffffff" alt="User"
            class="w-10 h-10 rounded-full">
        <p class="text-sm font-medium text-gray-800">{{ $username }}</p>
        <i class="fas fa-chevron-down text-gray-400 text-sm"></i>
    </button>

    <div id="userDropdown"
        class="absolute hidden right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-200 z-50">
        <div class="py-2">
            <a href="#"
                class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors">
                <i class="fas fa-cog mr-3"></i>
                Settings
            </a>
            <hr class="my-2 border-gray-200">
            <a href="#"
                class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors">
                <i class="fas fa-sign-out-alt mr-3"></i>
                Logout
            </a>
        </div>
    </div>
</div>
