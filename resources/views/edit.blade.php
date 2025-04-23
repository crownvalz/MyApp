@extends('layouts.app')

@section('content')
<div class="p-4">
    <div class="bg-white shadow-xl rounded-2xl p-6 space-y-10">
            <!-- Alert Message -->
    @if(session('success') || session('error'))
        <div id="alertMessage" class="p-3 mb-4 rounded {{ session('success') ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
            {{ session('success') ?? session('error') }}
        </div>
    @endif

        <form action="{{ route('profile.update', $user->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- Section: Personal Information --}}
            <div class="space-y-4">
            {{-- Profile Picture --}}
            <div class="flex items-center justify-between">
                <div class="relative group w-14 h-14 rounded-full overflow-hidden border shadow">
                    <img src="{{ asset('img/' . $user->profile_pic) }}" 
                        alt="Profile Picture" 
                        class="w-full h-full object-cover">

                    <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                        <label for="profile_pic" class="cursor-pointer text-white text-lg">
                            <i class="fas fa-pen"></i>
                        </label>
                    </div>
                </div>
                <input type="file" id="profile_pic" name="profile_pic" class="hidden mt-2">

                {{-- Submit --}}
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-10 py-2 rounded-full font-medium shadow">
                    Save Changes
                </button>
            </div>




                <h2 class="text-lg font-semibold border-b pt-4 text-indigo-700 italic">Personal Information</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-4">
                    <div>
                        <label class="text-sm font-medium">Full Name</label>
                        <input type="text" name="name" placeholder="John Doe" value="{{ $user->name }}" class="w-full p-2 rounded-lg border focus:ring focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="text-sm font-medium">Email</label>
                        <input type="email" name="email" placeholder="example@mail.com" value="{{ $user->email }}" class="w-full p-2 rounded-lg border focus:ring focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="text-sm font-medium">Phone</label>
                        <input type="text" name="phone" placeholder="07XXXXXXXX" value="{{ $user->phone }}" class="w-full p-2 rounded-lg border focus:ring focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="text-sm font-medium">Address</label>
                        <input type="text" name="address" placeholder="Street, City" value="{{ $user->address }}" class="w-full p-2 rounded-lg border focus:ring focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="text-sm font-medium">Birth Date</label>
                        <input type="date" name="birth_date" value="{{ $user->birth_date }}" class="w-full p-2 rounded-lg border focus:ring focus:ring-blue-500">
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-4">
                    <div>
                        <label class="text-sm font-medium">Gender</label>
                        <select name="gender" class="w-full p-2 rounded-lg border focus:ring focus:ring-blue-500">
                            <option value="male" @selected($user->gender == 'male')>Male</option>
                            <option value="female" @selected($user->gender == 'female')>Female</option>
                        </select>
                    </div>
                    <div>
                        <label class="text-sm font-medium">National ID</label>
                        <input type="text" name="national_id" placeholder="ID Number" value="{{ $user->national_id }}" class="w-full p-2 rounded-lg border focus:ring focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="text-sm font-medium">Department</label>
                        <input type="text" name="department" placeholder="HR, IT, etc." value="{{ $user->department }}" class="w-full p-2 rounded-lg border focus:ring focus:ring-blue-500">
                    </div>                    
                    <div>
                        <label class="text-sm font-medium">Branch</label>
                        <input type="text" name="branch" placeholder="Kisutu Branch" value="{{ $user->branch }}" class="w-full p-2 rounded-lg border focus:ring focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="text-sm font-medium">Role</label>
                        <input type="text" name="role" placeholder="Admin, Manager" value="{{ $user->role }}" class="w-full p-2 rounded-lg border focus:ring focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="text-sm font-medium">Position</label>
                        <select name="position" class="w-full p-2 rounded-lg border focus:ring focus:ring-blue-500">
                            @foreach(['Director', 'Manager',  'Supervisor', 'Coordinator', 'Consultant', 'Executive', 'Assistant'] as $position)
                                <option value="{{ $position }}" @selected($user->position == $position)>{{ $position }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="text-sm font-medium">Salary</label>
                        <input type="number" name="salary" placeholder="TZS" value="{{ $user->salary }}" class="w-full p-2 rounded-lg border focus:ring focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="text-sm font-medium">Leave Balance</label>
                        <input type="number" name="leave_bal" placeholder="Days" value="{{ $user->leave_bal }}" class="w-full p-2 rounded-lg border focus:ring focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="text-sm font-medium">Confirm Date</label>
                        <input type="date" name="confirm_date" value="{{ $user->confirm_date }}" class="w-full p-2 rounded-lg border focus:ring focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="text-sm font-medium">Employment Type</label>
                        <select name="employment_type" class="w-full p-2 rounded-lg border focus:ring focus:ring-blue-500">
                            <option value="full-time" @selected($user->employment_type == 'full-time')>Full-Time</option>
                            <option value="part-time" @selected($user->employment_type == 'part-time')>Part-Time</option>
                            <option value="contract" @selected($user->employment_type == 'contract')>Contract</option>
                        </select>
                    </div>
                </div>
            </div>

            {{-- Section: Other Details --}}
            <div class="space-y-4">
                <h2 class="text-lg font-semibold border-b pt-8 text-indigo-700 italic">Other Details</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-4">
                    <div>
                        <label class="text-sm font-medium">Emergency Contact</label>
                        <input type="text" name="emergency_contact" placeholder="Name & Phone" value="{{ $user->emergency_contact }}" class="w-full p-2 rounded-lg border focus:ring focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="text-sm font-medium">Bank Name</label>
                        <input type="text" name="bank_name" placeholder="Bank Name" value="{{ $user->bank_name }}" class="w-full p-2 rounded-lg border focus:ring focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="text-sm font-medium">Bank Account #</label>
                        <input type="text" name="bank_acc" placeholder="Account Number" value="{{ $user->bank_acc }}" class="w-full p-2 rounded-lg border focus:ring focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="text-sm font-medium">Marital Status</label>
                        <input type="text" name="marital_status" placeholder="Single/Married" value="{{ $user->marital_status }}" class="w-full p-2 rounded-lg border focus:ring focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="text-sm font-medium">Blood Type</label>
                        <select name="blood_type" class="w-full p-2 rounded-lg border focus:ring focus:ring-blue-500">
                            @foreach(['O+', 'O-', 'A+', 'A-', 'B+', 'B-', 'AB+', 'AB-'] as $type)
                                <option value="{{ $type }}" @selected($user->blood_type == $type)>{{ $type }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="text-sm font-medium">Disability</label>
                        <select name="disability_status" class="w-full p-2 rounded-lg border focus:ring focus:ring-blue-500">
                            @foreach(['None', 'Visual Impairment', 'Hearing Impairment', 'Physical Disability', 'Other'] as $disability)
                                <option value="{{ $disability }}" @selected($user->disability_status == $disability)>{{ $disability }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="text-sm font-medium">Resignation Date</label>
                        <input type="date" name="resign_date" value="{{ $user->resign_date }}" class="w-full p-2 rounded-lg border focus:ring focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="text-sm font-medium">Contract End</label>
                        <input type="date" name="contract_end" value="{{ $user->contract_end }}" class="w-full p-2 rounded-lg border focus:ring focus:ring-blue-500">
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection