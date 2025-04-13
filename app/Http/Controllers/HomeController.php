<?php

namespace App\Http\Controllers;

use App\Models\Area\Province;
use App\Models\Berita;
use App\Models\DataGuru;
use App\Models\Ekstrakurikuler;
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
    protected $berita,
        $dataGuru,
        $galeriFoto,
        $galeriVideo,
        $ekstrakurikuler,
        $kontak,
        $osis,
        $province,
        $sambutanKepsek,
        $sejarah,
        $strukturOrganisasi,
        $visiMisi;

    public function __construct()
    {
        $this->berita = new Berita();
        $this->dataGuru = new DataGuru();
        $this->galeriFoto = new GaleriFoto();
        $this->galeriVideo = new GaleriVideo();
        $this->ekstrakurikuler = new Ekstrakurikuler();
        $this->kontak = new Kontak();
        $this->osis = new Osis();
        $this->province = new Province();
        $this->sambutanKepsek = new SambutanKepsek();
        $this->sejarah = new Sejarah();
        $this->visiMisi = new VisiMisi();
    }

    public function index()
    {
        $Berita = $this->berita->limit(3)->latest()->get();
        $GaleriFoto = $this->galeriFoto->limit(8)->latest()->get();
        $GaleriVideo = $this->galeriVideo->limit(3)->latest()->get();
        $DataGuru = $this->dataGuru->limit(4)->latest()->get();
        return view('home', compact('Berita', 'GaleriFoto', 'GaleriVideo', 'DataGuru'));
    }

    public function sambutan()
    {
        $SambutanKepsek = $this->sambutanKepsek->where('id', 1)->first();
        $DataGuru = $this->dataGuru->where('jabatan', 'kepala sekolah')->first();
        return view('sambutan', compact('SambutanKepsek', 'DataGuru'));
    }

    public function visiMisi()
    {
        $VisiMisi = VisiMisi::where('id', 1)->first();
        return view('visi-misi', compact('VisiMisi'));
    }

    public function sejarah()
    {
        $Sejarah = $this->sejarah->where('id', 1)->first();
        return view('sejarah', compact('Sejarah'));
    }

    public function strukturOrganisasi()
    {
        $StrukturOrganisasi = $this->strukturOrganisasi->where('id', 1)->first();
        return view('struktur-organisasi', compact('StrukturOrganisasi'));
    }

    public function guru()
    {
        $DataGuru = $this->dataGuru->all();
        return view('guru', compact('DataGuru'));
    }

    public function berita()
    {
        $Berita = $this->berita->latest()->paginate(9);
        return view('berita', compact('Berita'));
    }

    public function infoberita($id)
    {
        $Berita = $this->berita->findOrFail($id);
        return view('infoberita', compact('Berita'));
    }

    public function foto()
    {
        $GaleriFoto = $this->galeriFoto->latest()->paginate(12);
        return view('foto', compact('GaleriFoto'));
    }

    public function video()
    {
        $GaleriVideo = $this->galeriVideo->latest()->paginate(9);
        return view('video', compact('GaleriVideo'));
    }

    public function ppdb()
    {
        $Provinsi = $this->province->all();
        return view('ppdb', compact('Provinsi'));
    }

    public function infoppdb()
    {
        return view('infoppdb');
    }

    public function osis()
    {
        $OSIS = $this->osis->where('id', 1)->first();
        return view('osis', compact('OSIS'));
    }

    public function ekstrakurikuler()
    {
        $Ekstrakurikuler = $this->ekstrakurikuler->latest()->paginate(9);
        return view('ekstrakurikuler', compact('Ekstrakurikuler'));
    }

    public function infoekstrakurikuler($id)
    {
        $Ekstrakurikuler = $this->ekstrakurikuler->findOrFail($id);
        return view('infoekstrakurikuler', compact('Ekstrakurikuler'));
    }

    public function kontak()
    {
        $Kontak = $this->kontak->where('id', 1)->first();
        return view('kontak', compact('Kontak'));
    }
}