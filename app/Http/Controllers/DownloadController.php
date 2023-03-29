<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\StudentExport;
use Maatwebsite\Excel\Facades\Excel;

class DownloadController extends Controller
{
    function downloadCsv(){
        
        return Excel::download(new StudentExport, 'students.csv');
    }
}
