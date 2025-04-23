@extends('layouts.app')
@section('content')
<div class="p-6 space-y-6 bg-gray-50">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="bg-white rounded-lg p-4 shadow-md hover:shadow-lg transition duration-300 ease-in-out">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Total Employees on Leave</p>
                    <h2 class="text-2xl font-semibold text-indigo-600 mt-1">{{ $user->count() }}</h2>
                </div>
                <i class="fa fa-users text-indigo-400 text-3xl"></i>
            </div>
        </div>
        <div class="bg-white rounded-lg p-4 shadow-md hover:shadow-lg transition duration-300 ease-in-out">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Annual Leave Count</p>
                    <h2 class="text-2xl font-semibold text-indigo-600 mt-1">{{ $user->pluck('position')->unique()->count() }}</h2>
                </div>
                <i class="fa fa-calendar-check text-indigo-400 text-3xl"></i>
            </div>
        </div>
        <div class="bg-white rounded-lg p-4 shadow-md hover:shadow-lg transition duration-300 ease-in-out">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Employee on Leaves</p>
                    <h2 class="text-2xl font-semibold text-red-600 mt-1">{{ $leaveTable->count() }}</h2>
                </div>
                <i class="fa fa-bed text-red-400 text-3xl"></i>
            </div>
        </div>
        <div class="bg-white rounded-lg p-4 shadow-md hover:shadow-lg transition duration-300 ease-in-out">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Salary Sum</p>
                    <h2 class="text-2xl font-semibold text-green-600 mt-1">{{ number_format($user->sum('salary'), 2) }}</h2>
                </div>
                <i class="fa fa-dollar-sign text-green-400 text-3xl"></i>
            </div>
        </div>
    </div>
</div>

<div class="p-4 bg-gray-50">
    <h1 class="text-xl font-bold italic text-gray-800 mb-4">Stationery Purchase</h1>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">

    
</div>

<!-- Floating Cart Count -->
<div id="cart-count" class="fixed bottom-4 right-4 bg-indigo-500 text-white text-xs font-medium rounded-full px-3 py-1 shadow-lg hidden">
    <i class="fa fa-shopping-cart mr-1"></i> Items in Cart: <span id="cart-count-number">0</span>
</div>

@include('layouts.modals')
@endsection
