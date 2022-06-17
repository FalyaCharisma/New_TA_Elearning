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

class ReviewEssay extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $user_id;
    public $exam_id;
    public $jawaban_siswa = [];
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
