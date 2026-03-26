<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/student/dashboard');
});


// Home Dashboard
Route::get('/student/dashboard', function () {
    return view('student.dashboard', [
    'name' => 'Charles Quimado',
        'course' => 'BS Information Technology',
        'studentId' => '556210',
        'isEnrolled' => true,
        'isActive' => true,
        'subjects' => [
            ['name' => 'Advanced Programming', 'grade' => 78],
            ['name' => 'Database Systems', 'grade' => 78],
            ['name' => 'Computer Networks', 'grade' => 78],
            ['name' => 'Web Development', 'grade' => 78],
            ['name' => 'Software Engineering', 'grade' => 78]
        ]
    ]);
});

// Grades Page
Route::get('/student/grades', function () {
    $grades = [
        ['subject' => 'Advanced Programming', 'grade' => 78, 'status' => 'Passed'],
        ['subject' => 'Database Systems', 'grade' => 78, 'status' => 'Passed'],
        ['subject' => 'Computer Networks', 'grade' => 78, 'status' => 'Passed'],
        ['subject' => 'Web Development', 'grade' => 78, 'status' => 'Passed'],
        ['subject' => 'Software Engineering', 'grade' => 78, 'status' => 'Passed']
    ];
    
    $gpa = array_sum(array_column($grades, 'grade')) / count($grades);
    
    return view('student.grades', [
        'name' => 'Charles Quimado',
        'grades' => $grades,
        'gpa' => round($gpa, 2)
    ]);
});

// Profile Page
Route::get('/student/profile', function () {
    return view('student.profile', [
        'name' => 'Charles Quimado',
        'email' => 'c.quimado.556210@umidanao.edu.ph',
        'phone' => '+63 912 345 6789',
        'address' => 'Phase 1 S.I.R Bucana, DC',
        'enrollmentDate' => 'June 2025'
    ]);
});

// Subjects Page
Route::get('/student/subjects', function () {
    return view('student.subjects', [
        'subjects' => [
            ['code' => 'CCE101', 'name' => 'Advanced Programming', 'units' => 3, 'schedule' => 'MWF 9:00 AM'],
            ['code' => 'CCE102', 'name' => 'Database Systems', 'units' => 3, 'schedule' => 'TTh 1:00 PM'],
            ['code' => 'CCE103', 'name' => 'Computer Networks', 'units' => 3, 'schedule' => 'MWF 2:00 PM']
        ]
    ]);
});

// Settings Page
Route::get('/student/settings', function () {
    return view('student.settings', [
        'theme' => 'light',
        'notifications' => true,
        'language' => 'English'
    ]);
});