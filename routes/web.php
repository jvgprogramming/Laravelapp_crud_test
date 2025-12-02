<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;

Route::get('/', function () {
    return redirect()->route('students.index');
});

Route::resource('students', StudentController::class);
Route::resource('teachers', TeacherController::class);

// JSON endpoints for modals
Route::get('/students/{student}/json', [StudentController::class, 'getJson'])->name('students.json');
Route::get('/teachers/{teacher}/json', [TeacherController::class, 'getJson'])->name('teachers.json');

// Import endpoints
Route::post('/students/import', [StudentController::class, 'import'])->name('students.import');
Route::post('/teachers/import', [TeacherController::class, 'import'])->name('teachers.import');
