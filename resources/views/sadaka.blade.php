@extends('layouts.app')
@section('content')

<!-- Main Content -->
<section class="py-6 px-4">
    <div class="grid grid-cols-1 md:grid-cols-1 gap-6">
        <!-- User Info & sadakas Table -->
        <div class="bg-white p-6 rounded-xl shadow-lg text-gray-800">
            <div class="flex flex-col items-center mb-6">
                <img src="{{ asset('img/Career.jpeg') }}" alt="Employee Photo" class="w-32 h-32 object-cover rounded-full border-4 border-gray-300 mb-4 shadow-lg">
                <h3 class="font-semibold text-2xl">{{ $user?->name ?? '' }}</h3>
                <p class="text-lg text-blue-700">{{ $user->position ?? '' }}</p>
            </div>

<!-- Search and Action Buttons -->
    <div class="flex flex-col sm:flex-row justify-between items-center gap-4 mb-6">
        <!-- Search Bar -->
        <div class="relative flex w-full sm:w-auto gap-2">
            <input type="text" id="searchInput" onkeyup="filterTableBySearch()" placeholder="Search requests..." class="bg-gray-100 hover:bg-gray-200 w-full px-4 py-3 pl-12 rounded-lg text-sm shadow-md focus:outline-none" />
            <i class="fa fa-search absolute left-4 top-3 text-gray-500 text-sm"></i>
        </div>

        <!-- Filter Dropdown & Buttons -->
        <div class="flex w-full sm:w-auto items-center gap-4">
            <select id="statusFilter" class="border border-gray-300 rounded-md px-4 py-2 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-400">
                <option value="All">Filter by Status</option>
                <option value="pending">Pending</option>
                <option value="approved">Approved</option>
                <option value="rejected">Rejected</option>
            </select>
            <!-- Add user -->
            <button onclick="document.getElementById('sadakaModal').classList.remove('hidden')" class="bg-blue-600 hover:bg-yellow-700 text-white px-3 py-1 rounded-md text-lg font-medium flex items-center gap-2">
                <i class="fa fa-file-excel p-1 rounded-md"></i>
                + Sadaka</button>
                <button id="exportExcelButton" onclick="exportToExcel()" class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded-md text-lg font-medium flex items-center gap-2">
                <i class="fa fa-file-excel p-1 rounded-md"></i>
            </button>
        </div>
    </div>

<!-- Table -->
@include('layouts.tables')

<!-- Pagination -->
    <!-- Pagination -->
    <div id="pagination" class="flex justify-center items-center mt-3 space-x-4">
        <button id="prevBtn" onclick="changePage('prev')" class="bg-gradient-to-r from-indigo-600 to-blue-600 text-white px-3 py-2 rounded-full shadow-xl text-lg font-medium flex items-center justify-center gap-3 hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-500 transition duration-300 ease-in-out transform hover:scale-105">
            <i class="fa fa-chevron-left text-sm"></i> <!-- Left Arrow Icon for Previous -->
        </button>

        <!-- Page Number Display -->
        <span id="pageDisplay" class="text-sm font-semibold text-gray-900 bg-white shadow-xl rounded-full px-5 py-2 border border-gray-300">Page 1</span>

        <button id="nextBtn" onclick="changePage('next')" class="bg-gradient-to-r from-indigo-600 to-blue-600 text-white px-3 py-2 rounded-full shadow-xl text-lg font-medium flex items-center justify-center gap-3 hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-500 transition duration-300 ease-in-out transform hover:scale-105">
            <i class="fa fa-chevron-right text-sm"></i> <!-- Right Arrow Icon for Next -->
        </button>
    </div>
</div>



        </div>
    </div>
</section>

<!-- Modal -->
<div id="sadakaModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-xl shadow-xl w-full max-w-lg p-6 relative">
        <button onclick="document.getElementById('sadakaModal').classList.add('hidden')" class="absolute top-2 right-2 text-gray-600 hover:text-red-500 text-xl font-bold">&times;</button>
        <h2 class="text-xl font-semibold mb-4">Submit sadaka</h2>

        <form method="POST" action="{{ route('sadaka.store') }}">
            @csrf

            <label class="block mb-1">Sadaka Type:</label>
            <select name="category" required class="w-full border p-2 mb-3 rounded">
                <option value="Tithe">Tithe</option>
                <option value="Thanksgiving">Thanksgiving</option>
                <option value="Building Fund">Building Fund</option>
                <option value="Special Project">Special Project</option>
                <option value="Love sadaka">Love sadaka</option>
                <option value="First Fruit">First Fruit</option>
                <option value="Pledge">Pledge</option>
            </select>

            <label class="block mb-1">Amount (TZS):</label>
            <input type="number" step="0.01" name="amount" required class="w-full border p-2 mb-3 rounded" placeholder="e.g., 50000">

            <label class="block mb-1">Note (optional):</label>
            <textarea name="note" class="w-full border p-2 mb-4 rounded" rows="3" placeholder="Add any note..."></textarea>

            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded">Submit sadaka</button>
        </form>
    </div>
</div>

@endsection