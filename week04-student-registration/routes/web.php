<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;

// Registration Form
Route::get('/', [StudentController::class, 'create'])->name('students.create');

// Save Registration
Route::post('/students', [StudentController::class, 'store'])->name('students.store');

// View Student Profile
Route::get('/students/{student}', [StudentController::class, 'show'])->name('students.show');