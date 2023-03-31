<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\StudentExport;
use Maatwebsite\Excel\Facades\Excel;

class DownloadController extends Controller
{
    function downloadCsv(){

    //    $file = Excel::store(new StudentExport,'/students.csv');

       (new StudentExport)->queue('student.csv');

       return back()->with('info', 'exporting has started...');




    }
}
