




<!-- Main Contents -->
@extends('layouts.app')
@section('content')
<!-- Employee Profile Section -->
<section>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Employee Mini CV Card -->
        <div class="bg-white p-6 rounded-xl shadow-lg flex flex-col justify-between text-gray-800">
            <!-- Employee Profile -->
            <div class="flex flex-col items-center mb-6">
                <img src="{{ asset('img/Career.jpeg') }}" alt="Employee Photo" class="w-32 h-32 object-cover rounded-full border-4 border-gray-300 mb-4 shadow-lg">
                <h3 class="font-semibold text-2xl text-gray-800">{{ $user?->name ?? '' }}</h3>
                <p class="text-lg text-blue-700">{{ $user->position ?? ''}}</p>
            </div>
            <!-- Employee Details -->
            <div class="space-y-4 mb-6 text-gray-600">
                <div class="flex items-center space-x-2">
                    <i class="fa fa-envelope w-5 h-5 text-gray-800"></i>
                    <p>Email: <span class="font-medium text-gray-800">{{ $user->email ?? '' }}</span></p>
                </div>
                <div class="flex items-center space-x-2">
                    <i class="fa fa-building w-5 h-5 text-gray-800"></i>
                    <p>Department: <span class="font-medium text-gray-800">{{ $user->position ?? '' }}</span></p>
                </div>
                <div class="flex items-center space-x-2">
                    <i class="fa fa-calendar w-5 h-5 text-gray-800"></i>
                    <p>Joined: 
                        <span class="font-medium text-gray-800">
                        {{ $user->hire_date ?? '' }}
                        </span>
                    </p>
                </div>
            </div>
            <!-- Mini Cards (Recent Activities & Performance) -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-blue-50 p-4 rounded-lg shadow-md">
                    <h4 class="font-semibold text-gray-800 text-lg">Recent Activities</h4>
                    <div class="mt-2 text-gray-600 text-sm">
                        <p>Completed 5 tasks this week.</p>
                        <p>Attended 3 team meetings.</p>
                        <p>Participated in a coding workshop.</p>
                    </div>
                </div>
                <div class="bg-blue-50 p-4 rounded-lg shadow-md">
                    <h4 class="font-semibold text-gray-800 text-lg">Performance</h4>
                    <div class="mt-2 text-gray-600 text-sm">
                        <p>Tasks Completed: <span class="font-medium text-blue-600">120</span></p>
                        <p>Projects Delivered: <span class="font-medium text-blue-600">8</span></p>
                        <p>Code Contributions: <span class="font-medium text-blue-600">450+</span></p>
                    </div>
                </div>
            </div>
        <!-- Footer with Salary, Contact, and Previous Positions -->
            <div class="mt-6 space-y-6 text-gray-800">
                <!-- Previous Positions Section -->
                <div class="bg-white p-6 rounded-lg shadow-lg">
                <table class="min-w-full table-auto">
                    <thead class="mt-6 space-y-6 text-blue-800 bg-gray-100">
                        <tr class="mt-6 space-y-6 text-blue-500 bg-gray-100">
                            <th class="py-2 px-4 text-left text-gray-800 font-semibold">Position</th>
                            <th class="py-2 px-4 text-left text-gray-800 font-semibold">Company</th>
                            <th class="py-2 px-4 text-left text-gray-800 font-semibold">Duration</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($allstaff as $user)
                            <tr class="border-b">
                                <td class="py-2 px-4 text-gray-600">{{ $user->name }}</td>
                                <td class="py-2 px-4 text-gray-600">{{ $user->email }}</td>
                                <td class="py-2 px-4 text-gray-600">{{ $user->department }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
            </div>
        </div>
        <!-- Product Cards Section -->
        <div class="bg-white p-4 rounded-lg shadow-lg">
            <h4 class="font-semibold text-gray-800 text-lg">Recent Activities</h4>
            <div class="mt-2 text-gray-600 text-sm">
                <!-- Grid container -->
                <div class="grid grid-cols-2 gap-4">
                    <!-- Top Boxes (2 boxes) -->
                    <div class="bg-gray-200 p-4 rounded-lg">
                        <h5 class="font-semibold text-gray-800">Password Update</h5>
                    </div>
                    <div class="bg-gray-200 p-4 rounded-lg">
                        <h5 class="font-semibold text-gray-800">Profile Update</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection