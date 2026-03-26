<?php

use Illuminate\Support\Facades\Route;

// // When someone visits the homepage "/"
// Route::get('/', function () {
//     return "Welcome to Student System";
// });

// // When someone visits "/students"
// Route::get('/students', function () {
//     return "List of Students";
// });

// Route::prefix('admin')->group(function () {
//     // All routes here will start with /admin
    
//     Route::get('/dashboard', function () {
//         return "Admin Dashboard";
//     });

//     Route::get('/students', function () {
//         return "Admin Student List";
//     });
// });

// Route::get('/students-view', function () {
//     return view('students');  // Looks for students.blade.php
// });

// use App\Http\Controllers\StudentController;

// // Points to the index() method
// Route::get('/students-controller', [StudentController::class, 'index']);

// // Points to the show() method
// Route::get('/students-controller/{id}', [StudentController::class, 'show']);

// Route::get('/student/{id}', function ($id) {
//     return "Student ID: " . $id;
// });


use App\Http\Controllers\StudentController;

Route::resource('students', StudentController::class)->only(['index']);
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/students', [StudentController::class, 'adminIndex'])->name('students.index');
    Route::delete('/students/{student}', [StudentController::class, 'destroy'])->name('students.destroy');
    Route::get('/students/create', [StudentController::class, 'create'])->name('students.create');
    Route::post('/students', [StudentController::class, 'store'])->name('students.store');
});