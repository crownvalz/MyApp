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

<!-- Employee Leave Summary Section -->
<div class="p-1 rounded-lg mt-1">
    <!-- Desktop Grid -->
    <div class="rounded-4xl max-w-auto mx-auto my-6 grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="bg-white p-6 rounded-lg shadow-md transition-transform transform hover:scale-105 hover:shadow-xl flex items-center space-x-4">
            <i class="fa fa-users text-blue-500 text-4xl"></i>
            <div>
                <h2 class="text-lg font-semibold">Employees on Leave</h2>
                <p class="text-blue-700 text-3xl font-bold">{{ $leaveTable->count() }}</p>
            </div>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-md transition-transform transform hover:scale-105 hover:shadow-xl flex items-center space-x-4">
            <i class="fa fa-briefcase text-green-500 text-4xl"></i>
            <div>
                <h2 class="text-lg font-semibold">Emergency Leave</h2>
                <p class="text-blue-700 text-3xl font-bold">{{ $leaveTable->where('leave_type', 'Emergency Leave')->count() }}</p>
            </div>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-md transition-transform transform hover:scale-105 hover:shadow-xl flex items-center space-x-4">
            <i class="fa fa-calendar-check text-yellow-500 text-4xl"></i> <!-- Changed icon -->
            <div>
                <h2 class="text-lg font-semibold">Annual Leave</h2>
                <p class="text-blue-700 text-3xl font-bold">{{ $leaveTable->where('leave_type', 'Annual Leave')->count() }}</p>
            </div>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-md transition-transform transform hover:scale-105 hover:shadow-xl flex items-center space-x-4">
            <i class="fa fa-baby-carriage text-yellow-500 text-4xl"></i> <!-- Changed icon -->
            <div>
                <h2 class="text-lg font-semibold">Maternity Leave</h2>
                <p class="text-blue-700 text-3xl font-bold">{{ $leaveTable->where('leave_type', 'Maternity Leave')->count() }}</p>
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
            <a href="#" class="font-3 px-3 py-1 rounded-lg border border-gray-700 focus:ring-blue-500 transition-colors hover:bg-gray-400 text-Blue-600" onclick="openLeaveModal()">+ Apply for leave</a>
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
            <table class="w-full border-collapse border border-gray-300 text-left">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="border p-2 cursor-pointer">
                        ID <span x-show="column === 'name'"  ></span>
                        </th>
                        <th class="border p-2 cursor-pointer">
                        Employee Name <span x-show="column === 'email'"  ></span>
                        </th>
                        <th class="border p-2 cursor-pointer">
                        Leave Type <span x-show="column === 'position'"  ></span>
                        </th>
                        <th class="border p-2 cursor-pointer hidden sm:table-cell">
                        Start Date <span x-show="column === 'salary'"  ></span>
                        </th>
                        <th class="border p-2 cursor-pointer hidden sm:table-cell">
                        End Date <span x-show="column === 'leave_bal'"  ></span>
                        </th>
                        <th class="border p-2 cursor-pointer hidden sm:table-cell">
                        Days Applied <span x-show="column === 'leave_bal'"  ></span>
                        </th>
                        <th class="border p-2 cursor-pointer hidden sm:table-cell">
                        Status <span x-show="column === 'leave_bal'"  ></span>
                        </th>
                        <th class="border p-2">Action</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($leaveTable as $leave)
                        <tr class="hover:bg-gray-50">
                            <td class="border p-2">{{ $leave->id }}</td>
                            <td class="border p-2">{{ optional($leave->employee)->name ?? 'No Employee Found' }}</td>
                            <td class="border p-2">{{ $leave->leave_type }}</td>
                            <td class="border p-2 hidden sm:table-cell">{{ $leave->start_date }}</td>
                            <td class="border p-2 hidden sm:table-cell">{{ $leave->end_date }}</td>
                            <td class="border p-2">
                                {{ \Carbon\Carbon::parse($leave->start_date)->diffInDays(\Carbon\Carbon::parse($leave->end_date)) + 1 }}
                            </td>
                            <td class="border p-2">{{ $leave->status }}</td>
                            <td class="border p-2">
                            <div class="flex space-x-2">
                                <!-- Approve Button -->
                                <form action="{{ route('leave.approve', $leave->id) }}" method="POST">
                                    @csrf
                                    @method('PUT') 
                                    <button type="submit" class="text-green-600 hover:text-green-800">
                                        <i class="fa fa-check"></i> Approve
                                    </button>
                                </form>

                                <!-- Reject Button -->
                                <form action="{{ route('leave.reject', $leave->id) }}" method="POST">
                                    @csrf
                                    @method('PUT') 
                                    <button type="submit" class="text-red-600 hover:text-red-800">
                                        <i class="fa fa-times"></i> Reject
                                    </button>
                                </form>

                                <!-- Edit Button (opens modal) -->
                                <button type="button" class="text-blue-600 hover:text-blue-800" onclick="openLeaveEditModal({{ $leave->id }})">
                                    <i class="fa fa-edit"></i> Edit
                                </button>
                            </div>
                        </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
        </div> 
    </div> 
    
    


    <!-- Edit Leave Form Modal -->
