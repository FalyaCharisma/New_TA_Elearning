<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:images.index|images.create|images.delete']);
    }

    public function index()
    {
        $images = Image::where('user_id', Auth()->id())->latest()->when(request()->q, function($images) {
            $images = $images->where('title', 'like', '%'. request()->q . '%');
        })->paginate(10);

        return view('images.index', compact('images'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title'     => 'required',
            'image'     => 'required|mimes:jpg,bmp,png,img',
        ]);

        //upload image
        $image = $request->file('image');
        $image->storeAs('public/images', $image->getClientOriginalName());

        $image = Image::create([
            'title'     => $request->input('title'),
            'link'     => $image->getClientOriginalName(),
            'caption'   => $request->input('caption'),
            'user_id'   => Auth()->id(), 
        ]);

        if($image){
            //redirect dengan pesan sukses
            return redirect()->route('images.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('images.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

    public function destroy($id)
    {
        $image = Image::findOrFail($id);
        $link= Storage::disk('local')->delete('public/images/'.$image->link);
        $image->delete();

        if($image){
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
