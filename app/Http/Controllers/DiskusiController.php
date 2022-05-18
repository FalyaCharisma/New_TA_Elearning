<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Materi;
use App\Models\Diskusi;
use App\Models\Respon;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;


class DiskusiController extends Controller
{
     /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['permission:diskusi.index|diskusi.create|diskusi.edit|diskusi.delete|diskusi.respon|showDiskusi|diskusi.siswa|diskusi.tentor']);
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */ 
    public function index()
    {
        $diskusi = Diskusi::latest()->when(request()->q, function($diskusi) {
            $diskusi = $diskusi->where('materi', 'like', '%'. request()->q . '%');
        })->paginate(10);

        // $diskusi = Diskusi::latest();
        $respon = Respon::latest();
        $materi = new Materi();
        $user = new User();
        return view('diskusi.index', compact('diskusi','respon', 'materi', 'user'));
    }

    public function siswa()
    {
        $diskusi = Diskusi::latest()->when(request()->q, function($diskusi) {
            $diskusi = $diskusi->where('materi', 'like', '%'. request()->q . '%');
        })->paginate(10);
        $materi = new Materi();
        $user = new User();
        return view('diskusi.index', compact('diskusi', 'materi', 'user'));
    }
    
    public function tentor()
    {
        $diskusi = Diskusi::latest()->when(request()->q, function($diskusi) {
            $diskusi = $diskusi->where('materi', 'like', '%'. request()->q . '%');
        })->paginate(10);
        $materi = Materi::latest()->get();
        $user = User::latest()->get();
        return view('diskusi.index', compact('diskusi', 'materi', 'user'));
    }

    public function create(){
        $materi = Materi::latest()->get();
        $user = User::latest()->get();
        return view('diskusi.create', compact('materi','user'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'materi'      => 'required',
            'pertanyaan'  => 'required',
        ]);

        $diskusi = Diskusi::create([
            'materi'          => $request->input('materi'),
            'pertanyaan'      => $request->input('pertanyaan'),
            'user_id' => Auth()->id(),
        ]);


        if ($diskusi) {
            //redirect dengan pesan sukses
            return redirect()->route('diskusi.index')->with(['success' => 'Data Berhasil Disimpan!']);
        } else {
            //redirect dengan pesan error
            return redirect()->route('diskusi.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

    public function respon(Request $request,$id){
        // $diskusi = Diskusi::findOrFail($id);
        $respon = Respon::create([
            'user_id'       => Auth::id(),
            'diskusi_id'    => $id,
            'respon'        => $request->input('respon'),  
        ]);

        if ($respon) {
            //redirect dengan pesan sukses
            return redirect()->route('diskusi.index')->with(['success' => 'Data Berhasil Disimpan!']);
        } else {
            //redirect dengan pesan error
            return redirect()->route('diskusi.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
        // return redirect()->back();
    }


    public function showDiskusi($id)
    {
        $diskusi = Diskusi::findOrFail($id);
        $respon = Respon::where('diskusi_id', $id)->get();

        return view('diskusi.showDiskusi', compact('diskusi','respon'));
    }
}
