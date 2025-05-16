<?php

namespace App\Http\Controllers;

use App\Models\Area\Province;
use App\Models\Berita;
use App\Models\DataGuru;
use App\Models\Ekstrakurikuler;
use App\Models\GaleriFoto;
use App\Models\GaleriVideo;
use App\Models\GelombangPendaftaran;
use App\Models\InfoPpdb;
use App\Models\Kontak;
use App\Models\Osis;
use App\Models\ProgresSiswa;
use App\Models\SambutanKepsek;
use App\Models\Sejarah;
use App\Models\Siswa;
use App\Models\StrukturOrganisasi;
use App\Models\VisiMisi;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class GuestController extends Controller
{
    protected $berita, $dataGuru, $ekstrakurikuler, $galeriFoto, $galeriVideo, $gelombang, $infoPpdb, $kontak, $osis, $province, $sambutanKepsek, $sejarah, $siswa, $strukturOrganisasi, $visiMisi;

    public function __construct()
    {
        $this->berita = new Berita();
        $this->dataGuru = new DataGuru();
        $this->ekstrakurikuler = new Ekstrakurikuler();
        $this->galeriFoto = new GaleriFoto();
        $this->galeriVideo = new GaleriVideo();
        $this->gelombang = new GelombangPendaftaran();
        $this->infoPpdb = new InfoPpdb();
        $this->kontak = new Kontak();
        $this->osis = new Osis();
        $this->province = new Province();
        $this->sambutanKepsek = new SambutanKepsek();
        $this->sejarah = new Sejarah();
        $this->siswa = new Siswa();
        $this->strukturOrganisasi = new StrukturOrganisasi();
        $this->visiMisi = new VisiMisi();
    }

    public function index()
    {
        $Berita = $this->berita->limit(3)->latest()->get();
        $GaleriFoto = $this->galeriFoto->limit(8)->latest()->get();
        $GaleriVideo = $this->galeriVideo->limit(3)->latest()->get();
        $Gelombang = $this->gelombang->all();
        $DataGuru = $this->dataGuru->limit(4)->latest()->get();
        $DataKepalaSekolah = $this->dataGuru->where('jabatan', 'kepala sekolah')->first();
        $SambutanKepsek = $this->sambutanKepsek->where('id', 1)->first();
        return view('home', compact('Berita', 'GaleriFoto', 'GaleriVideo', 'Gelombang', 'DataGuru', 'DataKepalaSekolah', 'SambutanKepsek'));
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
        // $StrukturOrganisasi = $this->strukturOrganisasi->where('id', 1)->first();
        // $StrukturOrganisasi = $this->strukturOrganisasi->findOrFail(1);
        $StrukturOrganisasi = $this->strukturOrganisasi->findOrFail(1);

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

    public function ppdb(Request $request, string $id)
    {
        if (auth()->check()) {
            return redirect()->route('home');
        }

        $Gelombang = GelombangPendaftaran::findOrFail($id);
        $jumlahPendaftar = Siswa::where('id', $Gelombang->id)->count();
        if ($jumlahPendaftar >= $Gelombang->kuota_pendaftaran) {
            abort(404);
        }

        if ($request->isMethod('post')) {
            $rules = [
                'nama-siswa' => 'required|string|max:255',
                'email-siswa' => 'required|string|email:rfc,dns|max:255|unique:siswa,email',
                'nisn-siswa' => 'required|digits_between:10,12|unique:siswa,nisn',
                'no-hp-siswa' => ['required', 'regex:/\+?([ -]?\d+)+|\(\d+\)([ -]\d+)/'],
                'kata-sandi' => ['required', 'string', 'confirmed', Password::min(8)->mixedCase()->numbers()->symbols()->uncompromised(), 'max:255'],
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return back()->with(['message' => 'gagal registrasi akun.'])->withErrors($validator)->withInput();
            }

            $validated = $validator->validated();

            $SiswaModel = Siswa::latest()->first();
            $kodeSekolah = 'SKT';
            $kodeTahun = date('Y');
            $kodeBulan = date('m');
            $kodeHari = date('d');
            if (empty($SiswaModel)) {
                $nomorUrut = '0001';
            } else {
                $explode = explode('-', $SiswaModel->id_pendaftaran);
                $nomorUrut = intval($explode[4]) + 1;
                $nomorUrut = str_pad($nomorUrut, 4, '0', STR_PAD_LEFT);
            }
            $siswa = Siswa::create([
                'id_pendaftaran' => "$kodeSekolah$kodeTahun$kodeBulan$kodeHari$nomorUrut",
                'gelombang_pendaftaran' => $Gelombang->id,
                'tahun_ajaran' => $Gelombang->tahun_ajaran,
                'nama' => $validated['nama-siswa'],
                'email' => $validated['email-siswa'],
                'nhp_siswa' => $validated['no-hp-siswa'],
                'nisn' => $validated['nisn-siswa'],
                'password' => bcrypt($validated['kata-sandi']),
            ]);
            event(new Registered($siswa));
            ProgresSiswa::create(['siswa_id' => $siswa->id]);
            Auth::login($siswa);

            return redirect()->route('siswa.dashboard');
        }

        return view('ppdb', compact('Gelombang'));
    }

    public function infoppdb()
    {
        if (auth()->check()) {
            return redirect()->route('home');
        }
        $Infoppdb = $this->infoPpdb->where('id', 1)->first();
        $Gelombang = $this->gelombang->all();
        return view('infoppdb', compact('Infoppdb', 'Gelombang'));
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