<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    // Display the registration form
    public function create()
    {
        return view('students.create');
    }

    // Process form submission & validation
    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id'     => 'required|unique:students,student_id',
            'first_name'     => 'required|string|max:100',
            'middle_name'    => 'nullable|string|max:100',
            'last_name'      => 'required|string|max:100',
            'email'          => 'required|email|unique:students,email',
            'mobile_number'  => 'required|numeric',
            'date_of_birth'  => 'required|date',
            'gender'         => 'required',
            'program'        => 'required',
            'year_level'     => 'required',
            'address'        => 'required|string',
            'profile_picture'=> 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Handle profile picture file upload
        if ($request->hasFile('profile_picture')) {
            $path = $request->file('profile_picture')->store('profile_pictures', 'public');
            $validated['profile_picture'] = $path;
        }

        // Save record to database
        $student = Student::create($validated);

        // Redirect to profile page with flash success message
        return redirect()->route('students.show', $student->id)
            ->with('success', 'Student registered successfully!');
    }

    // Display student profile
    public function show(Student $student)
    {
        return view('students.show', compact('student'));
    }
}