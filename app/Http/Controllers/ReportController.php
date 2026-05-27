<?php

namespace App\Http\Controllers;

use App\Exports\RentalExport;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    public function index(): View
    {
        return view('reports.index');
    }

    public function exportExcel()
    {
        return Excel::download(new RentalExport, 'laporan.xlsx');
    }
}
