<?php

namespace App\Exports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class StudentExport implements ShouldAutoSize, WithMapping, WithHeadings, FromQuery
{
    /**
     * @return \Illuminate\Support\Collection
     */
  

    public function map($student): array
    {
        return [
            $student->id,
            $student->first_name,
            $student->last_name,
            $student->age,
            $student->department->name,
            $student->subjects->pluck('name')->implode(', ')
        ];
    }
    public function query()
    {
        return Student::query()->with(['subjects', 'department']);
    }

    public function headings(): array
    {
        return [
            'Student_id',
            'First Name',
            'Last_Name',
            'Age',
            'Department',
            'subjects'
        ];
    }
}