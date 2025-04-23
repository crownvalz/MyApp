<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee List</title>
    <link href="https://fonts.googleapis.com/css2?family=Bangers&display=swap" rel="stylesheet">
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script&display=swap" rel="stylesheet">

    <style>
    @import url('https://fonts.googleapis.com/css2?family=Great+Vibes&family=Poppins:wght@300;400;600&family=Roboto:wght@300;400;700&family=Lobster&family=Montserrat:wght@300;400;700&family=Playfair+Display:wght@400;700&family=Raleway:wght@300;400;600&family=Oswald:wght@300;400;700&family=Pacifico&family=Merriweather:wght@300;400;700&family=Quicksand:wght@300;400;600&family=Work+Sans:wght@300;400;600&family=Bebas+Neue&family=Dancing+Script:wght@400;700&display=swap');

    .font-1 { font-family: 'Great Vibes', cursive; }
    .font-2 { font-family: 'Poppins', sans-serif; }
    .font-3 { font-family: 'Roboto', sans-serif; }
    .font-4 { font-family: 'Lobster', cursive; }
    .font-5 { font-family: 'Montserrat', sans-serif; }
    .font-6 { font-family: 'Playfair Display', serif; }
    .font-7 { font-family: 'Raleway', sans-serif; }
    .font-8 { font-family: 'Oswald', sans-serif; }
    .font-9 { font-family: 'Pacifico', cursive; }
    .font-10 { font-family: 'Merriweather', serif; }
    .font-11 { font-family: 'Quicksand', sans-serif; }
    .font-12 { font-family: 'Work Sans', sans-serif; }
    .font-13 { font-family: 'Bebas Neue', sans-serif; }
    .font-14 { font-family: 'Dancing Script', cursive; }
</style>
</head>
<body class="bg-gray-50 flex">

<!-- Sidebar -->
<aside id="sidebar" class="bg-blue-500 text-white h-[calc(100vh-2rem)] shadow-xl fixed top-4 left-4 rounded-3xl p-4 w-64 transition-all duration-300 xl:block hidden overflow-hidden">
<!-- Logo and Branding -->
<div class="flex items-center gap-3 mt-6 sidebar-header transition-all duration-300 left-4 right-4">
    <div class="flex items-center gap-3 rounded-xl transition-all cursor-pointer w-full bg-brand-primary hover:bg-brand-primary-light focus:outline-none">
        <div class="w-15 h-12 rounded-full overflow-hidden">
            <img src="{{ asset('img/efatha.png') }}" class="object-cover w-full h-full" alt="Logo">
        </div>
        <span class="font-3 text-xl font-bold text-gray-900 hover:text-brand-text-light sidebar-text">
         Church
        </span>
    </div>
</div>
<!-- Menu -->
<nav class="flex flex-col items-start gap-2 mt-10" id="menu" aria-label="Main Navigation">
    <a href="{{ url('/dashboard') }}" class="menu-item flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-blue-600 transition-all cursor-pointer w-full" id="dashboard">
        <i class="fa fa-tachometer-alt text-lg"></i>
        <span class="menu-text font-semibold sidebar-text">Dashboard</span>
    </a>

    <a href="{{ url('/employees') }}" class="menu-item flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-blue-600 transition-all cursor-pointer w-full" id="employees">
        <i class="fa fa-user text-lg"></i>
        <span class="menu-text font-semibold sidebar-text">Employees list</span>
    </a>

    <a href="{{ url('/leaves') }}" class="menu-item flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-blue-600 transition-all cursor-pointer w-full" id="leave">
        <i class="fa fa-plane text-lg"></i>
        <span class="menu-text font-semibold sidebar-text">Leave</span>
    </a>

    <a href="{{ url('/requests') }}" class="menu-item flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-blue-600 transition-all cursor-pointer w-full" id="services">
        <i class="fa fa-gear text-lg"></i>
        <span class="menu-text font-semibold sidebar-text">Store Requisition</span>
    </a>

    <a href="{{ url('/employees') }}" class="menu-item flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-blue-600 transition-all cursor-pointer w-full" id="reports">
        <i class="fa fa-chart-line text-lg"></i>
        <span class="menu-text font-semibold sidebar-text">Reports</span>
    </a>
