<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\ExamEssayController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AudioController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\QuestionEssayController;
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
use App\Http\Controllers\ExportController;
use App\Http\Controllers\NilaiController;
use App\Http\Controllers\JadwalController;
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

    Route::get('users/createSiswa', [UserController::class, 'createSiswa'])->name('users.createSiswa');
    Route::get('users/createTentor', [UserController::class, 'createTentor'])->name('users.createTentor');
    Route::get('users/createAdmin', [UserController::class, 'createAdmin'])->name('users.createAdmin');
    Route::post('users/createTentor/store2', [UserController::class, 'store2'])->name('users.store2');
    Route::post('users/createSiswa/store3', [UserController::class, 'store3'])->name('users.store3');
    Route::post('users/createAdmin/store', [UserController::class, 'store'])->name('users.store');
    Route::get('users/siswa', [UserController::class, 'siswa'])->name('users.siswa');
    Route::get('users/admin', [UserController::class, 'admin'])->name('users.admin');
    Route::get('users/tentor', [UserController::class, 'tentor'])->name('users.tentor');
    Route::get('/users/tentor/edittTentor/{id}', [UserController::class, 'edittTentor'])->name('edittTentor');
    Route::post('/users/tentor/updateTentor/{id}', [UserController::class, 'updateTentor'])->name('updateTentor');
    Route::get('/users/siswa/edittSiswa/{id}', [UserController::class, 'edittSiswa'])->name('edittSiswa');
    Route::post('/users/siswa/updateSiswa/{id}', [UserController::class, 'updateSiswa'])->name('updateSiswa');
    Route::get('/users/admin/edittAdmin/{id}', [UserController::class, 'edittAdmin'])->name('edittAdmin');
    Route::post('/users/admin/updateAdmin/{id}', [UserController::class, 'updateAdmin'])->name('updateAdmin');
    
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

    //question essays
    Route::resource('question_essays', QuestionEssayController::class);

    //ujian nilai
    // Route::resource('nilai', NilaiController::class);
    Route::get('/nilai', [NilaiController::class, 'index'])->name('nilai.index');
    Route::get('/nilai/tentor', [NilaiController::class, 'tentor'])->name('nilai.tentor');
    Route::get('/nilai/exportPDF/', [NilaiController::class, 'export_pdf'])->name('nilai.exportPDF');
    Route::get('/nilai/cetakNilai/{id}', [NilaiController::class, 'cetakNilai'])->name('nilai.cetakNilai');
    Route::get('/nilai/siswa/{id}', [NilaiController::class, 'siswa'])->name('nilai.siswa');

    //materi
    Route::resource('materi', MateriController::class);
    Route::get('materi/showMateri/{id}', [MateriController::class, 'showMateri'])->name('materi.showMateri');

    //absens
    Route::resource('absensi', AbsensiController::class)->except([
        'show', 'create', 'edit', 'update'
    ]);

    Route::get('/absensi/export_excel/{start_date}/{end_date}/{name}', [ExportController::class, 'export_excel'])->name('absensi.export_excel');
    Route::get('/absensi/exportPDF/{start_date}/{end_date}/{name}', [AbsensiController::class, 'cetakAbsensiPertanggalPDF'])->name('absensi.exportPDF');


    //informasi
     Route::resource('informasi', InformasiController::class)->except([
        'show'
    ]);

    //Profile
    Route::resource('profile', ProfileController::class)->except([
        'show'
    ]);
    Route::get('/profile/siswa/editSiswa/{id}', [ProfileController::class, 'editSiswa'])->name('editSiswa');
    Route::post('/profile/siswa/siswaUpdate/{id}', [ProfileController::class, 'siswaUpdate'])->name('siswaUpdate');
    Route::get('/profile/tentor/editTentor/{id}', [ProfileController::class, 'editTentor'])->name('editTentor');
    Route::post('/profile/tentor/tentorUpdate/{id}', [ProfileController::class, 'tentorUpdate'])->name('tentorUpdate');

    //Diskusi
    Route::resource('diskusi', DiskusiController::class)->except([
        'show'
    ]);
    Route::get('diskusi/showDiskusi/{id}', [DiskusiController::class, 'showDiskusi'])->name('diskusi.showDiskusi');
    Route::post('diskusi/respon/{id}', [DiskusiController::class, 'respon'])->name('diskusi.respon');
    Route::delete('/diskusi/respon/delete/{id}', [DiskusiController::class, 'destroy2']);
    Route::get('/diskusi/respon/editRespon/{id}', [DiskusiController::class, 'editRespon'])->name('editRespon');
    Route::post('/diskusi/respon/responUpdate/{id}', [DiskusiController::class, 'responUpdate'])->name('responUpdate');

    //exams 
    Route::resource('exams', ExamController::class); 
    Route::get('/exams/result/{score}/{user_id}/{exam_id}', [ExamController::class, 'result'])->name('exams.result');
    Route::get('/exams/start/{id}', [ExamController::class, 'start'])->name('exams.start');
    Route::get('exams/student/{id}', [ExamController::class, 'student'])->name('exams.student');
    Route::put('exams/assign/{id}', [ExamController::class, 'assign'])->name('exams.assign');
    Route::get('/exams/review/{user_id}/{exam_id}', [ExamController::class, 'review'])->name('exams.review');
    Route::get('exams/riwayat/{id}', [ExamController::class, 'riwayat'])->name('exams.riwayat');

    //exams essay
    Route::resource('exam_essays', ExamEssayController::class);
    Route::get('/exam_essays/result/{score}/{user_id}/{exam_id}', [ExamEssayController::class, 'result'])->name('exam_essays.result');
    Route::get('/exam_essays/start/{id}', [ExamEssayController::class, 'start'])->name('exam_essays.start');
    Route::get('exam_essays/student/{id}', [ExamEssayController::class, 'student'])->name('exam_essays.student');
    Route::put('exam_essays/assign/{id}', [ExamEssayController::class, 'assign'])->name('exam_essays.assign');
    Route::get('/exam_essays/review/{user_id}/{exam_id}', [ExamEssayController::class, 'review'])->name('exam_essays.review');
    Route::get('exam_essays/riwayat/{id}', [ExamEssayController::class, 'riwayat'])->name('exam_essays.riwayat');

    //penilaian
    Route::resource('penilaian', PenilaianController::class); 
    Route::get('penilaian/student/{id}', [PenilaianController::class, 'student'])->name('penilaian.student');
    Route::get('/penilaian/start/{id}', [PenilaianController::class, 'start'])->name('penilaian.start');
    Route::post('/penilaian/evaluasi/{id}', [PenilaianController::class, 'evaluasi'])->name('penilaian.evaluasi');
    Route::get('penilaian/siswa/{id}', [PenilaianController::class, 'siswa'])->name('penilaian.siswa');
    Route::get('penilaian/riwayat/{id}', [PenilaianController::class, 'riwayat'])->name('penilaian.riwayat');

    //jadwal
    Route::resource('jadwal', JadwalController::class);

});
