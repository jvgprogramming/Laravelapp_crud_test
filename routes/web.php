<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\AuthController;

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Welcome page
Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('students.index');
    }
    return redirect()->route('login');
});

// Protected Routes - require authentication
Route::middleware('auth')->group(function () {
    Route::resource('students', StudentController::class);
    Route::resource('teachers', TeacherController::class);

    // JSON endpoints for modals
    Route::get('/students/{student}/json', [StudentController::class, 'getJson'])->name('students.json');
    Route::get('/teachers/{teacher}/json', [TeacherController::class, 'getJson'])->name('teachers.json');

    // Import endpoints
    Route::post('/students/import', [StudentController::class, 'import'])->name('students.import');
    Route::post('/teachers/import', [TeacherController::class, 'import'])->name('teachers.import');
});
