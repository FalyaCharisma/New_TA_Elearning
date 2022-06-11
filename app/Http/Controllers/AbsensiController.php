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
        $tentor = Tentor::where('user_id', $id)->get();
        return view('absensi.riwayat', compact('absens','tentor'));
    }

    public function index(){
        $absens = Absensi::latest()->when(request()->q, function($absens) {
            $absens = $absens->where('name', 'like', '%'. request()->q . '%');
        })->paginate(10);
        return view('absensi.index', compact('absens'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'keterangan'   => 'required',
            'image'        => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);

        $image = $request->file('image');
        $image->storeAs('public/absensis', $image->hashName());
        // $path = $request->file('image')->store('public/absensis');

        $image = Absensi::create([
            'keterangan' => $request->input('keterangan'),
            'link'      => $image->hashName(),
            'user_id'   => Auth()->id(),
        ]);

        if($image){
            //redirect dengan pesan sukses
            return redirect()->route('absensi.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('absensi.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
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

    public function cetakAbsensiPertanggalPDF($start_date, $end_date){
        $absens = Absensi::latest()->get()->whereBetween('created_at',[$start_date, $end_date]);
        $pdf = PDF::loadView('absensi.absensi', compact('absens'));
        $pdf->download('rekapan.pdf');
        return $pdf->stream();
    }
}