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

    public function __construct()
    {
        $this->middleware(['permission:materi.index|materi.create|materi.edit|materi.delete|materi.tentor|materi.showMateri|materi.showlist']);
    }

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

    public function create()
    {
        $mataPelajaran = mataPelajaran::latest()->get();
        $kelass = Kelas::latest()->get();
        $user = Auth::user();
        $tentor = Tentor::latest()->get();
        $siswa = Siswa::latest()->get();
        
        return view('materi.create', compact('mataPelajaran', 'kelass', 'user','siswa','tentor'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'kelas'  => 'required',
            'mapel'  => 'required',
            'judul'  => 'required',
            'isi'    => 'required',
            'document'     => 'required|mimes:doc,docx,pdf,pptx,xlsx',
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

    public function edit(materi $materi)
    {
        $mataPelajaran = mataPelajaran::latest()->get();
        $kelass = Kelas::latest()->get();
        $user = User::latest()->get();
        $siswa = Siswa::latest()->get();
        
        return view('materi.edit', compact('materi', 'mataPelajaran', 'kelass', 'user','siswa'));
    }

    public function update(Request $request, materi $materi)
    {
        $this->validate($request, [
            'kelas'  => 'required',
            'mapel'  => 'required',
            'judul'  => 'required',
            'isi'    => 'required',
            'document'     => 'required|mimes:doc,docx,pdf,pptx,xlsx',
        ]);

        $document = $request->file('document');
        $document->storeAs('public/materis', $document->getClientOriginalName());

        $materi->update([
            'kelas'           => $request->input('kelas'),
            'mapel'           => $request->input('mapel'),
            'judul'           => $request->input('judul'),
            'isi'             => $request->input('isi'),
            'ringkasan'       => $request->input('ringkasan'),
            'siswa'           => $request->input('siswa'), 
            'user_id'         => Auth()->id(),
            'link'            => $document->getClientOriginalName(),
        ]);

        if($materi){
            //redirect dengan pesan sukses
            return redirect()->route('materi.index')->with(['success' => 'Data Berhasil Diupdate!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('materi.index')->with(['error' => 'Data Gagal Diupdate!']);
        }
    }

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
