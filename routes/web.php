<?php

use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get("student", function () {
    return Inertia::render("Student");
})->middleware(['auth', 'verified'])->name('student');

route::resource('api/student', StudentController::class);
Route::get('api/students', [StudentController::class, "show"])->middleware(['auth', 'verified'])->name('students');
// Route::get('api/students', StudentController::class);

require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';
