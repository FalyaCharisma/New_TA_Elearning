<?php

namespace App\Http\Livewire;

use App\Models\Exam;
use App\Models\User;
use App\Models\Audio;
use App\Models\Image;
use App\Models\Video;
use Livewire\Component;
use App\Models\Document;
use Livewire\WithPagination;
use \Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class ReviewEssay extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $user_id;
    public $exam_id;
    public $jawaban_siswa = [];
    public $jawaban_score;
    public $total_question;

    public function mount($user_id, $exam_id)
    {
        $this->user_id = $user_id;
        $this->exam_id = $exam_id;
        $user = User::findOrfail($user_id);
        $user_exam = $user->exams->find($exam_id);
        $answer = $user_exam->pivot->history_answer;

        $result = json_decode($answer);
        $this->jawaban_siswa = (array)$result;
    }

    public function questionEssays()
    {
        $exam = Exam::findOrFail($this->exam_id);
        $exam_questions = $exam->questionEssays;
        $this->total_question = $exam_questions->count();

        if($this->total_question >= $exam->total_question) {
            $questions = $exam->questionEssays()->take($exam->total_question)->paginate(100);
        } elseif($this->total_question < $exam->total_question ) {
            $questions = $exam->questionEssays()->take($this->total_question)->paginate(100); 
        } 
        return $questions;

    }

    public function getAnswers()
    {
        
    }

    public function submitScores()
    {
        $score=0;

        if(!empty($this->jawaban_score)){
           
            $score += $this->jawaban_score;
        }else{
            $score = 0;
        } 
        
        
        $jawaban_siswa_str = json_encode($this->jawaban_siswa);
        $this->user_id = Auth()->id();
        $user = User::findOrFail($this->user_id);
        $user_exam = $user->whereHas('exams', function (Builder $query) {
            $query->where('exam_id',$this->exam_id)->where('user_id',$this->user_id);
        })->count();
        if($user_exam == 0)
        {
            $user->exams()->attach($this->exam_id, ['score' => $score]);
        } else{
            $user->exams()->updateExistingPivot($this->exam_id, ['history_answer' =>  $jawaban_siswa_str, 'score' => $score]);
        }
        
        return redirect()->route('exam_essays.result', [$score, $this->user_id, $this->exam_id]);
    }



    public function render()
    {
        return view('livewire.review-essay', [
            'exam'      => Exam::findOrFail($this->exam_id),
            'questions' => $this->questionEssays(),
            'video'     => new Video(),
            'audio'     => new Audio(),
            'document'  => new Document(),
            'image'     => new Image()
        ]);
    }
}
