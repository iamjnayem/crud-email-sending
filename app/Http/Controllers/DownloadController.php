<?php

namespace App\Http\Controllers;

use Exception;
use App\Jobs\SendEmail;
use App\Exports\StudentExport;
use App\Mail\EmailForQueuing;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;

class DownloadController extends Controller
{
    public function downloadCsv()
    {




        try{
            $csv_file_name = time().'student.csv';
            DB::table('files')->insert([
                'path' => $csv_file_name //this path should be absolute path but i am storing just the file name
            ]
            );

            (new StudentExport)->queue($csv_file_name)->chain(
                [new SendEmail(
                    ['email' => 'nayem@deshipay.com'],
                    $csv_file_name
                )]
            );
        }catch(Exception $e){
            Log::error($e->getMessage());
        }



        return back()->with('info', 'Exporting started. An email will be sent with download link');

    }
}
