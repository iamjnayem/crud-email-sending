<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        /*
        "_token" => "IgonWU459Ki5WUSqNU85AGAa2dbDpfV5lvZjUms7"
        "f_name" => "kjkfjkdkfj"
        "l_name" => "klkflkgl"
        "age" => "dfldkfdkl"
        "departments" => "1"
        "subject" => array:2 [▼
        0 => "2"
        1 => "3"
        */
        //need validation

        // dd($request->input('subject'));
        $student = Student::create(
            [
                'first_name' => $request->input('f_name'),
                'last_name' => $request->input('l_name'),
                'age' => $request->input('age'),
                'department_id' => $request->input('departments')
            ]
        );

       $student->subjects()->sync($request->input('subject'));
       return redirect()->route('students.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        //
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
        //
    }
}