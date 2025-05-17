<?php

namespace App\Exports;

use App\Models\Siswa;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class SiswaExport implements FromView, ShouldAutoSize
{
    public function view(): View
    {
        $CalSis = Siswa::with('detailSiswa')->orderBy('created_at', 'desc')->get();
        $Tanggal = Carbon::now()->setTimezone('Asia/Jakarta')->format('d-m-Y_H.i.s');
        return view('menu/ppdb/excel', compact('CalSis', 'Tanggal'));
    }
}