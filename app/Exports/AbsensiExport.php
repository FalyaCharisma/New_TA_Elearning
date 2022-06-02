<?php

namespace App\Exports;

use App\Models\Absensi;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class AbsensiExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */

    // public function __construct(string $keyword)
    // {
    //     $this->nama= $keyword;
    // }

    public function view(): View
    { 
        return view('absensi.export', [
            // 'data' => Absensi::where('name', 'like', '%'. $this->nama . '%')->get()
            'absens'=> Absensi::all()
        ]);
    }
}