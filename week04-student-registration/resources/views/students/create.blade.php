@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto bg-zinc-900/90 backdrop-blur-md p-8 rounded-2xl shadow-2xl border border-zinc-800">
    <!-- Header -->
    <div class="mb-8 border-b border-zinc-800 pb-4">
        <span class="text-xs font-semibold text-blue-400 tracking-widest uppercase">Student Onboarding</span>
        <h2 class="text-3xl font-extrabold text-white tracking-tight mt-1">Registration Form</h2>
        <p class="text-sm text-zinc-400 mt-1">Fill in the official student details below to complete enrollment.</p>
    </div>

    <form action="{{ route('students.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <!-- Student ID & Email -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div>
                <label class="block text-xs font-semibold text-zinc-300 uppercase tracking-wider mb-2">Student ID</label>
                <input type="text" name="student_id" value="{{ old('student_id') }}" placeholder="e.g. 2026-00123" class="w-full bg-zinc-800/80 border border-zinc-700 rounded-lg px-4 py-2.5 text-zinc-100 placeholder-zinc-500 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition">
                @error('student_id') <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-xs font-semibold text-zinc-300 uppercase tracking-wider mb-2">Email Address</label>
                <input type="email" name="email" value="{{ old('email') }}" placeholder="student@campus.edu" class="w-full bg-zinc-800/80 border border-zinc-700 rounded-lg px-4 py-2.5 text-zinc-100 placeholder-zinc-500 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition">
                @error('email') <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
            </div>
        </div>

        <!-- Name Fields with Suffix Option -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label class="block text-xs font-semibold text-zinc-300 uppercase tracking-wider mb-2">First Name</label>
                <input type="text" name="first_name" value="{{ old('first_name') }}" oninput="this.value = this.value.toUpperCase()" class="w-full bg-zinc-800/80 border border-zinc-700 rounded-lg px-4 py-2.5 text-zinc-100 uppercase focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition">
                @error('first_name') <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-xs font-semibold text-zinc-300 uppercase tracking-wider mb-2">Middle Name</label>
                <input type="text" name="middle_name" value="{{ old('middle_name') }}" placeholder="e.g. Agojo" oninput="this.value = this.value.toUpperCase()" class="w-full bg-zinc-800/80 border border-zinc-700 rounded-lg px-4 py-2.5 text-zinc-100 uppercase focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition">
            </div>

            <div>
                <label class="block text-xs font-semibold text-zinc-300 uppercase tracking-wider mb-2">Last Name</label>
                <input type="text" name="last_name" value="{{ old('last_name') }}" oninput="this.value = this.value.toUpperCase()" class="w-full bg-zinc-800/80 border border-zinc-700 rounded-lg px-4 py-2.5 text-zinc-100 uppercase focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition">
                @error('last_name') <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-xs font-semibold text-zinc-300 uppercase tracking-wider mb-2">Suffix (Optional)</label>
                <select name="suffix" class="w-full bg-zinc-800/80 border border-zinc-700 rounded-lg px-4 py-2.5 text-zinc-100 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition">
                    <option value="" class="bg-zinc-900">None</option>
                    <option value="JR." {{ old('suffix') == 'JR.' ? 'selected' : '' }} class="bg-zinc-900">Jr.</option>
                    <option value="SR." {{ old('suffix') == 'SR.' ? 'selected' : '' }} class="bg-zinc-900">Sr.</option>
                    <option value="III" {{ old('suffix') == 'III' ? 'selected' : '' }} class="bg-zinc-900">III</option>
                    <option value="IV" {{ old('suffix') == 'IV' ? 'selected' : '' }} class="bg-zinc-900">IV</option>
                </select>
            </div>
        </div>

        <!-- Contact (Max 12 Digits), DOB, Gender -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
            <div>
                <label class="block text-xs font-semibold text-zinc-300 uppercase tracking-wider mb-2">Mobile Number (Max 12 Digits)</label>
                <input type="text" name="mobile_number" maxlength="12" value="{{ old('mobile_number') }}" placeholder="09123456789" oninput="this.value = this.value.replace(/[^0-9]/g, '')" class="w-full bg-zinc-800/80 border border-zinc-700 rounded-lg px-4 py-2.5 text-zinc-100 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition">
                @error('mobile_number') <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-xs font-semibold text-zinc-300 uppercase tracking-wider mb-2">Date of Birth</label>
                <input type="date" name="date_of_birth" value="{{ old('date_of_birth') }}" class="w-full bg-zinc-800/80 border border-zinc-700 rounded-lg px-4 py-2.5 text-zinc-100 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition [color-scheme:dark]">
                @error('date_of_birth') <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-xs font-semibold text-zinc-300 uppercase tracking-wider mb-2">Gender</label>
                <select name="gender" class="w-full bg-zinc-800/80 border border-zinc-700 rounded-lg px-4 py-2.5 text-zinc-100 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition">
                    <option value="" class="bg-zinc-900">Select Gender</option>
                    <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }} class="bg-zinc-900">Male</option>
                    <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }} class="bg-zinc-900">Female</option>
                </select>
                @error('gender') <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
            </div>
        </div>

        <!-- Program & Year Level -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div>
                <label class="block text-xs font-semibold text-zinc-300 uppercase tracking-wider mb-2">Academic Program</label>
                <input type="text" name="program" placeholder="e.g., BS Information Technology" value="{{ old('program') }}" class="w-full bg-zinc-800/80 border border-zinc-700 rounded-lg px-4 py-2.5 text-zinc-100 placeholder-zinc-500 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition">
                @error('program') <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-xs font-semibold text-zinc-300 uppercase tracking-wider mb-2">Year Level</label>
                <select name="year_level" class="w-full bg-zinc-800/80 border border-zinc-700 rounded-lg px-4 py-2.5 text-zinc-100 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition">
                    <option value="" class="bg-zinc-900">Select Year Level</option>
                    <option value="1st Year" {{ old('year_level') == '1st Year' ? 'selected' : '' }} class="bg-zinc-900">1st Year</option>
                    <option value="2nd Year" {{ old('year_level') == '2nd Year' ? 'selected' : '' }} class="bg-zinc-900">2nd Year</option>
                    <option value="3rd Year" {{ old('year_level') == '3rd Year' ? 'selected' : '' }} class="bg-zinc-900">3rd Year</option>
                    <option value="4th Year" {{ old('year_level') == '4th Year' ? 'selected' : '' }} class="bg-zinc-900">4th Year</option>
                </select>
                @error('year_level') <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
            </div>
        </div>

        <!-- Address -->
        <div>
            <label class="block text-xs font-semibold text-zinc-300 uppercase tracking-wider mb-2">Address</label>
            <textarea name="address" rows="3" placeholder="Enter complete home address" class="w-full bg-zinc-800/80 border border-zinc-700 rounded-lg px-4 py-2.5 text-zinc-100 placeholder-zinc-500 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition">{{ old('address') }}</textarea>
            @error('address') <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
        </div>

        <!-- Profile Picture Upload -->
        <div>
            <label class="block text-xs font-semibold text-zinc-300 uppercase tracking-wider mb-2">Profile Picture Upload</label>
            <input type="file" name="profile_picture" accept="image/*" class="w-full text-xs text-zinc-400 file:mr-4 file:py-2.5 file:px-4 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-blue-600/20 file:text-blue-400 hover:file:bg-blue-600 hover:file:text-white file:transition border border-zinc-700 rounded-lg bg-zinc-800/50 cursor-pointer">
            @error('profile_picture') <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
        </div>

        <!-- Submit Button -->
        <div class="pt-4">
            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg shadow-lg shadow-blue-600/20 tracking-wider uppercase text-sm transition-all duration-200">
                Register Student Record
            </button>
        </div>
    </form>
</div>
@endsection