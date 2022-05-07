<?php

namespace App\Http\Controllers;

use App\Models\Informasi;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class InformasiController extends Controller
{
     /**
     * __construct
     * 
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['permission:informasi.index|informasi.create|informasi.edit|informasi.delete']);
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */ 
    public function index()
    {
        $infos = Informasi::latest()->when(request()->q, function($infos) {
            $infos = $infos->where('isi_informasi', 'like', '%'. request()->q . '%');
        })->paginate(10);

        return view('informasi.index', compact('infos'));
    }

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Informasi $info)
    {
        return view('informasi.create', compact('info'));
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
            'isi_informasi'     => 'required'
        ]);
        
        $info = Informasi::create([
            'isi_informasi'     => $request->input('isi_informasi')
        ]);

        if($info){
            //redirect dengan pesan sukses
            return redirect()->route('informasi.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('informasi.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }
    /** 
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function edit(Informasi $info)
    // {

        public function edit($id)
    {
        $informasi = Informasi::find($id);
        return view('informasi.edit', compact('informasi'));
    }
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request,$id)
    {
        $this->validate($request, [
            'isi_informasi'  => 'required'
        ]); 

        // $info = Informasi::findOrFail($request->id);
        $info = Informasi::find($id);

         $info->isi_informasi = $request->input('isi_informasi');
         $info->update();
    
        if($info){
            //redirect dengan pesan sukses
            return redirect()->route('informasi.index')->with(['success' => 'Data Berhasil Diupdate!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('informasi.index')->with(['error' => 'Data Gagal Diupdate!']);
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
        $info = Informasi::findOrFail($id);
        $info->delete();


        if($info){
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
