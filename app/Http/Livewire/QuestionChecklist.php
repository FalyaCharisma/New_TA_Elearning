<?php

namespace App\Http\Livewire;

use App\Models\Exam;
use Livewire\Component;
use App\Models\Question;
use Livewire\WithPagination;
use Illuminate\Database\Eloquent\Builder;

class QuestionChecklist extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $q = null;
    public $p = null;
    public $selectedQuestion = [];
    public $question_list = [];

    public function mount($selectedExam = null)
    {
        if (is_null($selectedExam)) {
            $this->selectedQuestion = [];
        } else {
            $this->selectedQuestion = Exam::findOrFail($selectedExam)->questions()->pluck('question_id')->toArray();
        }
       
    }

    public function deselectQuestion($questionId)
    {
        if (($key = array_search($questionId, $this->selectedQuestion)) !== false) {
            unset($this->selectedQuestion[$key]);
        }
    }

    public function updatedSelectedQuestion()
    {

        $this->dispatchBrowserEvent('question-updated', ['selectedQuestion' => $this->selectedQuestion]);
    }

    public function render()
    {
        if (empty($this->selectedQuestion)) {
            return view('livewire.question-checklist', [
                'questions' => Question::where('created_by', Auth()->id())->latest()
                                ->when($this->q != null, function($questions) {
                                            $questions = $questions->where('pertanyaan', 'like', '%'. $this->q . '%');})
                                ->paginate(5)
                ]);
        } else {
            return view('livewire.question-checklist', [
                'questions' => Question::where('created_by', Auth()->id())->latest()
                                ->when($this->q != null, function($questions) {
                                            $questions = $questions->where('pertanyaan', 'like', '%'. $this->q . '%');})
                                ->whereNotIn('id', $this->selectedQuestion)
                                ->paginate(5),
                'questionsAll' => Question::latest()->whereIn('id', $this->selectedQuestion)->get()
               
                ]);
        }
        
        
        // dd($this->questions);
    }
}
