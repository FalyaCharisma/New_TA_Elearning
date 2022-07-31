<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Exam;
use App\Models\User;
use App\Models\Audio;
use App\Models\Image;
use App\Models\Video;
use App\Models\Document;
use App\Models\Question;
use App\Models\Siswa;
use App\Models\Tentor;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\Builder;

class NilaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $currentUser = User::findOrFail(Auth()->id());
        if($currentUser->hasRole('student')){
            $exams = Exam::whereHas('users',function(Builder $query){
                $query->where('user_id',Auth()->id());
            })->paginate(10);
            
        }elseif($currentUser->hasRole('teacher')){
            $exams = Exam::where('created_by', Auth()->id())->latest()->when(request()->q, function ($exams) {
                $exams = $exams->where('created_by', Auth()->id())->where('name', 'like', '%' . request()->q . '%');
            })->where('type_exam', 'ganda')->paginate(10);          
        }
        
        $user = new User();

        return view('nilai.index', compact('exams','user'));
    }

    public function tentor()
    { 
        $users = User::latest()->get();
        $exams = Exam::latest()->get();
        $siswa = new Siswa();
        $tentor = Tentor::latest()->get();
        return view('nilai.tentor', compact('users','tentor','exams','siswa'));
    }

    public function siswa(Request $request, $id)
    { 
        $users = User::findOrFail($id);
        $exams = Exam::where('created_by', Auth()->id())->latest()->when(request()->q, function ($exams) {
            $exams = $exams->where('created_by', Auth()->id())->where('name', 'like', '%' . request()->q . '%');
        })->where('type_exam', 'ganda');
        $siswa = new Siswa();
        $tentor = Tentor::latest()->get();
        return view('nilai.siswa', compact('users','tentor','exams','siswa'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Nilai  $nilai
     * @return \Illuminate\Http\Response
     */
    public function show(Exam  $nilai)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Exam  $nilai
     * @return \Illuminate\Http\Response
     */
    public function edit(Exam $nilai)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Exam  $nilai
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Exam $nilai)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Exam  $nilai
     * @return \Illuminate\Http\Response
     */
    public function destroy(Exam $nilai)
    {
        //
    }

    public function export_pdf(){
        // $startDate = Carbon::parse($start_date)->toDateString();
        // $endDate = Carbon::parse($end_date)->toDateString();
        // $nilai = Exam::whereHas('users',function(Builder $query){
        //     $query->where('user_id',Auth()->id());
        // });
        $user = new User();
        $nilai = Exam::whereHas('users',function(Builder $query){
            $query->where('user_id',Auth()->id());
        })->get();
        // $nilai = Nilai::latest()->get()->whereBetween('created_at',[$start_date, $end_date]);
        $pdf = PDF::loadView('nilai.nilaiPdf', compact('nilai','user'));
        // $pdf->download('rekapan.pdf');
        return $pdf->stream();
    }

    public function cetakNilai(Request $request, $id){
        // $startDate = Carbon::parse($start_date)->toDateString();
        // $endDate = Carbon::parse($end_date)->toDateString();
        // $nilai = Exam::whereHas('users',function(Builder $query){
        //     $query->where('user_id',Auth()->id());
        // });
        $users = User::findOrFail($id);
        $exams = Exam::latest()->get();
        // $nilai = Nilai::latest()->get()->whereBetween('created_at',[$start_date, $end_date]);
        $pdf = PDF::loadView('nilai.cetakNilai', compact('exams','users'));
        // $pdf->download('rekapan.pdf');
        return $pdf->stream();
    }
}