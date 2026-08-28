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
            'suffix'         => 'nullable|string|max:10',
            'email'          => 'required|email|unique:students,email',
            'mobile_number'  => 'required|numeric|digits_between:1,12',
            'date_of_birth'  => 'required|date',
            'gender'         => 'required',
            'program'        => 'required',
            'year_level'     => 'required',
            'address'        => 'required|string',
            'profile_picture'=> 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Convert Names to Uppercase
        $validated['first_name'] = strtoupper($validated['first_name']);
        $validated['last_name']  = strtoupper($validated['last_name']);
        
        if (!empty($validated['suffix'])) {
            $validated['suffix'] = strtoupper($validated['suffix']);
        }

        // Format Middle Name: e.g., "Agojo" becomes "A. (AGOJO)"
        if (!empty($validated['middle_name'])) {
            $cleanMiddle = trim($validated['middle_name']);
            $initial = strtoupper(substr($cleanMiddle, 0, 1));
            $fullUpper = strtoupper($cleanMiddle);

            // Format as initial if short input, otherwise create "A. (AGOJO)" format
            if (strlen(str_replace('.', '', $cleanMiddle)) <= 1) {
                $validated['middle_name'] = $initial . '.';
            } else {
                $validated['middle_name'] = "{$initial}. ({$fullUpper})";
            }
        }

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