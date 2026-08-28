@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">
    <!-- Success Flash Notification -->
    @if(session('success'))
        <div class="p-4 bg-emerald-950/60 border border-emerald-500/40 text-emerald-300 rounded-xl flex items-center space-x-3 shadow-lg">
            <svg class="w-6 h-6 text-emerald-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
            <span class="font-medium text-sm">{{ session('success') }}</span>
        </div>
    @endif

    <!-- Main Profile Card -->
    <div class="bg-zinc-900/90 backdrop-blur-md p-8 rounded-2xl shadow-2xl border border-zinc-800">
        <!-- Profile Banner / Header -->
        <div class="flex flex-col md:flex-row items-center md:items-start space-y-4 md:space-y-0 md:space-x-6 pb-6 border-b border-zinc-800">
            <img src="{{ asset('storage/' . $student->profile_picture) }}" alt="Profile Picture" class="w-32 h-32 rounded-full object-cover border-4 border-blue-500 shadow-xl shadow-blue-500/10">
            <div class="text-center md:text-left space-y-1">
                <span class="text-xs font-extrabold tracking-widest text-blue-400 uppercase">Campus Profile</span>
                <h1 class="text-3xl font-extrabold text-white">
                    {{ $student->first_name }} {{ $student->middle_name }} {{ $student->last_name }} {{ $student->suffix }}
                </h1>
                <p class="text-zinc-300 font-semibold text-sm">{{ $student->program }} &bull; <span class="text-blue-400">{{ $student->year_level }}</span></p>
                <p class="text-zinc-500 text-xs tracking-wider">STUDENT ID: {{ $student->student_id }}</p>
            </div>
        </div>

        <!-- Information Grid -->
        <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-6 text-sm">
            <div class="bg-zinc-800/40 p-4 rounded-xl border border-zinc-800">
                <span class="text-xs font-semibold text-zinc-500 uppercase block mb-1">Email Address</span>
                <span class="text-zinc-200 font-medium">{{ $student->email }}</span>
            </div>

            <div class="bg-zinc-800/40 p-4 rounded-xl border border-zinc-800">
                <span class="text-xs font-semibold text-zinc-500 uppercase block mb-1">Mobile Number</span>
                <span class="text-zinc-200 font-medium">{{ $student->mobile_number }}</span>
            </div>

            <div class="bg-zinc-800/40 p-4 rounded-xl border border-zinc-800">
                <span class="text-xs font-semibold text-zinc-500 uppercase block mb-1">Date of Birth</span>
                <span class="text-zinc-200 font-medium">{{ $student->date_of_birth }}</span>
            </div>

            <div class="bg-zinc-800/40 p-4 rounded-xl border border-zinc-800">
                <span class="text-xs font-semibold text-zinc-500 uppercase block mb-1">Gender</span>
                <span class="text-zinc-200 font-medium">{{ $student->gender }}</span>
            </div>

            <div class="bg-zinc-800/40 p-4 rounded-xl border border-zinc-800 md:col-span-2">
                <span class="text-xs font-semibold text-zinc-500 uppercase block mb-1">Residential Address</span>
                <span class="text-zinc-200 font-medium">{{ $student->address }}</span>
            </div>
        </div>

        <!-- Action Button -->
        <div class="mt-8 pt-6 border-t border-zinc-800 flex justify-end">
            <a href="{{ route('students.create') }}" class="bg-zinc-800 hover:bg-zinc-700 text-zinc-200 font-semibold text-xs tracking-wider uppercase py-3 px-6 rounded-lg transition-all border border-zinc-700">
                + Register Another Student
            </a>
        </div>
    </div>
</div>
@endsection