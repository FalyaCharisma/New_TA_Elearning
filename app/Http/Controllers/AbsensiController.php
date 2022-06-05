<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Exports\AbsensiExport;
use App\Exports\Absensis;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;

class AbsensiController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:absensi.index|absensi.create|absensi.delete|absensi.tentor|absensi.riwayat|absensi.export_excel|absensi.ExportPDF']);
    }

    public function tentor()
    {
        $absens = Absensi::latest()->when(request()->q, function($absens) {
            $absens = $absens->where('name', 'like', '%'. request()->q . '%');
        })->paginate(10);
        return view('absensi.tentor', compact('absens'));
    }
 
    public function riwayat()
    {
        $absens = Absensi::latest()->when(request()->q, function($absens) {
            $absens = $absens->where('name', 'like', '%'. request()->q . '%');
        })->paginate(10);
        return view('absensi.riwayat', compact('absens'));
    }

    public function index(){
        $absens = Absensi::latest()->when(request()->q, function($absens) {
            $absens = $absens->where('name', 'like', '%'. request()->q . '%');
        })->paginate(10);
        return view('absensi.index', compact('absens'));
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'keterangan'   => 'required',
            'image'        => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);
     
        $link = $request->file('image')->hashName();
        $path = $request->file('image')->store('public/absensis');
        $keterangan = $request->input('keterangan');
        $name = Auth::user()->name;

        $save = new Absensi;
 
        $save->link = $link;
        $save->path = $path;
        $save->keterangan = $keterangan;
        $save->name = $name;
        $save->save();

        return redirect()->route('absensi.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }
    
    public function destroy($id)
    {
        $absens = Absensi::findOrFail($id);
        $absens->delete();
 
        if($absens){
            return response()->json([
                'status' => 'success'
            ]);
        }else{
            return response()->json([
                'status' => 'error'
            ]);
        }
    }

    public function export_excel()
	{
		return Excel::download(new AbsensiExport, 'absensi.xlsx');
	}

    public function ExportPDF()
    {
        $absens = Absensi::orderBy('name')->get();
        $pdf = PDF::loadView('absensi.absensi', compact('absens'));
        $pdf->download('rekapan.pdf');
        return $pdf->stream();
    }
}