<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentPostRequest;
use App\Http\Requests\StudentPutRequest;
use App\Models\Department;
use App\Models\Student;
use App\Models\Subject;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class StudentController extends Controller
{
    public function index()
    {
        try {
            $students = Student::orderBy('id', 'desc')->paginate(20);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->withErrors('something went wrong');
        }

        return view('layout.table', compact('students'));
    }

    public function create()
    {
        try {
            $depts = Department::all();
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->withErrors('something went wrong');
        }

        return view('createStudent', compact('depts'));
    }

    public function store(StudentPostRequest $request)
    {

        $validated = $request->validated();
        try {
            DB::transaction(function () use ($request, $validated) {
                $student = Student::create(
                    [
                        'first_name' => $validated['f_name'],
                        'last_name' => $validated['l_name'],
                        'age' => $validated['age'],
                        'department_id' => $validated['department'],
                    ]
                );
                $student->subjects()->sync($validated['subjects']);
            });
            return redirect()->route('students.index')->with('success', 'student created successfully');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

    public function edit(Student $student)
    {
        try {
            $depts = Department::all();
            $subjects = Subject::where('department_id', $student->department->id)->get();
            return view('editStudent', compact('student', 'depts', 'subjects'));
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

    public function update(StudentPutRequest $request, Student $student)
    {
        $validated = $request->validated();
        try {
            DB::transaction(function () use ($request, $student, $validated) {
                Student::where('id', $validated['id'])->update(
                    [
                        'first_name' => $validated['f_name'],
                        'last_name' => $validated['l_name'],
                        'age' => $validated['age'],
                        'department_id' => $validated['department'],
                    ]
                );
                $student->subjects()->sync($validated['subjects']);
            });
            return redirect()->route('students.index')->with('info', 'student updated successfully');
        } catch (Exception $e) {
            Log::info($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

    public function destroy(Student $student)
    {
        try {
            DB::transaction(function () use ($student) {
                DB::table('student_subject')->where('student_id', $student->id)->delete();
                Student::where('id', $student->id)->delete();
            });
            return redirect()->route('students.index')->with('delete', 'student deleted successfully');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }
}
