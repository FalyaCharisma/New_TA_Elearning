<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Exam;
use App\Models\User;
use App\Models\Audio;
use App\Models\Image;
use App\Models\Video;
use App\Models\Subject;
use App\Models\Document;
use App\Models\QuestionEssay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\Builder;

class ExamEssayController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:exam_essays.index|exam_essays.create|exam_essays.edit|exam_essays.delete']);
    }

    public function index()
    {
        $currentUser = User::findOrFail(Auth()->id());
        if($currentUser->hasRole('admin')){
            $exam_essays = Exam::latest()->when(request()->q, function($exam_essays) {
                $exam_essays = $exam_essays->where('name', 'like', '%'. request()->q . '%');
            })->paginate(10);
        }elseif($currentUser->hasRole('student')){
            $exam_essays = Exam::latest()->whereHas('users', function (Builder $query) {
                $query->where('user_id', Auth()->id());
            })->paginate(10);
        }elseif($currentUser->hasRole('teacher')){
            $exam_essays = Exam::where('created_by', Auth()->id())->latest()->when(request()->q, function($exam_essays) {
                // $exam_essays = $exam_essays->where('created_by', Auth()->id())->where('name', 'like', '%'. request()->q . '%');
                $exam_essays = Exam::where('type_exam','essay');
            })->paginate(10);
            // $exam_essays = Exam::where('type_exam','essay');
        }
        
        $user = new User();

        return view('exam_essays.index', compact('exam_essays','user'));
    }

    public function create()
    {
        return view('exam_essays.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name'          => 'required',
            'time'          => 'required',
            'total_question'=> 'required',
            'start'         => 'required',
            'end'           => 'required',
            'type_exam'     => 'required'
        ]);

        $exam_essays = Exam::create([
            'name'          => $request->input('name'),
            'time'          => $request->input('time'),
            'total_question'=> $request->input('total_question'),
            'status'        => 'Ready',
            'type_exam'     => $request->input('type_exam'),
            'start'         => $request->input('start'),
            'end'           => $request->input('end'),
            'created_by'    => Auth()->id()
        ]);

        $exam_essays->questionEssays()->sync($request->input('questions'));

        if($exam_essays){
            //redirect dengan pesan sukses
            return redirect()->route('exam_essays.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('exam_essays.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

    public function edit(exam $exam_essay)
    {
        $questionEssays = $exam_essay->questionEssays()->where('exam_id', $exam_essay->id)->get();
        
        return view('exam_essays.edit', compact('exam_essay','questionEssays'));
    }

    public function update(Request $request, exam $exam_essay) 
    {
        $this->validate($request, [
            'name'          => 'required',
            'time'          => 'required',
            'total_question'=> 'required',
            'start'         => 'required',
            'end'           => 'required'
        ]);

        $exam_essay->update([
            'name'          => $request->input('name'),
            'time'          => $request->input('time'),
            'total_question'=> $request->input('total_question'),
            'start'         => $request->input('start'),
            'end'           => $request->input('end'),
            'created_by'    => Auth()->id()
        ]);

        $exam_essay->questionEssays()->sync($request->input('questions'));

        if($exam_essay){
            //redirect dengan pesan sukses
            return redirect()->route('exam_essays.index')->with(['success' => 'Data Berhasil Diupdate!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('exam_essays.index')->with(['error' => 'Data Gagal Diupdate!']);
        }
    }

    public function show(exam $exam_essay)
    {
        $questions = $exam_essay->questionEssays()->where('exam_id', $exam_essay->id)->get();
        // $questionEssays = $exam->questionEssays()->where('exam_id', $exam->id)->get();
        // $questions = $exam->questionEssays()->where('exam_id', $exam->id)->get();
        
        // return view('exam_essays.show', compact('exam', 'questions','questionEssays'));
        return view('exam_essays.show', compact('exam_essay', 'questions'));
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
        $exam_question_essays = $exam->questionEssays;

        if ($exam_question_essays->count() == 0) {
            return back()->with(['error' => 'Belum ada Pertanyaan']);
        }
        return view('exam_essays.start', compact('id'));
    }

    public function result($score, $userId, $examId)
    {
        $user = User::findOrFail($userId);
        $exam = Exam::findOrFail($examId);
        return view('exam_essays.result', compact('score', 'user', 'exam'));
    }

    public function student($id)
    {
        $exam_essay = Exam::findOrFail($id);
        return view('exam_essays.student', compact('exam_essay'));
    }

    public function assign(Request $request, $id)
    {
        $exam_essay = Exam::findOrFail($id);

        $exam_essay->users()->sync($request->input('students'));

        return view('exam_essays.index', compact('exam_essay'));

    }

    public function review($userId, $examId)
    {
        return view('exam_essays.review', compact('userId', 'examId'));
    }

    public function riwayat(Request $request, $id)
    {
        // $user = User::findOrFail($userId);
        $exam_essay = Exam::findOrFail($id);
        $users = new User();
        
        // $evaluasis = Evaluasi::where('penilaian_id', $id)->get();
        // $siswa = Siswa::where('user_id', $id)->get();

        return view('exam_essays.riwayat', compact('exam_essay','users'));
    }

}
