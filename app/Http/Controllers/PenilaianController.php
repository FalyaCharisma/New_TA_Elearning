<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Penilaian;
use App\Models\User;
use App\Models\SoalPenilaian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\Builder;

class PenilaianController extends Controller
{
     /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['permission:penilaian.index|penilaian.create|penilaian.edit|penilaian.delete']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $currentUser = User::findOrFail(Auth()->id());
        if($currentUser->hasRole('admin')){
            $penilaian = Penilaian::latest()->when(request()->q, function($penilaian) {
                $penilaian = $penilaian->where('name', 'like', '%'. request()->q . '%');
            })->paginate(10);
        }elseif($currentUser->hasRole('student')){
            $penilaian = Penilaian::whereHas('users', function (Builder $query) {
                $query->where('user_id', Auth()->id());
            })->paginate(10);
        }elseif($currentUser->hasRole('teacher')){
            $penilaian = Penilaian::latest()->when(request()->q, function($penilaian) {
                $penilaian = $penilaian->where('name', 'like', '%'. request()->q . '%');
            })->paginate(10);
        }
        
        $user = new User();

        return view('penilaian.index', compact('penilaian','user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('penilaian.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'            => 'required',
            'time'            => 'required',
            'total_pertanyaan'=> 'required',
            'start'           => 'required',
            'end'             => 'required'
        ]);

        $penilaian = Penilaian::create([
            'name'            => $request->input('name'),
            'time'            => $request->input('time'),
            'total_pertanyaan'=> $request->input('total_pertanyaan'),
            'status'          => 'Ready',
            'start'           => $request->input('start'),
            'end'             => $request->input('end'),
        ]);

        $penilaian->soal_penilaians()->sync($request->input('soal_penilaians'));

        if($penilaian){
            //redirect dengan pesan sukses
            return redirect()->route('penilaian.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('penilaian.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(penilaian $penilaian)
    {
        $soalPenilaian = $penilaian->soalPenilaian()->where('penilaian_id', $penilaian->id)->get();
        
        return view('penilaian.edit', compact('penilaian', 'soalPenilaian'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, penilaian $penilaian)
    {
        $this->validate($request, [
            'name'            => 'required',
            'time'            => 'required',
            'total_pertanyaan'=> 'required',
            'start'           => 'required',
            'end'             => 'required'
        ]);
 
        $penilaian->update([
            'name'            => $request->input('name'),
            'time'            => $request->input('time'),
            'total_pertanyaan'=> $request->input('total_pertanyaan'),
            'status'          => 'Ready',
            'start'           => $request->input('start'),
            'end'             => $request->input('end'),
        ]);

        $penilaian->soalPenilaian()->sync($request->input('soal_penilaians'));

        if($penilaian){
            //redirect dengan pesan sukses
            return redirect()->route('penilaian.index')->with(['success' => 'Data Berhasil Diupdate!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('penilaian.index')->with(['error' => 'Data Gagal Diupdate!']);
        }
    }

    /**
     * Show the form for detailing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(penilaian $penilaian)
    {
        $soalPenilaian = $penilaian->soalPenilaian()->where('penilaian_id', $penilaian->id)->get();
        
        return view('penilaian.show', compact('penilaian', 'soalPenilaian'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $penilaian = Penilaian::findOrFail($id);
        $penilaian->delete();

        if($penilaian){
            return response()->json([
                'status' => 'success'
            ]);
        }else{
            return response()->json([
                'status' => 'error'
            ]);
        }
    }

    public function start($id)
    {
        $penilaian = Penilaian::findOrFail($id);
        $soal_penilaians = $penilaian->soalPenilaian;

        if ($soal_penilaians->count() == 0) {
            return back()->with(['error' => 'Belum ada Pertanyaan']);
        }
        return view('penilaian.start', compact('id'));
    }

    public function result($nilai, $userId, $penilaianId)
    {
        $user = User::findOrFail($userId);
        $penilaian = Penilaian::findOrFail($penilaianId);
        return view('penilaian.result', compact('nilai', 'user', 'penilaian'));
    }

    public function student($id)
    {
        $penilaian = Penilaian::findOrFail($id);
        return view('penilaian.student', compact('penilaian'));
    }

    public function assign(Request $request, $id)
    {
        $penilaian = Penilaian::findOrFail($id);

        $penilaian->users()->sync($request->input('students'));

        return redirect('/penilaian');

    }

    public function review($userId, $penilaianId)
    {
        return view('penilaian.review', compact('userId', 'penilaianId'));
    }

}
