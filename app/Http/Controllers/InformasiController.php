<?php

namespace App\Http\Controllers;

use App\Models\Informasi;
use App\Models\Image;
use App\Models\Document;
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

    public function index()
    {
        $infos = Informasi::latest()->when(request()->q, function($infos) {
            $infos = $infos->where('isi_informasi', 'like', '%'. request()->q . '%');
        })->paginate(10);

        $document = new Document();
        $image = new Image();

        return view('informasi.index', compact('infos','image','document'));
    }

    public function create(Informasi $info)
    {
        $image = Image::latest()->get();
        $document = Document::latest()->get();
        return view('informasi.create', compact('info','document','image'));
    }

    public function store(Request $request) 
    {
        $this->validate($request, [
            'isi_informasi'     => 'required'
        ]);
        
        $info = Informasi::create([
            'isi_informasi'     => $request->input('isi_informasi'),
            'image_id'      => $request->input('image_id'),
            'document_id'   => $request->input('document_id'),
        ]);

        if($info){
            //redirect dengan pesan sukses
            return redirect()->route('informasi.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('informasi.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

    public function edit($id)
    {
        $informasi = Informasi::find($id);
        $image = Image::latest()->get();
        $document = Document::latest()->get();
        return view('informasi.edit', compact('informasi','image','document'));
    }

    public function update(Request $request,$id)
    {
        $this->validate($request, [
            'isi_informasi'  => 'required' 
        ]); 

        $info = Informasi::find($id);

        $info->isi_informasi = $request->input('isi_informasi');
        $info->image_id = $request->input('image_id');
        $info->document_id = $request->input('document_id');
        $info->update();
    
        if($info){
            //redirect dengan pesan sukses
            return redirect()->route('informasi.index')->with(['success' => 'Data Berhasil Diupdate!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('informasi.index')->with(['error' => 'Data Gagal Diupdate!']);
        }
    }
    
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
