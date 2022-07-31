<?php

namespace App\Http\Controllers;

use App\Models\Audio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AudioController extends Controller
{
    
    public function __construct()
    {
        $this->middleware(['permission:audios.index|audios.create|audios.delete']);
    }

    public function index()
    {
        $audios = Audio::where('user_id', Auth()->id())->latest()->when(request()->q, function($audios) {
            $audios = $audios->where('title', 'like', '%'. request()->q . '%');
        })->paginate(10);

        return view('audios.index', compact('audios'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title'     => 'required',
            'audio'     => 'required|mimes:mp3,wav|max:5120',
        ]);

        //upload audio
        $audio = $request->file('audio');
        $audio->storeAs('public/audios', $audio->hashName());

        $audio = Audio::create([
            'title'     => $request->input('title'),
            'link'     => $audio->hashName(),
            'caption'   => $request->input('caption'),
            'user_id'   => Auth()->id(), 
        ]);

        if($audio){
            //redirect dengan pesan sukses
            return redirect()->route('audios.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('audios.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

    public function destroy($id)
    {
        $audio = Audio::findOrFail($id);
        $link= Storage::disk('local')->delete('public/audios/'.$audio->link);
        $audio->delete();

        if($audio){
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