</nav>

    <!-- Logout -->
    <div class="absolute bottom-6 left-4 right-4">
        <div class="menu-item flex items-center gap-3 px-4 py-3 bg-red-500 hover:bg-red-600 rounded-xl transition-all cursor-pointer w-full">
            <i class="fa fa-sign-out-alt text-lg"></i>
            <span class="menu-text font-semibold sidebar-text">Logout</span>
        </div>
    </div>
</aside>



<!-- Main Content -->
<main id="mainContent" class="ml-0 xl:ml-[17rem] flex-1 p-4 space-y-8 transition-all duration-300">
    
<!-- Header Section -->
<div class="flex justify-between items-center p-4 rounded-lg sticky top-4">
    <!-- Welcome Text and Toggle Button -->
    <div class="flex items-center space-x-4">
        <!-- Toggle Button for Sidebar -->
        <button id="toggleSidebar" class="hidden xl:block text-gray-800 p-2 rounded-md" aria-label="Toggle Sidebar">
            <i class="fa fa-bars"></i>
        </button>
        <!-- Welcome Text -->
        <h1 class="font-3 text-3xl font-semibold text-gray-900 hidden xl:block">Welcome, <span class="text-blue-700 font-3">{{ explode(' ', $staff?->name ?? '')[0] ?? '' }}</span></h1>
        <h1 class="text-4xl font-semibold text-gray-900 xl:hidden font-3">Crownvalz</h1>
    </div>
    <!-- User Profile and Settings -->
    <div class="flex items-center space-x-4">
        <button class="sm:hidden block text-gray-900 transition-transform transform hover:scale-105" id="toggleButton">
            <div class="w-8 h-8 overflow-hidden rounded-full">
                <img src="{{ asset('img/mono.svg') }}" class="object-cover w-full h-full" alt="User">
            </div>
        </button>
        <div id="searchUserContainer" class="hidden sm:flex items-center space-x-4">
            <i class="fa fa-cogs p-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors hover:bg-gray-200"></i>
            <i class="fa fa-envelope p-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors hover:bg-gray-200"></i>

            <div class="flex items-center space-x-2">
                <div class="w-8 h-8 overflow-hidden rounded-full">
                    <img src="{{ asset('img/mono.svg') }}" class="object-cover w-full h-full" alt="User">
                </div>
                <span class="text-gray-700 font-medium font-3">{{ $staff?->name ?? '' }}</span>
            </div>
        </div>
    </div>
</div>


    <!-- Trending Products Section -->
    <div class="p-1 rounded-lg mt-1">
    <!-- Desktop Grid -->
    <div class="rounded-4xl max-w-auto mx-auto my-6 grid grid-cols-1 md:grid-cols-3 gap-6">
    <div class="bg-white p-6 rounded-lg shadow-md transition-transform transform hover:scale-105 hover:shadow-xl flex items-center space-x-4">
        <i class="fa fa-users text-blue-500 text-4xl"></i>
        <div>
            <h2 class="text-lg font-semibold">Total Employees</h2>
            <p class="text-blue-700 text-3xl font-bold">
                {{ $staff && $staff->count() > 0 ? $staff->count() : '' }}
            </p>
        </div>
    </div>
    <div class="bg-white p-6 rounded-lg shadow-md transition-transform transform hover:scale-105 hover:shadow-xl flex items-center space-x-4">
        <i class="fa fa-briefcase text-green-500 text-4xl"></i>
        <div>
            <h2 class="text-lg font-semibold">Departments</h2>
            <p class="text-blue-700 text-3xl font-bold">
                {{ $staff && $staff->pluck('position')->unique()->count() > 0 ? $staff->pluck('position')->unique()->count() : '' }}
            </p>
        </div>
    </div>
    <div class="bg-white p-6 rounded-lg shadow-md transition-transform transform hover:scale-105 hover:shadow-xl flex items-center space-x-4">
        <i class="fa fa-dollar-sign text-yellow-500 text-4xl"></i>
        <div>
            <h2 class="text-lg font-semibold">Payroll Processed</h2>
            <p class="text-blue-700 text-3xl font-bold">
                {{ $staff && $staff->sum('salary') > 0 ? '$' . number_format($staff->sum('salary'), 2) : '' }}
            </p>
        </div>
    </div>
