<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class FileDownloaderController extends Controller
{



    public function downloadFile(Request $request){

        // $callback = function() use($request) {
            // $file_name = DB::table('files')->where('path', $request->route('file_name'))->first();
            // $absolute_file_path = storage_path() . "/app/" . $file_name->path;
        // };

        $headers = [
            'Content-Type' => 'text/csv',
        ];

        // // return response()->streamDownload($callback, 'download.csv', $headers);
        // return response()->streamDownload($callback, 'download.csv', $headers);

        $file_name = DB::table('files')->where('path', $request->route('file_name'))->first();
        $absolute_file_path = storage_path() . "/app/" . $file_name->path;

        return response()->download($absolute_file_path, 'download.csv', $headers);


    }
}
