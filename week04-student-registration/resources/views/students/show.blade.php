@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-8 rounded-lg shadow-md border border-gray-200">
    @if(session('success'))
        <div class="mb-6 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="flex items-center space-x-6 pb-6 border-b">
        <img src="{{ asset('storage/' . $student->profile_picture) }}" alt="Profile Picture" class="w-32 h-32 rounded-full object-cover border-4 border-blue-600 shadow">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">{{ $student->first_name }} {{ $student->middle_name }} {{ $student->last_name }}</h1>
            <p class="text-blue-600 font-semibold">{{ $student->program }} - {{ $student->year_level }}</p>
            <p class="text-gray-500 text-sm">ID: {{ $student->student_id }}</p>
        </div>
    </div>

    <div class="mt-6 grid grid-cols-2 gap-4 text-sm">
        <div><strong>Email:</strong> {{ $student->email }}</div>
        <div><strong>Mobile:</strong> {{ $student->mobile_number }}</div>
        <div><strong>Date of Birth:</strong> {{ $student->date_of_birth }}</div>
        <div><strong>Gender:</strong> {{ $student->gender }}</div>
        <div class="col-span-2"><strong>Address:</strong> {{ $student->address }}</div>
    </div>

    <div class="mt-8">
        <a href="{{ route('students.create') }}" class="inline-block bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded-md">
            Register Another Student
        </a>
    </div>
</div>
@endsection