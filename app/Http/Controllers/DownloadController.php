<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\StudentExport;
use Maatwebsite\Excel\Facades\Excel;

class DownloadController extends Controller
{
    function downloadCsv(){

    //    $file = Excel::store(new StudentExport,'/students.csv');

       (new StudentExport)->store(time().'student.csv');
    //    (new StudentExport)->queue(time().'student.csv');


       return back()->with('info', 'Exporting started. An email will be sent with download link');

    }
}
