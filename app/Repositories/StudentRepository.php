<?php

namespace App\Repositories;

use App\Models\Student;
use App\Models\Subject;
use App\Models\Department;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\StudentPutRequest;
use App\Http\Requests\StudentPostRequest;
use App\Interfaces\StudentRepositoryInterface;

class StudentRepository implements StudentRepositoryInterface
{
    public function index(){
        try {
            $students = Student::orderBy('id', 'desc')->paginate(20);
            return $students;
        } catch (Exception $e) {
            Log::error($e->getMessage());
        }
    }

    public function create(){
        try {
            $depts = Department::all();
            return $depts;
        } catch (Exception $e) {
            Log::error($e->getMessage());
        }
    }
    public function store(StudentPostRequest $request){
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

        } catch (Exception $e) {
            Log::error($e->getMessage());
        }

    }
    public function edit(Student $student){
        try {
            $depts = Department::all();
            $subjects = Subject::where('department_id',$student->department->id)->get();
            return [$depts, $subjects];
        } catch (Exception $e) {
            Log::error($e->getMessage());
        }

    }
    public function update(StudentPutRequest $request, Student $student){
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

        } catch (Exception $e) {
            Log::error($e->getMessage());

        }

    }
    public function destroy(Student $student){
        try {
            DB::transaction(function () use ($student) {
                DB::table('student_subject')->where('student_id', $student->id)->delete();
                Student::where('id', $student->id)->delete();
            });

        } catch (Exception $e) {
            Log::error($e->getMessage());

        }
    }
}
