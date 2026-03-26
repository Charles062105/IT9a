<?php

// namespace App\Http\Controllers;

// use Illuminate\Http\Request;

// class StudentController extends Controller
// {
    // public function index()
    // {
    //     return "Student Controller Works!";
    // }
//     public function show($id)
//     {
//         return "Showing Student #" . $id;
//     }
//     public function create()
//     {
//         return view ('students.create');
//     }

// } -->

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $students = session('students', $this->getDefaultStudents());
        return view('students.index', compact('students'));
    }

    public function adminIndex()
    {
        $students = session('students', $this->getDefaultStudents());
        return view('admin.students', compact('students'));
    }

    public function create()
    {
        return view('admin.create');
    }

    public function store(Request $request)
    {
        $students = session('students', []);
        $students[] = [
            'id' => count($students) + 1,
            'name' => $request->name,
            'course' => $request->course
        ];
        session(['students' => $students]);

        return redirect()->route('admin.students.index')->with('success', 'Student created!');
    }

    public function destroy($id)
    {
        $students = session('students', []);
        $students = array_filter($students, fn($student) => $student['id'] != $id);
        session(['students' => array_values($students)]);

        return redirect()->route('admin.students.index')->with('success', "Student #$id deleted!");
    }

    private function getDefaultStudents()
    {
        return [
            ['id' => 1, 'name' => 'Maria Santos', 'course' => 'BS Computer Science'],
        ];
    }
}
