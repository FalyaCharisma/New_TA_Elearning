<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\Question;
use App\Models\User;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
     /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['permission:questions.index|questions.create|questions.edit|questions.delete']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = Question::latest()->when(request()->q, function($questions) {
            $questions = $questions->where('pertanyaan', 'like', '%'. request()->q . '%');
        })->paginate(10);

        $subject = new Subject();
        $user = new User();

        return view('questions.index', compact('questions','user', 'subject'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subjects = Subject::latest()->get();
        return view('questions.create', compact('subjects'));
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
            'pertanyaan'  => 'required',
            'option_A'    => 'required',
            'option_B'    => 'required',
            'jawaban'     => 'required',
            'penjelasan'  => 'required',
            'document'    => 'required|mimes:doc,docx,pdf,mp3,wav,jpg,bmp,png,jpeg, mp4,mpeg',
        ]);

         //upload dokumen
         $document = $request->file('document');
         $document->storeAs('public/document', $document->hashName());

        $question = Question::create([
            'subject_id'    => $request->input('subject_id'),
            'pertanyaan'    => $request->input('pertanyaan'),
            'option_A'      => $request->input('option_A'),
            'option_B'      => $request->input('option_B'),
            'option_C'      => $request->input('option_C'),
            'option_D'      => $request->input('option_D'),
            'option_E'      => $request->input('option_E'),
            'link'          => $document->hashName(),
            'jawaban'       => $request->input('jawaban'),
            'penjelasan'    => $request->input('penjelasan'),
            'created_by'    => Auth()->id()
        ]);


        if($question){
            //redirect dengan pesan sukses
            return redirect()->route('questions.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('questions.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        $subjects = Subject::latest()->get();
        return view('questions.edit', compact('question', 'subjects'));
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
            'subject_id'  => 'required',
            'pertanyaan'  => 'required',
            'option_A'    => 'required',
            'option_B'    => 'required',
            'jawaban'     => 'required',
            'penjelasan'  => 'required',
            'document'    => 'required|mimes:doc,docx,pdf,mp3,wav,jpg,bmp,png,jpeg, mp4,mpeg',
        ]);

        $question = Question::findOrFail($question->id);

        $question->update([
            'subject_id'    => $request->input('subject_id'),
            'pertanyaan'    => $request->input('pertanyaan'),
            'option_A'      => $request->input('option_A'),
            'option_B'      => $request->input('option_B'),
            'option_C'      => $request->input('option_C'),
            'option_D'      => $request->input('option_D'),
            'option_E'      => $request->input('option_E'),
            'link'          => $document->hashName(),
            'jawaban'       => $request->input('jawaban'),
            'penjelasan'    => $request->input('penjelasan'),
            'created_by'    => Auth()->id()
        ]);

        if($question){
            //redirect dengan pesan sukses
            return redirect()->route('questions.index')->with(['success' => 'Data Berhasil Diupdate!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('questions.index')->with(['error' => 'Data Gagal Diupdate!']);
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
        $question = Question::findOrFail($id);
        $question->delete();


        if($question){
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
