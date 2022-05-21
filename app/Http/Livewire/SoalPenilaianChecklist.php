<?php

namespace App\Http\Livewire;

use App\Models\Penilaian;
use Livewire\Component;
use App\Models\SoalPenilaian; 
use Livewire\WithPagination;
use Illuminate\Database\Eloquent\Builder;

class SoalPenilaianChecklist extends Component
{
    use WithPagination; 

    protected $paginationTheme = 'bootstrap';
    public $q = null;
    public $p = null;
    public $selectedPertanyaan = [];
    public $pertanyaan_list = [];

    public function mount($selectedPenilaian = null)
    {
        if (is_null($selectedPenilaian)) { 
            $this->selectedPertanyaan = [];
        } else {
            $this->selectedPertanyaan = Penilaian::findOrFail($selectedPenilaian)->soal_penilaians()->pluck('soal_penilaian_id')->toArray();
        }
       
    }

    public function deselectPertanyaan($pertanyaanId)
    {
        if (($key = array_search($pertanyaanId, $this->selectedPertanyaan)) !== false) {
            unset($this->selectedPertanyaan[$key]);
        }
    }

    public function updatedSelectedPertanyaan()
    {

        $this->dispatchBrowserEvent('pertanyaan-updated', ['selectedPertanyaan' => $this->selectedPertanyaan]);
    }

    public function render()
    {
        if (empty($this->selectedPertanyaan)) {
            return view('livewire.soal-penilaian-checklist', [
                'soal_penilaians' => SoalPenilaian::latest()
                                ->when($this->q != null, function($soal_penilaians) {
                                            $soal_penilaians = $soal_penilaians->where('pertanyaan', 'like', '%'. $this->q . '%');})
                                ->paginate(5),
                ]);
        } else {
            return view('livewire.soal-penilaian-checklist', [
                'soal_penilaians' => SoalPenilaian::latest()
                                ->when($this->q != null, function($soal_penilaians) {
                                            $soal_penilaians = $soal_penilaians->where('pertanyaan', 'like', '%'. $this->q . '%');})
                                ->whereNotIn('id', $this->selectedPertanyaan)
                                ->paginate(5),
                'soalPenilaianAll' => SoalPenilaian::latest()->whereIn('id', $this->selectedPertanyaan)->get(),
                ]);
        }
        
        
        // dd($this->questions);
    }
}
