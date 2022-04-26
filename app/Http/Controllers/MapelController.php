<?php

namespace App\Http\Controllers;

use App\Models\mataPelajaran;
use Illuminate\Http\Request;

class MapelController extends Controller
{
    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['permission:mapels.index|mapels.create|mapels.delete']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mapels = mataPelajaran::latest()->when(request()->q, function($mapels) {
            $mapels = $mapels->where('mata_pelajaran', 'like', '%'. request()->q . '%');
        })->paginate(10);

        return view('mapels.index', compact('mapels'));
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
            'mata_pelajaran'     => 'required'
        ]);
        
        $mapel = mataPelajaran::create([
            'mata_pelajaran'     => $request->input('mata_pelajaran')
        ]);

        if($mapel){
            //redirect dengan pesan sukses
            return redirect()->route('mapels.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('mapels.index')->with(['error' => 'Data Gagal Disimpan!']);
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
        $mapel = mapel::findOrFail($id);
        $mapel->delete();

        if($mapel){
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
