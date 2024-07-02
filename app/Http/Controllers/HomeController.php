<?php

namespace App\Http\Controllers;

use App\Models\Area\Province;
use App\Models\Berita;
use App\Models\DataGuru;
use App\Models\GaleriFoto;
use App\Models\GaleriVideo;
use App\Models\Kontak;
use App\Models\Osis;
use App\Models\SambutanKepsek;
use App\Models\Sejarah;
use App\Models\StrukturOrganisasi;
use App\Models\VisiMisi;

class HomeController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function sambutan()
    {
        $SambutanKepsek = SambutanKepsek::where('id', 1)->first();
        return view('sambutan', compact('SambutanKepsek'));
    }
    public function visiMisi()
    {
        $VisiMisi = VisiMisi::where('id', 1)->first();
        return view('visi-misi', compact('VisiMisi'));
    }

    public function sejarah()
    {
        $Sejarah = Sejarah::where('id', 1)->first();
        return view('sejarah', compact('Sejarah'));
    }
    public function strukturOrganisasi()
    {
        $StrukturOrganisasi = StrukturOrganisasi::where('id', 1)->first();
        return view('struktur-organisasi', compact('StrukturOrganisasi'));
    }

    public function guru()
    {
        $DataGuru = DataGuru::all();
        return view('guru', compact('DataGuru'));
    }

    public function berita()
    {
        $Berita = Berita::all();
        return view('berita', compact('Berita'));
    }

    public function foto()
    {
        $Foto = GaleriFoto::all();
        return view('foto', compact('Foto'));
    }

    public function video()
    {
        $Video = GaleriVideo::all();
        return view('video', compact('Video'));
    }

    public function ppdb()
    {
        $Provinsi = Province::all();
        return view('ppdb', compact('Provinsi'));
    }

    public function osis()
    {
        $OSIS = Osis::where('id', 1)->first();
        return view('osis', compact('OSIS'));
    }

    public function kontak()
    {
        $Kontak = Kontak::where('id', 1)->first();
        return view('kontak', compact('Kontak'));
    }
}
