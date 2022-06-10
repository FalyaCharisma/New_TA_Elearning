<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Penilaian;
use App\Models\User;
use App\Models\Siswa;
use App\Models\Tentor;
use App\Models\Evaluasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class PenilaianController extends Controller
{
     /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['permission:penilaian.index|penilaian.create|penilaian.edit|penilaian.delete|penilaian.riwayat|penilaian.lihat|penilaian.admin']);
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
            $penilaian = Penilaian::latest()->when(request()->q, function($penilaian) {
                $penilaian = $penilaian->where('name', 'like', '%'. request()->q . '%');
            })->paginate(10);
        }
        
        $user = new User();
        $evaluasis = Evaluasi::where('penilaian_id','user_id')->get();

        return view('penilaian.index', compact('penilaian','user','evaluasis'));
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
      
        
        return view('penilaian.edit', compact('penilaian'));
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
           return view('penilaian.show', compact('penilaian'));
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
        $users = User::latest()->get();
        $penilaian = Penilaian::findOrFail($id);
        $siswa = Siswa::latest()->get();
        return view('penilaian.start', compact('penilaian','id', 'users', 'siswa'));
    }

    public function evaluasi(Request $request, $id, Siswa $siswa)
    { 
 
        $evaluasis = Evaluasi::create([
            'user_id'      => Auth()->id(), 
            'penilaian_id'    => $id,
            'kualitas'        => $request->input('kualitas'),
            'pembelajaran'    => $request->input('pembelajaran'),
            'isi'             => $request->input('isi'),
        ]); 

 
        if ($evaluasis) {
            //redirect dengan pesan sukses
            return redirect('/penilaian')->with(['success' => 'Penilaian Berhasil Dikirim!']);
        } else {
            //redirect dengan pesan error
            return redirect()->back()->with(['error' => 'Penilaian Gagal Dikirim!']);
        }
    }


    public function riwayat($id)
    {
        $penilaian = Penilaian::findOrFail($id);
        $evaluasis = Evaluasi::where('penilaian_id', $id)->get();
        $siswa = Siswa::where('user_id', $id)->get();

        return view('penilaian.riwayat', compact('penilaian','evaluasis','siswa'));
    }

    public function lihat()
    {
        $penilaian = Penilaian::latest()->get();
        $user=  User::latest()->get();
        // $evaluasis = Evaluasi::where('penilaian_id', $penilaian_id, 'user_id', $user_id)->get();
        $evaluasis = Evaluasi::latest()->get();

        return view('penilaian.lihat', compact('penilaian','evaluasis','user'));
    }

}
