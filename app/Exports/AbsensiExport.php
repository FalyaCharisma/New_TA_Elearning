<?php

namespace App\Exports;

use App\Models\Absensi;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class AbsensiExport implements FromView
{

    public function view(): View
    { 
        return view('absensi.export', [
            'absens'=> Absensi::all()
        ]);
    }
}