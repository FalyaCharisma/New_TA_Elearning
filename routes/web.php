<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AudioController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\MapelController;
use App\Http\Controllers\MateriController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\InformasiController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FotoController;
use App\Http\Controllers\DiskusiController;
use App\Http\Controllers\PenilaianController;
use App\Http\Controllers\SoalPenilaianController;
use App\Models\Exam;
use App\Models\Penilaian;

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
    return view('welcome');
});

Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function(){

    //dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    //permissions
    Route::resource('permissions', PermissionController::class)->only([
        'index'
    ]);

    //roles
    Route::resource('roles', RoleController::class)->except([
        'show'
    ]);

    //users
    Route::resource('users', UserController::class)->except([
        'show'
    ]);

    Route::get('users/siswa', [UserController::class, 'siswa'])->name('users.siswa');
    Route::get('users/tentor', [UserController::class, 'tentor'])->name('users.tentor');
    
    //images
    Route::resource('images', ImageController::class)->except([
        'show', 'create', 'edit', 'update'
    ]);

    //videos
    Route::resource('videos', VideoController::class)->except([
        'show', 'create', 'edit', 'update'
    ]);

    //audios
    Route::resource('audios', AudioController::class)->except([
        'show', 'create', 'edit', 'update'
    ]);

    //documents
    Route::resource('documents', DocumentController::class)->except([
        'show', 'create', 'edit', 'update'
    ]);

    //subjects
    Route::resource('subjects', SubjectController::class)->except([
        'show', 'create', 'edit', 'update'
    ]);

    //kelas
    Route::resource('kelas', KelasController::class)->except([
        'show', 'create', 'edit', 'update'
    ]);

     //mapel
     Route::resource('mapels', MapelController::class)->except([
        'show', 'create', 'edit', 'update'
    ]);

    //questions
    Route::resource('questions', QuestionController::class)->except([
        'show'
    ]);

    //materi
    Route::resource('materi', MateriController::class);
    Route::get('materi/showMateri/{id}', [MateriController::class, 'showMateri'])->name('materi.showMateri');

    //absens
    Route::resource('absensi', AbsensiController::class)->except([
        'show', 'create', 'edit', 'update'
    ]);

    //informasi
     Route::resource('informasi', InformasiController::class)->except([
        'show'
    ]);

    //Profile
    Route::resource('profile', ProfileController::class)->except([
        'show'
    ]);

    //Diskusi
    Route::resource('diskusi', DiskusiController::class)->except([
        'show'
    ]);
    Route::get('diskusi/showDiskusi/{id}', [DiskusiController::class, 'showDiskusi'])->name('diskusi.showDiskusi');
    Route::post('diskusi/respon/{id}', [DiskusiController::class, 'respon'])->name('diskusi.respon');

    Route::get('/absensi/export_excel', [AbsensiController::class, 'export_excel'])->name('absensi.export_excel');


    //exams 
    Route::resource('exams', ExamController::class); 
    Route::get('/exams/result/{score}/{user_id}/{exam_id}', [ExamController::class, 'result'])->name('exams.result');
    Route::get('/exams/start/{id}', [ExamController::class, 'start'])->name('exams.start');
    Route::get('exams/student/{id}', [ExamController::class, 'student'])->name('exams.student');
    Route::put('exams/assign/{id}', [ExamController::class, 'assign'])->name('exams.assign');
    Route::get('/exams/review/{user_id}/{exam_id}', [ExamController::class, 'review'])->name('exams.review');

    //penilaian
    Route::resource('penilaian', PenilaianController::class); 
    Route::get('penilaian/student/{id}', [PenilaianController::class, 'student'])->name('penilaian.student');
    Route::get('/penilaian/start/{id}', [PenilaianController::class, 'start'])->name('penilaian.start');

    //soal penilaian tentor
    Route::resource('soalPenilaian', SoalPenilaianController::class)->except([
        'show'
    ]);
});
