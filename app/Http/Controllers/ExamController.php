<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Exam;
use App\Models\User;
use App\Models\Audio;
use App\Models\Image;
use App\Models\Video;
use App\Models\Document;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\Builder;

class ExamController extends Controller
{
     /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['permission:exams.index|exams.create|exams.edit|exams.delete']);
    }

    public function index()
    {

        $currentUser = User::findOrFail(Auth()->id());
        if($currentUser->hasRole('student')){
            $exams = Exam::whereHas('users',function(Builder $query){
                $query->where('user_id',Auth()->id())->where('type_exam', 'ganda');
            })->paginate(10);
            
        }elseif($currentUser->hasRole('teacher')){
            $exams = Exam::where('created_by', Auth()->id())->latest()->when(request()->q, function ($exams) {
                $exams = $exams->where('created_by', Auth()->id())->where('name', 'like', '%' . request()->q . '%');
            })->where('type_exam', 'ganda')->paginate(10);          
        }
        
        $user = new User();

        return view('exams.index', compact('exams','user'));
    }

    public function create()
    {
        return view('exams.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name'          => 'required',
            'time'          => 'required',
            'total_question'=> 'required',
            'start'         => 'required',
            'end'           => 'required'
        ]);

        $exam = Exam::create([
            'name'          => $request->input('name'),
            'time'          => $request->input('time'),
            'total_question'=> $request->input('total_question'),
            'status'        => 'Ready',
            'type_exam'     => $request->input('type_exam'),
            'start'         => $request->input('start'),
            'end'           => $request->input('end'),
            'created_by'    => Auth()->id()
        ]);

        $exam->questions()->sync($request->input('questions'));

        if($exam){
            //redirect dengan pesan sukses
            return redirect()->route('exams.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('exams.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

    public function edit(exam $exam)
    {
        $questions = $exam->questions()->where('exam_id', $exam->id)->get();
        
        return view('exams.edit', compact('exam', 'questions'));
    }

    public function update(Request $request, exam $exam)
    {
        $this->validate($request, [
            'name'          => 'required',
            'time'          => 'required',
            'total_question'=> 'required',
            'start'         => 'required',
            'end'           => 'required'
        ]);

        $exam->update([
            'name'          => $request->input('name'),
            'time'          => $request->input('time'),
            'total_question'=> $request->input('total_question'),
            'start'         => $request->input('start'),
            'end'           => $request->input('end'),
            'created_by'    => Auth()->id()
        ]);

        $exam->questions()->sync($request->input('questions'));

        if($exam){
            //redirect dengan pesan sukses
            return redirect()->route('exams.index')->with(['success' => 'Data Berhasil Diupdate!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('exams.index')->with(['error' => 'Data Gagal Diupdate!']);
        }
    }

    public function show(exam $exam)
    {
        $questions = $exam->questions()->where('exam_id', $exam->id)->get();
        
        return view('exams.show', compact('exam', 'questions'));
    }

    public function destroy($id)
    {
        $exam = Exam::findOrFail($id);
        $exam->delete();

        if($exam){
            return response()->json([
                'status' => 'success'
            ]);
        }else{
            return response()->json([
                'status' => 'error'
            ]);
        }
    }

    public function start($id)
    {
        $exam = Exam::findOrFail($id);
        $exam_questions = $exam->questions;

        if ($exam_questions->count() == 0) {
            return back()->with(['error' => 'Belum ada Pertanyaan']);
        }
        return view('exams.start', compact('id'));
    }

    public function result($score, $userId, $examId)
    {
        $user = User::findOrFail($userId);
        $exam = Exam::findOrFail($examId);
        return view('exams.result', compact('score', 'user', 'exam'));
    }

    public function student($id)
    {
        $exam = Exam::findOrFail($id);
        return view('exams.student', compact('exam'));
    }

    public function assign(Request $request, $id)
    {
        $exam = Exam::findOrFail($id);

        $exam->users()->sync($request->input('students'));

        return redirect('/exams');

    }

    public function review($userId, $examId)
    {
        return view('exams.review', compact('userId', 'examId'));
    }

    public function riwayat(Request $request, $id)
    {
        $exam = Exam::findOrFail($id);
        $users = new User();

        return view('exams.riwayat', compact('exam','users'));
    }

}
