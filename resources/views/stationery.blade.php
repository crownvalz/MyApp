@extends('layouts.app')
@section('content')
<div class="max-w-full mx-auto p-6 bg-white rounded-lg shadow-lg overflow-x-auto font-medium text-[17px]">
    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row justify-between items-center gap-4 mb-6">
        <h2 class="text-2xl font-semibold text-gray-800">Stationery Requests</h2>
    </div>

    <!-- Alert Message -->
    @if(session('success') || session('error'))
        <div id="alertMessage" class="p-3 mb-4 rounded {{ session('success') ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
            {{ session('success') ?? session('error') }}
        </div>
    @endif

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

            <button data-modal-id="Modal2" class="open-modal bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md text-sm font-medium flex items-center gap-2">
                <i class="fa fa-plus"></i>
                <span class="hidden sm:inline">New Request</span>
            </button>

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

<!-- Modal -->
<div id="createRequestModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 backdrop-blur-md hidden">
    <div class="bg-white rounded-lg shadow-lg p-6 max-w-lg w-full">
        <h2 class="text-2xl font-semibold mb-4">Create New Stock Request</h2>
        <form action="{{ route('requests.store') }}" method="POST">
            @csrf
            <div class="space-y-4">
                <select id="item_name" name="item_name" class="mt-1 p-2 w-full border border-gray-300 rounded" required>
                    <option value="" disabled selected>Select an item</option>
                    @if(is_null($stockTable) || $stockTable->isEmpty())
                        <option value="Pen">Pen</option>
                        <option value="Stapler">Stapler</option>
                        <option value="Notebook">Notebook</option>
                    @else
                        @foreach($stockTable->unique('item_name') as $item)
                            @if($item->status !== 'Out of Stock')
                                <option value="{{ $item->item_name }}">{{ $item->item_name }}</option>
                            @endif
                        @endforeach
                    @endif
                </select>

                <label for="quantity" class="block text-sm font-medium text-gray-700">Quantity</label>
                <input type="number" id="quantity" name="quantity" class="mt-1 p-2 w-full border border-gray-300 rounded" required>

                <!-- Hidden input to store the applicant's name -->
                <input type="hidden" name="requested_by" value="{{ Auth::user()->name }}">
            </div>

            <div class="mt-4 flex justify-between">
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Submit Request</button>
                <button type="button" id="closeModalBtn" class="px-4 py-2 bg-gray-300 text-black rounded">Cancel</button>
            </div>
        </form>
    </div>
</div>
@include('layouts.modals')
@endsection
