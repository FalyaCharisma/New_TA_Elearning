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
use Facade\Ignition\DumpRecorder\Dump;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class AbsensiController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:absensi.index|absensi.create|absensi.delete|absensi.tentor|absensi.riwayat|absensi.export_excel|absensi.ExportPDF']);
    }

    public function tentor()
    {
        $absens = Absensi::latest()->when(request()->q, function ($absens) {
            $absens = $absens->where('name', 'like', '%' . request()->q . '%');
        })->paginate(10);
        return view('absensi.tentor', compact('absens'));
    }

    public function riwayat()
    {
        $absens = Absensi::latest()->when(request()->q, function ($absens) {
            $absens = $absens->where('name', 'like', '%' . request()->q . '%');
        })->paginate(10);
        return view('absensi.riwayat', compact('absens'));
    }

    public function index()
    {
        $absens = Absensi::latest()->when(request()->q, function ($absens) {
            $absens = $absens->where('name', 'like', '%' . request()->q . '%');
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

        if ($absens) {
            return response()->json([
                'status' => 'success'
            ]);
        } else {
            return response()->json([
                'status' => 'error'
            ]);
        }
    }

    public function export_excel(Request $request)
    {        
        $startDate = Carbon::parse(request()->input('startDate'))->toDateTimeString();
        $endDate = Carbon::parse(request()->input('endDate'))->toDateTimeString();     
        return Excel::download(new AbsensiExport('startDate', 'endDate'), 'absensiku.xlsx');
    }

    public function ExportPDF(Request $request)
    {
        if($request->startDate && $request->endDate){      
        $startDate = Carbon::parse(request()->input('startDate'))->toDateTimeString();
        $endDate = Carbon::parse(request()->input('endDate'))->toDateTimeString();
        $absens = Absensi::whereBetween('created_at', [$startDate, $endDate])->get();
        }else{
            $absens = Absensi::all();
        }       
        $pdf = PDF::loadView('absensi.absensi', compact('absens','startDate','endDate'));
        $pdf->stream('rekapan.pdf');
        return $pdf->stream();
    }
}