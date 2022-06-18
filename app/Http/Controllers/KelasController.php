<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:kelas.index|kelas.create|kelas.delete']);
    }

    public function index()
    {
        $kelass = Kelas::latest()->when(request()->q, function($kelass) {
            $kelass = $kelass->where('nama_kelas', 'like', '%'. request()->q . '%');
        })->paginate(10);

        return view('kelas.index', compact('kelass'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nama_kelas'     => 'required'
        ]);
        
        $kelas = Kelas::create([
            'nama_kelas'     => $request->input('nama_kelas')
        ]);

        if($kelas){
            //redirect dengan pesan sukses
            return redirect()->route('kelas.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('kelas.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

    public function destroy($id)
    {
        $kelass = Kelas::findOrFail($id);
        $kelass->delete();

        if($kelass){
            return response()->json([
                'status' => 'success'
            ]);
        }else{
            return response()->json([
                'status' => 'error'
            ]);
        }
    }
}
