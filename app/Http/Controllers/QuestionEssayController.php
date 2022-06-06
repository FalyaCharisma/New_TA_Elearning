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

       /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['permission:question_essays.index|question_essays.create|question_essays.edit|question_essays.delete|question_essays.show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questionEssays = QuestionEssay::latest()->when(request()->q, function($questionEssays) {
            $questionEssays = $questionEssays->where('detail', 'like', '%'. request()->q . '%');
        })->paginate(10);
        $questions = Question::latest()->when(request()->q, function($questions) {
            $questions = $questions->where('detail', 'like', '%'. request()->q . '%');
        })->paginate(10);

        $subject = new Subject();
        $video = new Video();
        $audio = new Audio();
        $document = new Document();
        $image = new Image();
        $user = new User();

        return view('question_essays.index', compact('questions', 'questionEssays', 'subject', 'video', 'audio', 'document', 'image', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subjects = Subject::latest()->get();
        return view('question_essays.create', compact('subjects'));
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
            'subject_id'  => 'required',           
            'detail'      => 'required',            
        ]);

        $questionEssay = QuestionEssay::create([
            'subject_id'    => $request->input('subject_id'),
            'detail'        => $request->input('detail'),
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

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\QuestionEssay  $questionEssay
     * @return \Illuminate\Http\Response
     */
    public function show(QuestionEssay $questionEssay)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\QuestionEssay  $questionEssay
     * @return \Illuminate\Http\Response
     */
    public function edit(QuestionEssay $questionEssay)
    {
        $subjects = Subject::latest()->get();
        // $videos = Video::latest()->get();
        // $audios = Audio::latest()->get();
        // $images = Image::latest()->get();
        // $documents = Document::latest()->get();
        return view('question_essays.edit', compact('subjects','questionEssay'));
    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\QuestionEssay  $questionEssay
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\QuestionEssay  $questionEssay
     * @return \Illuminate\Http\Response
     */
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
