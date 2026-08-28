@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto space-y-6">
    <!-- Header & Action Bar -->
    <div class="bg-zinc-900/90 backdrop-blur-md p-6 rounded-2xl shadow-2xl border border-zinc-800 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <span class="text-xs font-semibold text-blue-400 tracking-widest uppercase">Database Directory</span>
            <h1 class="text-3xl font-extrabold text-white tracking-tight mt-0.5">Registered Students</h1>
            <p class="text-xs text-zinc-400 mt-1">Total Records: <span class="text-zinc-200 font-bold">{{ $students->total() }}</span></p>
        </div>

        <div class="flex items-center gap-3">
            <!-- Search Input -->
            <form action="{{ route('students.index') }}" method="GET" class="flex gap-2">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search ID, Name, or Program..." class="bg-zinc-800 border border-zinc-700 rounded-lg px-4 py-2 text-xs text-zinc-100 placeholder-zinc-500 focus:outline-none focus:border-blue-500 w-48 md:w-64">
                <button type="submit" class="bg-zinc-800 hover:bg-zinc-700 text-zinc-200 text-xs font-semibold px-4 py-2 rounded-lg border border-zinc-700 transition">
                    Search
                </button>
            </form>

            <a href="{{ route('students.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold text-xs tracking-wider uppercase py-2.5 px-4 rounded-lg shadow-lg shadow-blue-600/20 transition whitespace-nowrap">
                + New Registration
            </a>
        </div>
    </div>

    <!-- Students Directory Table -->
    <div class="bg-zinc-900/90 backdrop-blur-md rounded-2xl shadow-2xl border border-zinc-800 overflow-hidden">
        @if($students->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-zinc-800/60 border-b border-zinc-800 text-[11px] font-bold text-zinc-400 uppercase tracking-wider">
                            <th class="py-4 px-6">Student</th>
                            <th class="py-4 px-6">Student ID</th>
                            <th class="py-4 px-6">Program & Year</th>
                            <th class="py-4 px-6">Contact Info</th>
                            <th class="py-4 px-6 text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-800/60 text-sm">
                        @foreach($students as $student)
                            <tr class="hover:bg-zinc-800/30 transition">
                                <!-- Avatar & Full Name -->
                                <td class="py-4 px-6 flex items-center space-x-3">
                                    <img src="{{ asset('storage/' . $student->profile_picture) }}" alt="Avatar" class="w-10 h-10 rounded-full object-cover border-2 border-zinc-700">
                                    <div>
                                        <div class="font-bold text-zinc-100">
                                            {{ $student->first_name }} {{ $student->middle_name }} {{ $student->last_name }} {{ $student->suffix }}
                                        </div>
                                        <div class="text-xs text-zinc-500">{{ $student->gender }} &bull; {{ $student->date_of_birth }}</div>
                                    </div>
                                </td>

                                <!-- Student ID -->
                                <td class="py-4 px-6 text-zinc-300 font-mono text-xs font-semibold">
                                    {{ $student->student_id }}
                                </td>

                                <!-- Program & Year -->
                                <td class="py-4 px-6">
                                    <div class="text-zinc-200 font-medium text-xs">{{ $student->program }}</div>
                                    <span class="inline-block mt-0.5 text-[10px] font-semibold text-blue-400 bg-blue-500/10 px-2 py-0.5 rounded border border-blue-500/20">
                                        {{ $student->year_level }}
                                    </span>
                                </td>

                                <!-- Contact Info -->
                                <td class="py-4 px-6 text-xs">
                                    <div class="text-zinc-300">{{ $student->email }}</div>
                                    <div class="text-zinc-500">{{ $student->mobile_number }}</div>
                                </td>

                                <!-- Action -->
                                <td class="py-4 px-6 text-right">
                                    <a href="{{ route('students.show', $student->id) }}" class="inline-flex items-center text-xs font-semibold text-blue-400 hover:text-blue-300 bg-blue-500/10 hover:bg-blue-500/20 px-3 py-1.5 rounded-md border border-blue-500/20 transition">
                                        View Profile &rarr;
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="p-4 border-t border-zinc-800">
                {{ $students->links() }}
            </div>
        @else
            <div class="p-12 text-center space-y-3">
                <div class="text-zinc-500 text-sm">No student records found.</div>
                <a href="{{ route('students.create') }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-bold text-xs uppercase py-2 px-4 rounded-lg transition">
                    Register First Student
                </a>
            </div>
        @endif
    </div>
</div>
@endsection