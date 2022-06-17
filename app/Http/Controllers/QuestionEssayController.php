<?php

namespace App\Http\Controllers;

use App\Models\QuestionEssay;

use App\Models\Audio;
use App\Models\Image;
use App\Models\Video;
use App\Models\Subject;
use App\Models\Document;
use App\Models\Question;
use App\Models\User;
use Illuminate\Http\Request;

class QuestionEssayController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:question_essays.index|question_essays.create|question_essays.edit|question_essays.delete|question_essays.show']);
    }

    public function index()
    {
        $questionEssays = QuestionEssay::latest()->when(request()->q, function($questionEssays) {
            $questionEssays = $questionEssays->where('detail', 'like', '%'. request()->q . '%');
        })->paginate(10);

        $subject = new Subject();
        $video = new Video();
        $audio = new Audio();
        $document = new Document();
        $image = new Image();
        $user = new User();

        return view('question_essays.index', compact('questionEssays', 'subject', 'video', 'audio', 'document', 'image', 'user'));
    }

    public function create()
    {
        $subjects = Subject::latest()->get();
        $videos = Video::latest()->get();
        $audios = Audio::latest()->get();
        $images = Image::latest()->get();
        $documents = Document::latest()->get();
        return view('question_essays.create', compact('subjects','videos', 'audios', 'images', 'documents'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'subject_id'  => 'required',           
            'detail'      => 'required',    
        ]);

        $questionEssay = QuestionEssay::create([
            'subject_id'    => $request->input('subject_id'),
            'detail'        => $request->input('detail'),
            'video_id'      => $request->input('video_id'),
            'audio_id'      => $request->input('audio_id'),
            'image_id'      => $request->input('image_id'),
            'document_id'   => $request->input('document_id'),
            'answer'        => $request->input('answer'),
            'explanation'   => $request->input('explanation'),     
            'created_by'    => Auth()->id()
        ]);
        if($questionEssay){
            //redirect dengan pesan sukses
            return redirect()->route('question_essays.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('question_essays.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

    public function show(QuestionEssay $questionEssay)
    {
        //
    }

    public function edit(QuestionEssay $questionEssay)
    {
        $subjects = Subject::latest()->get();
        $videos = Video::latest()->get();
        $audios = Audio::latest()->get();
        $images = Image::latest()->get();
        $documents = Document::latest()->get();
        return view('question_essays.edit', compact('subjects','questionEssay'));
    
    }

    public function update(Request $request, QuestionEssay $questionEssay)
    {
        $this->validate($request, [
            'subject_id'  => 'required',           
            'detail'      => 'required',            
        ]);

        $questionEssay = QuestionEssay::findOrFail($questionEssay->id);

        $questionEssay->update([
            'subject_id'    => $request->input('subject_id'),
            'detail'        => $request->input('detail'),
            'created_by'    => Auth()->id()
        ]);

        if($questionEssay){
            //redirect dengan pesan sukses
            return redirect()->route('question_essays.index')->with(['success' => 'Data Berhasil Diupdate!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('question_essays.index')->with(['error' => 'Data Gagal Diupdate!']);
        }
    }

    public function destroy($id)
    {
        $questionEssay = QuestionEssay::findOrFail($id);
        $questionEssay->delete();


        if($questionEssay){
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
