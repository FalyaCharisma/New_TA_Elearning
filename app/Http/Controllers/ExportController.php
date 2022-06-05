<?php

namespace App\Http\Controllers;
use App\Models\Absensi;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AbsensiExport;



class ExportController extends Controller
{
    public function export_excel()
    {
        $absensis = Absensi::orderBy('name')->get();
        return Excel::download(new AbsensiExport, 'absensi.xlsx');
    }
}