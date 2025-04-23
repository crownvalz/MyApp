<!-- Sidebar -->
<aside x-data="{ open: false }"  id="sidebar" class="bg-gray-950 text-white h-[calc(100vh-2rem)] shadow-xl fixed top-4 left-4 rounded-3xl p-4 w-64 transition-all duration-300 xl:block hidden overflow-hidden">
<!-- Logo and Branding -->
<div class="flex items-center justify-center mt-20 sidebar-header transition-all">
    <!-- Vertical Line Separator -->
    <div class="flex items-center">
        <div class="w-14 h-14 rounded-full overflow-hidden ml-3">
            <img src="{{ asset('img/' . $user->profile_pic) }}" class="object-cover w-full h-full object-center" alt="Logo">
        </div>
        <div class="ml-4 sidebar-text h-10 w-[2px] bg-gradient-to-b from-indigo-900 via-gray-500 to-indigo-300 mx-2"></div>
        <div class="flex flex-col items-start ml-3">
            <span class="menu-text font-semibold sidebar-text text-base">Motex tz</span>
            <span class="text-sm text-gray-500 sidebar-text">Worldwide motex</span>
        </div>
    </div>
</div>

<!-- Menu -->
    <nav class="flex flex-col items-start gap-2 mt-20" id="menu" aria-label="Main Navigation">
        <a href="{{ url('/excel') }}" class="menu-item flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-indigo-700 transition-all cursor-pointer w-full" id="excel">
            <i class="fa fa-filter text-lg"></i>
            <span class="menu-text font-semibold sidebar-text">Excel Filter</span>
        </a>
        <a href="{{ url('/dashboard') }}" class="menu-item flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-indigo-700 transition-all cursor-pointer w-full" id="dashboard">
            <i class="fa fa-tachometer-alt text-lg"></i>
            <span class="menu-text font-semibold sidebar-text">Dashboard</span>
        </a>
        <a href="{{ url('/staff') }}" class="menu-item flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-indigo-700 transition-all cursor-pointer w-full" id="employees">
            <i class="fa fa-users text-lg"></i>
            <span class="menu-text font-semibold sidebar-text">Employees list</span>
        </a>

        <a href="{{ url('/leave') }}" class="menu-item flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-indigo-700 transition-all cursor-pointer w-full" id="leave">
            <i class="fa fa-bed text-lg"></i>
            <span class="menu-text font-semibold sidebar-text">Leave</span>
        </a>

        <a href="{{ url('/stationery') }}" class="menu-item flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-indigo-700 transition-all cursor-pointer w-full" id="services">
            <i class="fa fa-cogs text-lg"></i>
            <span class="menu-text font-semibold sidebar-text">Store Requisition</span>
        </a>

        <a href="{{ url('/stockreport') }}" class="menu-item flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-indigo-700 transition-all cursor-pointer w-full" id="stockreport">
            <i class="fa fa-clipboard-list text-lg"></i>
            <span class="menu-text font-semibold sidebar-text">Stock Report</span>
        </a>

        <a href="{{ url('/stockreplenish') }}" class="menu-item flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-indigo-700 transition-all cursor-pointer w-full" id="stockreplenish">
            <i class="fa fa-sync-alt text-lg"></i>
            <span class="menu-text font-semibold sidebar-text">Stock Replenish</span>
        </a>
    </nav>

    <!-- Logout -->
    <div class="absolute bottom-6 left-4 right-4">
    <form action="{{ route('logout') }}" method="POST" class="w-full">
            @csrf <!-- CSRF token for protection -->
            <!-- Logout Button with Form -->
            <form action="{{ route('logout') }}" method="POST" class="w-full">
                @csrf
                <button type="submit" class="menu-item flex items-center gap-3 px-4 py-3 bg-indigo-800 hover:bg-indigo-600 rounded-xl transition-all cursor-pointer w-full">
                    <i class="fa fa-sign-out-alt text-lg"></i>
                    <span class="menu-text font-semibold sidebar-text">Logout</span>
                </button>
            </form>
        </form>
    </div>
</aside>