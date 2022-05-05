<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AbsensiController extends Controller
{
    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['permission:absensi.index|absensi.create|absensi.delete|absensi.tentor|absensi.riwayat']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function tentor()
    {
        $absens = Absensi::latest()->when(request()->q, function($absens) {
            $absens = $absens->where('keterangan', 'like', '%'. request()->q . '%');
        })->paginate(10);
        return view('absensi.tentor', compact('absens'));
    }
 
    public function riwayat()
    {
        $absens = Absensi::with('user')->get();

        return view('absensi.riwayat', compact('absens'));
    }

    public function index(){
        $absens = Absensi::latest()->when(request()->q, function($absens) {
            $absens = $absens->where('keterangan', 'like', '%'. request()->q . '%');
        })->paginate(10);
        return view('absensi.index', compact('absens'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'keterangan'   => 'required',
            'image'        => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);
     
        $link = $request->file('image')->hashName();
        $path = $request->file('image')->store('public/absensis');
        $keterangan = $request->input('keterangan');
        $user_id = Auth::user()->id;

        $save = new Absensi;
 
        $save->link = $link;
        $save->path = $path;
        $save->keterangan = $keterangan;
        $save->user_id = $user_id;
 
        $save->save();

        return redirect()->route('absensi.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
}