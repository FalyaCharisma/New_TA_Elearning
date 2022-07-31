<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    
    public function __construct()
    {
        $this->middleware(['permission:documents.index|documents.create|documents.delete']);
    }

    public function index()
    {
        $documents = Document::where('user_id', Auth()->id())->latest()->when(request()->q, function($documents) {
            $documents = $documents->where('title', 'like', '%'. request()->q . '%'); 
        })->paginate(10);

        return view('documents.index', compact('documents'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title'     => 'required',
            'document'  => 'required|mimes:doc,docx,pdf,pptx,xlsx|max:5120',
        ]);

        //upload document
        $document = $request->file('document');
        $document->storeAs('public/documents', $document->getClientOriginalName());

        $document = Document::create([
            'title'     => $request->input('title'),
            'link'     => $document->getClientOriginalName(),
            'caption'   => $request->input('caption'),
            'user_id'   => Auth()->id(), 
        ]);

        if($document){
            //redirect dengan pesan sukses
            return redirect()->route('documents.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('documents.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

    public function destroy($id)
    {
        $document = Document::findOrFail($id);
        $link= Storage::disk('local')->delete('public/documents/'.$document->link);
        $document->delete();

        if($document){
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
