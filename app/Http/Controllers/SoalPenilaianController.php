<?php

namespace App\Http\Controllers;

use App\Models\SoalPenilaian;
use App\Models\User;
use Illuminate\Http\Request;

class SoalPenilaianController extends Controller
{
     /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['permission:soalPenilaian.index|soalPenilaian.create|soalPenilaian.edit|soalPenilaian.delete']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $soalPenilaian = SoalPenilaian::latest()->when(request()->q, function($soalPenilaian) {
            $soalPenilaian = $soalPenilaian->where('pertanyaan', 'like', '%'. request()->q . '%');
        })->paginate(10);

        $user = new User();

        return view('soalPenilaian.index', compact('soalPenilaian', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('soalPenilaian.create');
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
            'pertanyaan'  => 'required',
            'pilihan_A'   => 'required',
            'pilihan_B'   => 'required',
            'pilihan_C'   => 'required',
            'pilihan_D'   => 'required',
            'pilihan_E'   => 'required',
            'poin1'       => 'required',
            'poin2'       => 'required',
            'poin3'       => 'required',
            'poin4'       => 'required',
            'poin5'       => 'required',
        ]);

        $soalPenilaian = SoalPenilaian::create([
            'pilihan_A'      => $request->input('pilihan_A'),
            'pilihan_B'      => $request->input('pilihan_B'),
            'pilihan_C'      => $request->input('pilihan_C'),
            'pilihan_D'      => $request->input('pilihan_D'),
            'pilihan_E'      => $request->input('pilihan_E'),
            'poin_A'         => $request->input('poin_A'),
            'poin_B'         => $request->input('poin_B'),
            'poin_C'         => $request->input('poin_C'),
            'poin_D'         => $request->input('poin_D'),
            'poin_E'         => $request->input('poin_E'),
        ]);


        if($soalPenilaian){
            //redirect dengan pesan sukses
            return redirect()->route('soalPenilaian.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('soalPenilaian.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(SoalPenilaian $soalPenilaian)
    {
        return view('soalPenilaian.edit', compact('soalPenilaian'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question)
    {
        $this->validate($request, [
            'pertanyaan'  => 'required',
            'pilihan_A'   => 'required',
            'pilihan_B'   => 'required',
            'pilihan_C'   => 'required',
            'pilihan_D'   => 'required',
            'pilihan_E'   => 'required',
            'poin1'       => 'required',
            'poin2'       => 'required',
            'poin3'       => 'required',
            'poin4'       => 'required',
            'poin5'       => 'required',
        ]);

        $question = Question::findOrFail($question->id);

        $question->update([
            'pilihan_A'      => $request->input('pilihan_A'),
            'pilihan_B'      => $request->input('pilihan_B'),
            'pilihan_C'      => $request->input('pilihan_C'),
            'pilihan_D'      => $request->input('pilihan_D'),
            'pilihan_E'      => $request->input('pilihan_E'),
            'poin_A'         => $request->input('poin_A'),
            'poin_B'         => $request->input('poin_B'),
            'poin_C'         => $request->input('poin_C'),
            'poin_D'         => $request->input('poin_D'),
            'poin_E'         => $request->input('poin_E'),
        ]);

        if($soalPenilaian){
            //redirect dengan pesan sukses
            return redirect()->route('soalPenilaian.index')->with(['success' => 'Data Berhasil Diupdate!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('soalPenilaian.index')->with(['error' => 'Data Gagal Diupdate!']);
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
        $soalPenilaian = SoalPenilaian::findOrFail($id);
        $soalPenilaian->delete();


        if($soalPenilaian){
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
