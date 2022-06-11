<?php

namespace App\Http\Controllers;
use App\Models\Absensi;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AbsensiExport;



class ExportController extends Controller
{
    public function export_excel(Request $request)
    {
        $absens = Absensi::orderBy('created_at')->get();
        return Excel::download(new AbsensiExport($request->start_date, $request->end_date), 'absensi.xlsx');
    }
}