<?php

namespace App\Http\Controllers;
use App\Models\Ujian;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;

class UjianController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:ujian.index|ujian.create|ujian.edit|ujian.delete|ujian.tentor|ujian.show']);
    }
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ujians = Ujian::latest()->when(request()->q, function($ujians) {
            $ujians = $ujians->where('name', 'like', '%'. request()->q . '%');
        })->paginate(10);

        return view('ujian.index', compact('ujians'));
    }

    public function tentor()
    {
        $ujians = Ujian::latest()->when(request()->q, function($ujians) {
            $ujians = $ujians->where('name', 'like', '%'. request()->q . '%');
        })->paginate(10);

        return view('ujian.index', compact('ujians'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
