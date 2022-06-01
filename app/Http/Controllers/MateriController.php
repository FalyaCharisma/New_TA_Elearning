<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\mataPelajaran;
use App\Models\Kelas;
use App\Models\Materi;
use App\Models\Siswa;
use App\Models\Tentor;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;

class MateriController extends Controller
{
     /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['permission:materi.index|materi.create|materi.edit|materi.delete|materi.tentor|materi.showMateri|materi.showlist']);
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */ 
    public function index()
    {
        $materis = Materi::latest()->when(request()->q, function($materis) {
            $materis = $materis->where('judul', 'like', '%'. request()->q . '%');
        })->paginate(10);
        $siswa = Siswa::latest()->get();
        $mataPelajaran = new mataPelajaran();
        $kelass = new Kelas();
        $user = new User();
        return view('materi.index', compact('materis', 'mataPelajaran', 'kelass', 'user', 'siswa'));
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */ 
    public function tentor()
    {
        $materis = Materi::latest()->when(request()->q, function($materis) {
            $materis = $materis->where('judul', 'like', '%'. request()->q . '%');
        })->paginate(10);
        $mataPelajaran = new mataPelajaran();
        $kelass = new Kelas();
        $user = Auth::user();
        return view('materi.index', compact('materis', 'mataPelajaran', 'kelass', 'user'));
    }

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $mataPelajaran = mataPelajaran::latest()->get();
        $kelass = Kelas::latest()->get();
        $user = Auth::user();
        $tentor = Tentor::latest()->get();
        $siswa = Siswa::latest()->get();
        
        return view('materi.create', compact('mataPelajaran', 'kelass', 'user','siswa','tentor'));
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
            'kelas'  => 'required',
            'mapel'  => 'required',
            'judul'  => 'required',
            'isi'    => 'required',
            'document'     => 'required|mimes:doc,docx,pdf',
        ]);

        //upload document
        $document = $request->file('document');
        $document->storeAs('public/materis', $document->getClientOriginalName());

        $materi = Materi::create([
            'kelas'           => $request->input('kelas'),
            'mapel'           => $request->input('mapel'),
            'judul'           => $request->input('judul'),
            'isi'             => $request->input('isi'),
            'ringkasan'       => $request->input('ringkasan'),
            'siswa'           => $request->input('siswa'), 
            'user_id'         => Auth()->id(),
            'link'            => $document->getClientOriginalName(),
        ]);


        if ($materi) {
            //redirect dengan pesan sukses
            return redirect()->route('materi.index')->with(['success' => 'Data Berhasil Disimpan!']);
        } else {
            //redirect dengan pesan error
            return redirect()->route('materi.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

     /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(materi $materi)
    {
        $mataPelajaran = mataPelajaran::latest()->get();
        $kelass = Kelas::latest()->get();
        $user = User::latest()->get();
        return view('materi.edit', compact('materi', 'mataPelajaran', 'kelass', 'user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, materi $materi)
    {
        $this->validate($request, [
            'kelas'  => 'required',
            'mapel'  => 'required',
            'judul'  => 'required',
            'isi'    => 'required',
        ]);

        $materi->update([
            'kelas'           => $request->input('kelas'),
            'mapel'           => $request->input('mapel'),
            'judul'           => $request->input('judul'),
            'isi'             => $request->input('isi'),
            'keterangan'      => $request->input('keterangan'),
            'kesimpulan'      => $request->input('kesimpulan'),
            'username'        => Auth::user()->username,
        ]);

        if($materi){
            //redirect dengan pesan sukses
            return redirect()->route('materi.index')->with(['success' => 'Data Berhasil Diupdate!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('materi.index')->with(['error' => 'Data Gagal Diupdate!']);
        }
    }

     /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $materi = Materi::findOrFail($id);
        $materi->delete();


        if($materi){
            return response()->json([
                'status' => 'success'
            ]);
        }else{
            return response()->json([
                'status' => 'error'
            ]);
        }
    }
    
    public function showlist()
    {     
        $user = Auth::user();
        $siswa = Siswa::latest()->get();
        $mataPelajaran = mataPelajaran::get();
        $materis = Materi::where('kelas', $user->kelas)->where('mapel', $mataPelajaran->mata_pelajaran)->get();

        return view('materi.showlist', compact('materis', 'mataPelajaran', 'user', 'siswa'));
    }

    public function showMateri($id)
    {
        $user = Auth::user($id);
        $materis = Materi::findOrFail($id);

        return view('materi.showMateri', compact('user', 'materis'));
    }
}
