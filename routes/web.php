<?php

use App\Http\Controllers\BooksController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TestController;
use App\Models\Books;
use App\Models\Person;
use App\Models\Student;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

/*
 * Route (Student)
 * Menampilkan halaman student, menggunakan inertia untuk me-render vue component
*/
Route::get("student", function () {
    return Inertia::render("Student");
})->middleware(['auth', 'verified'])->name('student');

Route::get('/student/add', function () {
    return Inertia::render('AddStudent');
})->middleware(['auth', 'verified'])->name('student.add');

Route::get('/student/edit/{id}', function ($id) {
    $student = Student::query()->findOrFail($id); // find the student by id via request parameters

    return Inertia('EditStudent', ['data' => $student]);
});

/*
 * Route (Books)
*/
Route::get('books', function () {
    return Inertia::render('Books');
})->middleware(['auth', 'verified'])->name('books');

Route::get('books/add', function () {
    return Inertia::render('AddBooks');
})->middleware(['auth', 'verified'])->name('books.add');

Route::get('books/edit/{id}', function ($id) {
    $books = Books::query()->findOrFail($id);

    return Inertia('EditBooks', ['data' => $books]);
});

/*
 *  Route (Person)
 */
Route::get('person', function () {
    return Inertia::render('Person');
})->middleware(['auth', 'verified'])->name('person');
Route::get('person/add', function () {
    return Inertia::render('AddPerson');
})->middleware(['auth', 'verified'])->name('person.add');

Route::get('person/edit/{id}', function ($id) {
    $person = Person::query()->findOrFail($id);

    return Inertia('EditPerson', ['data' => $person]);
});

// Route API backend untuk handling data dengan database
Route::resource('api/students', StudentController::class);
Route::resource('api/books', BooksController::class);
Route::resource('api/persons', PersonController::class);


Route::resource('page2', TestController::class);
Route::resource('page3', Controller::class);

require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';
