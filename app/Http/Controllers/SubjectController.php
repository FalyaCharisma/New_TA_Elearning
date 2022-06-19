<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
   
    public function __construct()
    {
        $this->middleware(['permission:subjects.index|subjects.create|subjects.delete']);
    }

    public function index()
    {
        $subjects = Subject::where('user_id', Auth()->id())->latest()->when(request()->q, function($subjects) {
            $subjects = $subjects->where('name', 'like', '%'. request()->q . '%'); 
        })->paginate(10);

        return view('subjects.index', compact('subjects'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name'     => 'required'
        ]);
        
        $subject = Subject::create([
            'name'     => $request->input('name'),
            'user_id'   => Auth()->id(), 
        ]);

        if($subject){
            //redirect dengan pesan sukses
            return redirect()->route('subjects.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('subjects.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

    public function destroy($id)
    {
        $subject = subject::findOrFail($id);
        $subject->delete();

        if($subject){
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