<div id="editLeaveModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 backdrop-blur-md hidden">
    <div class="bg-white p-6 rounded-2xl shadow-xl w-full max-w-md transform transition-all scale-95">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-xl font-semibold text-gray-700">Apply for Leave</h3>
            <button onclick="closeEditLeaveModal()" class="text-2xl font-bold text-gray-500 hover:text-gray-700">&times;</button>
        </div>
        <form action="{{ route('leaves.store') }}" method="POST" class="space-y-4">
            @csrf
            <select name="employee_id" class="w-full p-3 rounded-lg border focus:ring-2 focus:ring-blue-400" required>
                <option value="">Select Employee</option>
                @foreach($allstaff as $employee)
                    <option value="{{ $staff->id }}">{{ $staff->name }}</option>
                @endforeach
            </select>

            <!-- Leave Type Dropdown -->
            <select name="leave_type" class="w-full p-3 rounded-lg border focus:ring-2 focus:ring-blue-400" required>
                <option value="">Select Leave Type</option>
                <option value="Annual Leave">Annual Leave</option>
                <option value="Emergency Leave">Emergency Leave</option>
                <option value="Maternity Leave">Maternity Leave</option>
                <option value="Sick Leave">Sick Leave</option>
            </select>

            <input type="date" name="start_date" placeholder="Start Date" class="w-full p-3 rounded-lg border focus:ring-2 focus:ring-blue-400" required>
            <input type="date" name="end_date" placeholder="End Date" class="w-full p-3 rounded-lg border focus:ring-2 focus:ring-blue-400" required>

            <textarea name="reason" placeholder="Reason for Leave" class="w-full p-3 rounded-lg border focus:ring-2 focus:ring-blue-400" rows="3" required></textarea>

            <div class="flex justify-end gap-3 pt-4">
                <button type="button" onclick="closeEditLeaveModal()" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400">Cancel</button>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Apply</button>
            </div>
        </form>
    </div>
</div>


<!-- Apply Leave Form Modal -->
<div id="apply-leave-modal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 backdrop-blur-md hidden">
    <div class="bg-white p-6 rounded-2xl shadow-xl w-full max-w-md transform transition-all scale-95">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-xl font-semibold text-gray-700">Apply for Leave</h3>
            <button onclick="closeLeaveModal()" class="text-2xl font-bold text-gray-500 hover:text-gray-700">&times;</button>
        </div>

        <!-- Display Leave Days -->
        <div id="leave-days-display" class="text-lg font-semibold text-blue-600 text-center mb-3">
            Leave Days: <span id="leave-days">0</span>
        </div>

        <form action="{{ route('leaves.store') }}" method="POST" class="space-y-4">
            @csrf
            <select name="employee_id" class="w-full p-3 rounded-lg border focus:ring-2 focus:ring-blue-400" required>
                <option value="">Select Employee</option>
                @foreach($allstaff as $employee)
                    <option value="{{ $staff->id }}">{{ $staff->name }}</option>
                @endforeach
            </select>

            <!-- Leave Type Dropdown -->
            <select name="leave_type" class="w-full p-3 rounded-lg border focus:ring-2 focus:ring-blue-400" required>
                <option value="">Select Leave Type</option>
                <option value="Annual Leave">Annual Leave</option>
                <option value="Emergency Leave">Emergency Leave</option>
                <option value="Maternity Leave">Maternity Leave</option>
                <option value="Sick Leave">Sick Leave</option>
            </select>

            <input type="date" id="start_date" name="start_date" class="w-full p-3 rounded-lg border focus:ring-2 focus:ring-blue-400" required>
            <input type="date" id="end_date" name="end_date" class="w-full p-3 rounded-lg border focus:ring-2 focus:ring-blue-400" required>

            <textarea name="reason" placeholder="Reason for Leave" class="w-full p-3 rounded-lg border focus:ring-2 focus:ring-blue-400" rows="3" required></textarea>

            <div class="flex justify-end gap-3 pt-4">
                <button type="button" onclick="closeLeaveModal()" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400">Cancel</button>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Apply</button>
            </div>
        </form>
    </div>
</div>
</main>






<script>
    // Open Apply Leave Modal Function
    function openLeaveEditModal() {
        document.getElementById('editLeaveModal').classList.remove('hidden');
    }

    // Close Apply Leave Modal Function
    function closeEditLeaveModal() {
        document.getElementById('editLeaveModal').classList.add('hidden');
    }
</script>





<script>
    function calculateLeaveDays() {
        const startDate = document.getElementById("start_date").value;
        const endDate = document.getElementById("end_date").value;
        const leaveDaysDisplay = document.getElementById("leave-days");

        if (startDate && endDate) {
            const start = new Date(startDate);
            const end = new Date(endDate);
            const diffTime = end - start;
            const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)) + 1; // Including the last day

            leaveDaysDisplay.textContent = diffDays > 0 ? diffDays : 0;
        } else {
            leaveDaysDisplay.textContent = 0;
        }
    }

    document.getElementById("start_date").addEventListener("change", calculateLeaveDays);
    document.getElementById("end_date").addEventListener("change", calculateLeaveDays);
</script>


<script>
    // Open Apply Leave Modal Function
    function openLeaveModal() {
        document.getElementById('apply-leave-modal').classList.remove('hidden');
    }

    // Close Apply Leave Modal Function
    function closeLeaveModal() {
        document.getElementById('apply-leave-modal').classList.add('hidden');
    }
</script>
    
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
