<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $students = Student::orderBy('id', 'desc')->paginate(20);

        return view('welcome', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $depts = Department::all();

        return view('createStudent', compact('depts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //need validation
        $student = Student::create(
            [
                'first_name' => $request->input('f_name'),
                'last_name' => $request->input('l_name'),
                'age' => $request->input('age'),
                'department_id' => $request->input('departments')
            ]
        );

       $student->subjects()->sync($request->input('subject'));
       return redirect()->route('students.index')->with('success', 'student created successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        //to show all department
        $depts = Department::all();

        $subjects = Subject::where('department_id', $student->department->id)->get();
        return view('editStudent', compact('student', 'depts', 'subjects'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        DB::table('student_subject')->where('student_id', $student->id)->delete();
        Student::where('id', $student->id)->delete();
        return redirect()->route('students.index')->with('delete', 'student deleted successfully');


    }
}
