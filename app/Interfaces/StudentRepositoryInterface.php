<?php

namespace App\Interfaces;

use App\Models\Student;
use App\Http\Requests\StudentPutRequest;
use App\Http\Requests\StudentPostRequest;

interface StudentRepositoryInterface{
    public function index();
    public function create();
    public function store(StudentPostRequest $request);
    public function edit(Student $student);
    public function update(StudentPutRequest $request, Student $student);
    public function destroy(Student $student);

}
