

<?php

use App\Http\Controllers\DownloadController;
use App\Http\Controllers\FileDownloaderController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Models\Department;
use App\Models\Student;
use App\Models\Subject;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('students');
});

Route::get('/download', [DownloadController::class, 'downloadCsv'])->name('download');
Route::get('/file_download/{file_name}', [FileDownloaderController::class, 'downloadFile'])->name('file_download');

Route::get('/subjects/{department}', [SubjectController::class, 'allSubjects']);

Route::resource('students', StudentController::class);

// Route::get('/file_download/{file_name}', [FileDownloaderController::class, 'downloadFile']);
// http://localhost:8000/file_download/1680507547student.csv
