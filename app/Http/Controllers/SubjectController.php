<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;


class SubjectController extends Controller
{
    public function allSubjects(Request $request, $department){
        $subjects = Subject::where('department_id' , $department)->get();

        return ['subjects' => $subjects];
    }
}