</div>
</div>

<!-- Trending Products Section -->
<div class="p-1 rounded-lg">
    <div class="bg-white p-4 rounded-lg shadow-md">
        <!-- Header Section -->
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-lg text-blue-500 font-3">Trending Products</h2>
            <a href="#" class="font-3 px-3 py-1 rounded-lg border border-gray-700 focus:ring-blue-500 transition-colors hover:bg-gray-400 text-Blue-600" onclick="openModal()">+ Add User</a>
        </div>

        <!-- Success / Error Message -->
        @if(session('success') || session('error'))
            <div class="p-2 mb-4 rounded mt-4 
                        {{ session('success') ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                {{ session('success') ?? session('error') }}
            </div>
        @endif

        <!-- Employee Table -->
        <div class="hidden md:block mt-6">
        <table class="min-w-full border-collapse border border-gray-200">
    <thead>
        <tr>
            <th class="border p-2">Name</th>
            <th class="border p-2">Email</th>
            <th class="border p-2">Position</th>
            <th class="border p-2 hidden sm:table-cell">Salary</th>
            <th class="border p-2 hidden sm:table-cell">Leave Balance</th>
            <th class="border p-2">Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse($allstaff as $staff)
            <tr class="hover:bg-gray-50 font-3">
                <td class="border p-2">{{ $staff->name }}</td>
                <td class="border p-2">{{ $staff->email }}</td>
                <td class="border p-2">{{ $staff->position }}</td>
                <td class="border p-2 hidden sm:table-cell">{{ number_format($staff->salary, 2) }}</td>
                <td class="border p-2 hidden sm:table-cell">{{ $staff->leave_bal }}</td>
                <td class="border p-2">
                    <form action="{{ route('employees.destroy', $staff->id) }}" method="POST" class="inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-800">
                            <i class="fa fa-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6" class="text-center">No employees found.</td>
            </tr>
        @endforelse
    </tbody>
</table>
        </div>
    </div> 
    </div> 
    
    




<!-- Employee Form Modal -->

<div id="modal" class="flex fixed inset-0 hidden items-center justify-center bg-black bg-opacity-50 backdrop-blur-md">
    <div class="bg-white p-6 rounded-2xl shadow-xl w-full max-w-md transform transition-all scale-95">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-xl font-semibold text-gray-700">Add Employee</h3>
            <button onclick="closeModal()" class="text-2xl font-bold text-gray-500 hover:text-gray-700">&times;</button>
        </div>
        <form action="{{ route('employees.store') }}" method="POST" class="space-y-4 font-3">
            @csrf
            <input type="text" name="name" placeholder="Full Name" class="w-full p-3 rounded-lg border focus:ring-2 focus:ring-blue-400" required>
            <input type="email" name="email" placeholder="Email Address" class="w-full p-3 rounded-lg border focus:ring-2 focus:ring-blue-400" required>
            
            <select name="position" class="w-full p-3 rounded-lg border focus:ring-2 focus:ring-blue-400" required>
                <option value="">Select Position</option>
                <option value="Manager">Manager</option>
                <option value="Supervisor">Supervisor</option>
                <option value="Clerk">Clerk</option>
                <option value="Intern">Intern</option>
            </select>
            
            <input type="number" name="salary" placeholder="Salary" class="w-full p-3 rounded-lg border focus:ring-2 focus:ring-blue-400" required>
            
            <div class="flex justify-end gap-3 pt-4">
                <button type="button" onclick="closeModal()" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400">Cancel</button>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Save</button>
            </div>
        </form>
    </div>
</div>






<!-- Employee Form Modal -->

<div id="modal" class="flex fixed inset-0 hidden items-center justify-center bg-black bg-opacity-50 backdrop-blur-md">
    <div class="bg-white p-6 rounded-2xl shadow-xl w-full max-w-md transform transition-all scale-95">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-xl font-semibold text-gray-700">Add Employee</h3>
            <button onclick="closeModal()" class="text-2xl font-bold text-gray-500 hover:text-gray-700">&times;</button>
        </div>
        <form action="{{ route('employees.store') }}" method="POST" class="space-y-4 font-3">
            @csrf
            <input type="text" name="name" placeholder="Full Name" class="w-full p-3 rounded-lg border focus:ring-2 focus:ring-blue-400" required>
            <input type="email" name="email" placeholder="Email Address" class="w-full p-3 rounded-lg border focus:ring-2 focus:ring-blue-400" required>
            
            <select name="position" class="w-full p-3 rounded-lg border focus:ring-2 focus:ring-blue-400" required>
                <option value="">Select Position</option>
                <option value="Manager">Manager</option>
                <option value="Supervisor">Supervisor</option>
                <option value="Clerk">Clerk</option>
                <option value="Intern">Intern</option>
            </select>
            
            <input type="number" name="salary" placeholder="Salary" class="w-full p-3 rounded-lg border focus:ring-2 focus:ring-blue-400" required>
            
            <div class="flex justify-end gap-3 pt-4">
                <button type="button" onclick="closeModal()" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400">Cancel</button>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Save</button>
            </div>
        </form>
    </div>
</div>
</main>





<script>
    // JavaScript for Toggle
    document.getElementById("menu-toggle").addEventListener("click", function() {
        let mobileMenu = document.getElementById("mobile-menu");
        mobileMenu.classList.toggle("hidden");
    });
    // Open Modal Function
    function openModal() {
        document.getElementById('modal').classList.remove('hidden');
    }

    // Close Modal Function
    function closeModal() {
        document.getElementById('modal').classList.add('hidden');
    }

    // Get Current Day of the Week and Display It
    const daysOfWeek = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
    const today = new Date();
    const dayName = daysOfWeek[today.getDay()];
    document.getElementById('day-of-week').innerText = `Today is ${dayName}`;
</script>
<!-- JavaScript to toggle sidebar -->
<!-- JavaScript to toggle sidebar -->
<script>
const sidebar = document.getElementById('sidebar');
const mainContent = document.getElementById('mainContent');
const toggleButton = document.getElementById('toggleSidebar');
const menuItems = document.querySelectorAll('.menu-item');
const menuTextElements = document.querySelectorAll('.sidebar-text');

// Function to apply sidebar state
function applySidebarState(collapsed) {
    // Apply the correct sidebar width and text visibility
    sidebar.classList.toggle('w-20', collapsed);
    sidebar.classList.toggle('transition-all', true); // Ensures smooth transition for sidebar

    menuTextElements.forEach(text => text.classList.toggle('hidden', collapsed));

    // Apply the correct margin for main content, ensuring smooth transition
    mainContent.classList.toggle('xl:ml-[6rem]', collapsed);
    mainContent.classList.toggle('xl:ml-[17rem]', !collapsed);

    // Apply transition to main content for smooth margin change
    mainContent.classList.toggle('transition-all', true); 
}

// Load and apply sidebar state
const isCollapsed = localStorage.getItem('sidebarCollapsed') === 'true';
applySidebarState(isCollapsed);

// Toggle sidebar and save state
toggleButton.addEventListener('click', () => {
    const collapsed = sidebar.classList.toggle('w-20');
    sidebar.classList.toggle('transition-all', true); // Ensures smooth transition for sidebar

    menuTextElements.forEach(text => text.classList.toggle('hidden', collapsed));

    // Apply the correct margin for main content, ensuring smooth transition
    mainContent.classList.toggle('xl:ml-[6rem]', collapsed);
    mainContent.classList.toggle('xl:ml-[17rem]', !collapsed);
    mainContent.classList.toggle('transition-all', true); // Apply transition to main content

    localStorage.setItem('sidebarCollapsed', collapsed);
});

// Highlight selected menu item and remember it
menuItems.forEach(item => {
    item.addEventListener('click', () => {
        menuItems.forEach(i => i.classList.remove('bg-blue-600')); // Remove all highlights
        item.classList.add('bg-blue-600'); // Highlight clicked item
        localStorage.setItem('activeMenuItem', item.id); // Store selected item
    });
});

// Apply saved menu selection
const activeMenuItem = localStorage.getItem('activeMenuItem');
if (activeMenuItem) {
    document.getElementById(activeMenuItem)?.classList.add('bg-blue-600');
}
</script>

</body>
</html>