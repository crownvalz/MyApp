<!-- Header Section -->
<div x-data="{ open: false }" class="flex justify-between items-center p-4 bg-white shadow-lg rounded-lg sticky top-4 z-50">
    <!-- Welcome Text and Toggle Button -->
    <div class="flex items-center space-x-4">
        <!-- Toggle Button for Sidebar -->
        <button id="toggleSidebar" class="hidden xl:block text-gray-800 p-2 rounded-md hover:bg-gray-100 transition duration-200" aria-label="Toggle Sidebar">
            <i class="fa fa-bars text-lg"></i>
        </button>
        <!-- Welcome Text -->
        <h1 class="font-3 text-3xl font-semibold text-gray-900 hidden xl:block">
            Welcome, <span class="text-blue-600 font-bold">{{ explode(' ', $user?->name ?? '')[2] ?? '' }}</span>
        </h1>
        <h1 class="text-4xl font-semibold text-gray-900 xl:hidden font-3">Motex tz</h1>
    </div>
    <!-- User Profile and Settings -->
    <div class="flex items-center space-x-4">
        <!-- Mobile Profile Button -->
        <button class="sm:hidden block text-gray-900 transition-transform transform hover:scale-105 focus:outline-none" id="toggleButton">
            <div class="w-10 h-10 overflow-hidden rounded-full border-2 border-gray-300">
                <img src="{{ asset('img/mono.svg') }}" class="object-cover w-full h-full" alt="User">
            </div>
        </button>
        <!-- Desktop Profile and Settings -->
        <div id="searchUserContainer" class="hidden sm:flex items-center space-x-4">
            <!-- Settings Icon -->
            <a href="{{ url('/edit') }}" class="w-10 h-10 flex items-center justify-center rounded-lg border border-gray-300 text-gray-600 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200">
                <i class="fa fa-gear text-lg"></i>
            </a>
            <!-- Messages Icon -->
            <button class="w-10 h-10 flex items-center justify-center rounded-lg border border-gray-300 text-gray-600 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200">
                <i class="fa fa-envelope text-lg"></i>
            </button>
            <!-- Notifications Icon -->
            <a href="{{ url('/profile') }}" class="w-10 h-10 flex items-center justify-center rounded-lg border border-gray-300 text-gray-600 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200">
                <i class="fa fa-user text-lg"></i>
            </a>
            <!-- User Profile -->

            <div class="flex items-center space-x-3">
            <div class="ml-4 h-8 w-[2px] bg-gradient-to-b from-indigo-900 via-gray-500 to-indigo-300 mx-2"></div>
                <div class="flex flex-col items-start ml-3 p-3">
                    <span class="menu-text font-semibold text-base">{{ $user->branch }}</span>
                    <span class="text-sm text-indigo-700">{{ $user->position }}</span>
                </div>
            </div>
        </div>
    </div>
</div>