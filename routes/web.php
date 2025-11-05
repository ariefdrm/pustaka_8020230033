<?php

use App\Http\Controllers\StudentController;
use App\Http\Controllers\TestController;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome')->middleware(function (Middleware $middleware) {
        $middleware->validateCsrfTokens(except: ['api/*']);
    });
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get("student", function () {
    return Inertia::render("Student");
})->middleware(['auth', 'verified'])->name('student');

Route::get('/student/add', function () {
    return Inertia::render('AddStudent');
})->middleware(['auth', 'verified'])->name('student.add');

// Route::get('/student/{id}/edit', function ($id) {
//     $student = Student::query()->findOrFail($id); // find the student by id via request parameters
//
//     // sending data to the view and render edit page "EditStudent.vue"
//     return Inertia::render('EditStudent', [
//         'data' => $student
//     ]);
// })->middleware(['auth', 'verified'])->name('student.update');

Route::resource('api/student', StudentController::class);
// Route::patch('api/student/{id}', [StudentController::class, "update"])->middleware(['auth', 'verified'])->name('student.update');
Route::get('api/students', [StudentController::class, "show"]);

Route::resource('page2', TestController::class);

require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';
