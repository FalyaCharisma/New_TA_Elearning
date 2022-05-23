<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Penilaian;
use App\Models\User;
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
            $penilaian = Penilaian::whereHas('user', function (Builder $query) {
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
        $penilaian = Penilaian::findOrFail($id);
        $users = User::latest()->get();
        return view('penilaian.start', compact('penilaian','id', 'users'));
    }

    public function evaluasi(Request $request, $id)
    {
        // $this->validate($request, [
        //     'nama_tentor'  => 'required',
        //     'nama_siswa' => 'required',
        //     'penilaian_id' => 'required',
        //     'kualitas'  => 'required',
        //     'pembelajaran'  => 'required',
        //     'isi'    => 'required', 
        // ]);

        $evaluasis = Evaluasi::create([
            'nama_tentor'     => $request->input('nama_tentor'),
            'nama_siswa'      => Auth::user()->name,
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
