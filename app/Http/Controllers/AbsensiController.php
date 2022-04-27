<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use Illuminate\Http\Request;
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
        $this->middleware(['permission:absensi.index|absensi.create|absensi.delete']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
        $this->validate($request, [
            'keterangan'     => 'required',
            'absensi'        => 'required|mimes:jpg,bmp,png',
        ]);

        //upload image
        $absensi = $request->file('absensi');
        $absensi->storeAs('public/absensis', $absensi->hashName());

        $absensi = Absensi::create([
            'keterangan'     => $request->input('keterangan'),
            'link'           => $absensi->hashName(),
        ]);

        if($absensi){
            //redirect dengan pesan sukses
            return redirect()->route('absensi.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('absensi.index')->with(['error' => 'Data Gagal Disimpan!']);
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
        $absensi = Absensi::findOrFail($id);
        $link= Storage::disk('local')->delete('public/absens/'.$absensi->link);
        $absensi->delete();

        if($absensi){
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
