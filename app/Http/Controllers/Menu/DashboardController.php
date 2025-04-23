<?php

namespace App\Http\Controllers\Menu;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\DataGuru;
use App\Models\Ppdb;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $jumlahGuru = DataGuru::count();
        $jumlahBerita = Berita::count();
        $jumlahPendaftarPpdb = Ppdb::count();
        return view('menu.dashboard', compact('jumlahGuru', 'jumlahBerita', 'jumlahPendaftarPpdb'));
    }
}
