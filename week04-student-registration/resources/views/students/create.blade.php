@extends('layouts.app')

@content
@section('content')
<div class="max-w-3xl mx-auto bg-white p-8 rounded-lg shadow-md border border-gray-200">
    <h2 class="text-2xl font-bold mb-6 text-gray-800 border-b pb-2">Student Registration Form</h2>

    <form action="{{ route('students.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Student ID</label>
                <input type="text" name="student_id" value="{{ old('student_id') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm border p-2 focus:ring-blue-500 focus:border-blue-500">
                @error('student_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Email Address</label>
                <input type="email" name="email" value="{{ old('email') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm border p-2 focus:ring-blue-500 focus:border-blue-500">
                @error('email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">First Name</label>
                <input type="text" name="first_name" value="{{ old('first_name') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm border p-2">
                @error('first_name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Middle Name</label>
                <input type="text" name="middle_name" value="{{ old('middle_name') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm border p-2">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Last Name</label>
                <input type="text" name="last_name" value="{{ old('last_name') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm border p-2">
                @error('last_name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Mobile Number</label>
                <input type="text" name="mobile_number" value="{{ old('mobile_number') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm border p-2">
                @error('mobile_number') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Date of Birth</label>
                <input type="date" name="date_of_birth" value="{{ old('date_of_birth') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm border p-2">
                @error('date_of_birth') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Gender</label>
                <select name="gender" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm border p-2 bg-white">
                    <option value="">Select Gender</option>
                    <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                    <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                </select>
                @error('gender') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Program</label>
                <input type="text" name="program" placeholder="e.g., BSIT" value="{{ old('program') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm border p-2">
                @error('program') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Year Level</label>
                <select name="year_level" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm border p-2 bg-white">
                    <option value="">Select Year Level</option>
                    <option value="1st Year" {{ old('year_level') == '1st Year' ? 'selected' : '' }}>1st Year</option>
                    <option value="2nd Year" {{ old('year_level') == '2nd Year' ? 'selected' : '' }}>2nd Year</option>
                    <option value="3rd Year" {{ old('year_level') == '3rd Year' ? 'selected' : '' }}>3rd Year</option>
                    <option value="4th Year" {{ old('year_level') == '4th Year' ? 'selected' : '' }}>4th Year</option>
                </select>
                @error('year_level') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Address</label>
            <textarea name="address" rows="2" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm border p-2">{{ old('address') }}</textarea>
            @error('address') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Profile Picture</label>
            <input type="file" name="profile_picture" accept="image/*" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 border p-2">
            @error('profile_picture') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <div>
            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-md shadow focus:outline-none focus:ring-2 focus:ring-blue-500">
                Register Student
            </button>
        </div>
    </form>
</div>
@endsection