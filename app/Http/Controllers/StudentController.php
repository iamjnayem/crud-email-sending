<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Department;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\StudentPutRequest;
use App\Http\Requests\StudentPostRequest;
use App\Interfaces\StudentRepositoryInterface;

class StudentController extends Controller
{
    private StudentRepositoryInterface $studentRepository;

    public function __construct(StudentRepositoryInterface $studentRepository){
        $this->studentRepository = $studentRepository;
    }

    public function index()
    {

        try{
            $students = $this->studentRepository->index();
        }catch(Exception $e){
            return redirect()->back()->withErrors('something went wrong');
        }
        return view('layout.table', compact('students'));
    }

    public function create()
    {
        try{
            $depts = $this->studentRepository->create();
        }catch(Exception $e){
            return redirect()->back()->withErrors('something went wrong');
        }
        return view('createStudent', compact('depts'));

    }

    public function store(StudentPostRequest $request)
    {
       try{
            $this->studentRepository->store($request);
       }catch(Exception $e){
            return redirect()->back()->withErrors('something went wrong');
       }
       return redirect()->route('students.index')->with('success', 'student created successfully');

    }

    public function edit(Student $student)
    {
        try{
            list($depts, $subjects) = $this->studentRepository->edit($student);
        }catch(Exception $e){
            return redirect()->back()->withErrors('something went wrong');
        }
        return view('editStudent', compact('student', 'depts', 'subjects'));

    }

    public function update(StudentPutRequest $request, Student $student)
    {
        try{

            $this->studentRepository->update($request, $student);
        }catch(Exception $e){

            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

        return redirect()->route('students.index')->with('info', 'student updated successfully');

    }

    public function destroy(Student $student)
    {
        try{
            $this->studentRepository->destroy($student);
        }catch(Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);

        }
        return redirect()->route('students.index')->with('delete', 'student deleted successfully');
    }
}
