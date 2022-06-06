<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\Exam;
use Livewire\Component;
use App\Models\QuestionEssay;
use Livewire\WithPagination;
use Illuminate\Contracts\Session\Session;
use Illuminate\Database\Eloquent\Builder;

class QuizEssay extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $exam_id;
    public $user_id;
    public $essayAnswers = [];
    public $total_question;
    protected $listeners = ['endTimer' => 'submitAnswers'];    

    public function mount($id)
    {
        $this->exam_id = $id;
    }

    public function questionEssays()
    {
        $exam = Exam::findOrFail($this->exam_id);
        $exam_questions = $exam->questionEssays;
        $this->total_question = $exam_questions->count(); // jumlah pertanyaan nya

        if ($this->total_question >= $exam->total_question) {
            $questions = $exam->questionEssays()->take($exam->total_question)->paginate(1);
        } elseif ($this->total_question < $exam->total_question) {
            $questions = $exam->questionEssays()->take($this->total_question)->paginate(1);
        }
        return $questions;
    }

    public function answers($questionId, $jawaban)
    {
        $this->essayAnswers[$questionId] = $questionId . '-' . $jawaban;
    }

    public function submitAnswers()
    {
        // user yang menjawab by id
        // soal yang dijawan
        // jawaban nya 
        // ke tabel apa ?
        // cek apakah ada jawaban apa tidak
        if (!empty($this->essayAnswers)) {
            foreach ($this->essayAnswers as $key => $value) {

                $userAnswer = "";
                // $rightAnswer = QuestionEssay::findOrFail($key)->answer;                                
                $userAnswer = substr($value, strpos($value, '-') + 1);                
                $selectedAnswers_str = json_encode($this->essayAnswers);
                $this->user_id = Auth()->id();
                $user = User::findOrFail($this->user_id);
                // tambah jawaban disini
                $user_exam_essay = $user->whereHas('exams', function (Builder $query) {
                    $query->where('exam_id', $this->exam_id)->where('user_id', $this->user_id);
                })->count();
                $score = 0;
                if($user_exam_essay == 0)
                {
                    $user->exams()->attach($this->exam_id, ['history_answer' => $selectedAnswers_str, 'score' => $score]);
                } else{
                    $user->exams()->updateExistingPivot($this->exam_id, ['history_answer' => $selectedAnswers_str, 'score' => $score]);
                }
                return redirect()->route('exam_essays.result', [$score, $this->user_id, $this->exam_id]);
                // $bobot = 100 / $this->total_question;
                
                // if ($userAnswer == $rightAnswer) {
                //     $score = $score + $bobot;
                // }
            }
        } else {
            $score = 0;
        }
    }

    public function render()
    {
        return view('livewire.quiz-essay', [
            'exam'      => Exam::findOrFail($this->exam_id),
            'questions' => $this->questionEssays(),
        ]);
    }
}
