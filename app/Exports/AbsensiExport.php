<?php

namespace App\Exports;

use App\Models\Absensi;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class AbsensiExport implements FromView
{
    private $start_date, $end_date;

    public function __construct($start_date, $end_date) {
        $this->start_date = $start_date;
        $this->end_date = $end_date;
    }

    public function view(): View
    { 
        return view('absensi.export', [
           
            'absens'=> Absensi::whereBetween('created_at',[$this->start_date, $this->end_date])->get()
        ]);
    }
}