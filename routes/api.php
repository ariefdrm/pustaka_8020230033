<?php

use App\Http\Controllers\BooksController;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\StudentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


// Route API backend untuk handling data dengan database
Route::resource('students', StudentController::class);
Route::resource('books', BooksController::class);
Route::resource('persons', PersonController::class);
