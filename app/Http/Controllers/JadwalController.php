<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Siswa;
use App\Models\Tentor;

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $siswa = Siswa::latest()->get();
        $tentor = new Tentor();
        // $jadwals = Jadwal::all()->paginate(5);
        $currentUser = User::findOrFail(Auth()->id());
        $nama = substr( $currentUser->getName(Auth()->id()),0,4);
        if ($currentUser->hasRole('teacher')) {
            $jadwals = Jadwal::latest()->where('nama_tentor','like','%'.$nama.'%')->paginate(5);
        }else if ($currentUser->hasRole('student')) {
            $jadwals = Jadwal::latest()->where('nama_tentor','like','%'.$nama_tentor.'%')->paginate(5);
        }else{
            $jadwals = Jadwal::latest()->paginate(5);
        }
    
        // var_dump($jadwals);
        return view('jadwal.index',compact('jadwals','siswa','tentor'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tentor = Tentor::latest()->get();
        $siswa = Siswa::latest()->get();
        return view('jadwal.create', compact('tentor','siswa'));
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
            'nama_siswa'          => 'required',
            // 'senin'          => 'required',
            // 'hari'=> 'required',
            // 'jam_masuk'         => 'required',
            // 'jam_pulang'           => 'required'
        ]);
        // $jadwal = new Jadwal;
        // foreach($request->senin as $key => $value){
        //     $jadwal->senin  = $value;
        // }
        // $jadwal->nama_siswa = $request->input('nama_siswa');
        // $jadwal->save();

        $jadwal = Jadwal::create([
            
            'nama_siswa'          => $request->input('nama_siswa'),          
            'senin'         => $request->input('senin'),
            'selasa'           => $request->input('selasa'),
            'rabu'         => $request->input('rabu'),
            'kamis'           => $request->input('kamis'),
            'jumat'         => $request->input('jumat'),
            'sabtu'           => $request->input('sabtu'),
            'minggu'         => $request->input('minggu'),
              // 'hari'=> $request->input('hari'),
            // 'jam_masuk'         => $request->input('jam_masuk'),
            // 'jam_pulang'           => $request->input('jam_pulang'),
        ]);

       
        // $exam->questions()->sync($request->input('questions'));

        if($jadwal){
            // dd($jadwal);
            //redirect dengan pesan sukses
            return redirect()->route('jadwal.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('jadwal.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Jadwal  $jadwal
     * @return \Illuminate\Http\Response
     */
    public function show(Jadwal $jadwal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Jadwal  $jadwal
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $allJadwal = Jadwal::all();
        $jadwals = Jadwal::findOrFail($id);
        // $tentor = Tentor::findOrFail($id);
        // $siswa = Siswa::latest()->get();
        // return view('jadwal.edit', compact('tentor','siswa'));
        return view('jadwal.edit', compact('jadwals','allJadwal'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Jadwal  $jadwal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Jadwal $jadwal)
    {
        // $this->validate($request, [
        //     'nama_tentor'          => 'required',
        //     'nama_siswa'          => 'required',
        //     'hari'=> 'required',
        //     'jam_masuk'         => 'required',
        //     'jam_pulang'           => 'required'
        // ]);

        $jadwal->update([
    
            'nama_siswa'          => $request->input('nama_siswa'),          
            'senin'         => $request->input('senin'),
            'selasa'           => $request->input('selasa'),
            'rabu'         => $request->input('rabu'),
            'kamis'           => $request->input('kamis'),
            'jumat'         => $request->input('jumat'),
            'sabtu'           => $request->input('sabtu'),
            'minggu'         => $request->input('minggu'),
        ]);

        if($jadwal){
            //redirect dengan pesan sukses
            return redirect()->route('jadwal.index')->with(['success' => 'Data Berhasil Diupdate!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('jadwal.index')->with(['error' => 'Data Gagal Diupdate!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Jadwal  $jadwal
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $jadwal = Jadwal::findOrFail($id);
        $jadwal->delete();

        if($jadwal){
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
