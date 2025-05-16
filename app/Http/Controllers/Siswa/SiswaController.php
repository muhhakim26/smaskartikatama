<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Area\District;
use App\Models\Area\Province;
use App\Models\Area\Regency;
use App\Models\Area\Village;
use App\Models\DetailSiswa;
use App\Models\GelombangPendaftaran;
use App\Models\ProgresSiswa;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class SiswaController extends Controller
{
    public function index()
    {
        $CalSis = Siswa::with(['detailSiswa' => ['provinsi', 'kabupaten', 'kecamatan', 'kelurahan']])->findOrFail(auth()->user()->id);
        $ProSis = ProgresSiswa::with('siswa')->findOrFail(auth()->user()->id);
        $Gelombang = GelombangPendaftaran::where('id', $CalSis->gelombang_pendaftaran)->first();
        return view('siswa/dashboard', compact('CalSis', 'ProSis', 'Gelombang'));
    }

    public function edit(string $id)
    {
        if (auth()->user()->id != $id) {
            return redirect()->route('siswa.edit', auth()->user()->id);
        }

        $CalSis = Siswa::with(['detailSiswa' => ['provinsi', 'kabupaten', 'kecamatan', 'kelurahan']])->findOrFail($id);

        $ProSis = ProgresSiswa::with('siswa')->findOrFail(auth()->user()->id);
        $Provinsi = Province::all();
        $vars = ['CalSis', 'ProSis', 'Provinsi'];
        if (!empty($CalSis->detailSiswa?->provinsi_id) && !empty($CalSis->detailSiswa?->kabupaten_id) && !empty($CalSis->detailSiswa?->kecamatan_id) && !empty($CalSis->detailSiswa?->desa_kelurahan_id)) {
            $Kabupaten = Regency::where('province_code', $CalSis->detailSiswa->provinsi->code)->pluck('name', 'id');
            $Kecamatan = District::where('regency_code', $CalSis->detailSiswa->kabupaten->code)->pluck('name', 'id');
            $Kelurahan = Village::where('district_code', $CalSis->detailSiswa->kecamatan->code)->pluck('name', 'id');
            $vars = array_merge($vars, ['Kabupaten', 'Kecamatan', 'Kelurahan']);
        }
        return view('siswa/edit', compact(...$vars));
    }

    public function update(Request $request, string $id)
    {
        if (auth()->user()->id != $id) {
            return redirect()->route('siswa.edit', auth()->user()->id);
        }

        $CalSis = Siswa::with('detailSiswa')->findOrFail($id);
        // 'id_pendaftaran',
        // 'email',
        // 'nama',
        // 'nhp_siswa',
        // 'nisn',
        // 'level',
        // 'siswa_id',
        // 'provinsi_id',
        // 'jenis_kelamin',
        // 'kabupaten_id',
        // 'kecamatan_id',
        // 'tempat_lahir',
        // 'desa_kelurahan_id',
        // 'tgl_lahir',
        // 'kode_pos',
        // 'agama',
        // 'asal_sekolah',
        // 'alamat',
        // 'nama_ayah',
        // 'pend_terakhir_ayah',
        // 'pekerjaan_ayah',
        // 'penghasilan_ayah',
        // 'nhp_ayah',
        // 'nama_ibu',
        // 'pend_terakhir_ibu',
        // 'pekerjaan_ibu',
        // 'penghasilan_ibu',
        // 'nhp_ibu',
        // 'fileft_siswa',
        // 'status_fileft_siswa',
        // 'filefc_akte',
        // 'status_filefc_akte',
        // 'filefc_kk',
        // 'status_filefc_kk',
        // 'filefc_skhu',
        // 'status_filefc_skhu',
        // 'filefc_skm',
        // 'status_filefc_skm',

        $rules = [
            // 'nomor-pendaftaran-siswa' => 'required|string|max:255',
            'email-siswa' => 'required|string|email:rfc,dns|unique:siswa,email,' . $id,
            'nama-siswa' => 'required|string|max:255',
            'no-hp-siswa' => ['required', 'regex:/\+?([ -]?\d+)+|\(\d+\)([ -]\d+)/'],
            // 'nisn-siswa' => 'required|digits_between:10,12|unique:siswa,nisn,' . $id,
            'provinsi-siswa' => 'required|integer',
            'jenis-kelamin-siswa' => 'required|string|in:laki-laki,perempuan',
            'kabupaten-siswa' => 'required|integer',
            'kecamatan-siswa' => 'required|integer',
            'tempat-lahir-siswa' => 'required|string|max:255',
            'desa-kelurahan-siswa' => 'required|integer',
            'tanggal-lahir-siswa' => 'required|date',
            'kode-pos-siswa' => 'required|digits:5',
            'agama-siswa' => 'required|string|in:buddha,hindu,islam,kristen_katolik,khonghucu,kristen_protestan',
            'asal-sekolah-siswa' => 'required|string|max:255',
            'alamat-siswa' => 'required|string|max:16777215',
            'nama-ayah-siswa' => 'required|string|max:255',
            'pendidikan-terakhir-ayah' => 'required|string|max:255',
            'pekerjaan-ayah' => 'required|string|max:255',
            'penghasilan-ayah' => 'required|numeric|gt:0|max:9999999999',
            'no-hp-ayah' => ['required', 'regex:/\+?([ -]?\d+)+|\(\d+\)([ -]\d+)/'],
            'nama-ibu-siswa' => 'required|string|max:255',
            'pendidikan-terakhir-ibu' => 'required|string|max:255',
            'pekerjaan-ibu' => 'required|string|max:255',
            'penghasilan-ibu' => 'required|numeric|gt:0|max:9999999999',
            'no-hp-ibu' => ['required', 'regex:/\+?([ -]?\d+)+|\(\d+\)([ -]\d+)/'],
            'file-ft-siswa' => 'nullable|image|mimes:jpeg,jpg,png|max:3072',
            'file-akte' => 'nullable|image|mimes:jpeg,jpg,png|max:3072',
            'file-kk' => 'nullable|image|mimes:jpeg,jpg,png|max:3072',
            'file-skhu' => 'nullable|image|mimes:jpeg,jpg,png|max:3072',
            'file-skm' => 'nullable|image|mimes:jpeg,jpg,png|max:3072',
            'info-pendaftaran' => 'required',
            'info-pendaftaran.*' => 'in:masyarakat,media_cetak,facebook,instagram,tiktok,website,youtube,twitter'
        ];

        if (empty($CalSis->detailSiswa->fileft_siswa) && empty($CalSis->detailSiswa->filefc_akte) && empty($CalSis->detailSiswa->filefc_kk) && empty($CalSis->detailSiswa->filefc_skhu)) {
            $rules['file-ft-siswa'] = 'required|image|mimes:jpeg,jpg,png|max:3072';
            $rules['file-akte'] = 'required|image|mimes:jpeg,jpg,png|max:3072';
            $rules['file-kk'] = 'required|image|mimes:jpeg,jpg,png|max:3072';
            $rules['file-skhu'] = 'required|image|mimes:jpeg,jpg,png|max:3072';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $with = ['message' => 'gagal menyimpan data.', 'isActive' => false, 'hasError' => true];
            if ($request->has('provinsi-siswa') && $request->has('kabupaten-siswa') && $request->has('kecamatan-siswa')) {
                $provinceId = $request->input('provinsi-siswa');
                $kabupatenId = $request->input('kabupaten-siswa');
                $kecamatanId = $request->input('kecamatan-siswa');
                $Kabupaten = Province::with('regencies')->find($provinceId);
                $Kecamatan = Regency::with('districts')->find($kabupatenId);
                $Kelurahan = District::with('villages')->find($kecamatanId);
                $with['Kabupaten'] = $Kabupaten->regencies->pluck('name', 'id');
                $with['Kecamatan'] = $Kecamatan->districts->pluck('name', 'id');
                $with['Kelurahan'] = $Kelurahan->villages->pluck('name', 'id');
            }

            return back()->with($with)->withErrors($validator)->withInput();
        }

        $validated = $validator->validated();

        ProgresSiswa::where('siswa_id', auth()->user()->id)->update(['step_1' => true, 'step_2' => true]);
        $namaLama = $CalSis->nama;
        $nhpSiswaLama = $CalSis->nhp_siswa;
        $emailLama = $CalSis->email;
        if (!empty($validated['email-siswa']) || !empty($validated['no-hp-siswa']) || !empty($validated['nama-siswa']) && $namaLama !== $validated['nama-siswa'] || $nhpSiswaLama !== $validated['no-hp-siswa'] || $emailLama !== $validated['email-siswa']) {
            if (!empty($validated['email-siswa'])) {
                $CalSis->email = $validated['email-siswa'];
            }

            if (!empty($validated['no-hp-siswa'])) {
                $CalSis->nhp_siswa = $validated['no-hp-siswa'];
            }

            if (!empty($validated['nama-siswa'])) {
                $CalSis->nama = $validated['nama-siswa'];
            }

            // if (!empty($validated['nisn-siswa'])) {
            //     $CalSis->nama = $validated['nisn-siswa'];
            // }

            $CalSis->save();
        }

        $data = [
            'siswa_id' => auth()->user()->id,
            'provinsi_id' => $validated['provinsi-siswa'],
            'jenis_kelamin' => $validated['jenis-kelamin-siswa'],
            'kabupaten_id' => $validated['kabupaten-siswa'],
            'kecamatan_id' => $validated['kecamatan-siswa'],
            'tempat_lahir' => $validated['tempat-lahir-siswa'],
            'desa_kelurahan_id' => $validated['desa-kelurahan-siswa'],
            'tgl_lahir' => $validated['tanggal-lahir-siswa'],
            'kode_pos' => $validated['kode-pos-siswa'],
            'agama' => $validated['agama-siswa'],
            'asal_sekolah' => $validated['asal-sekolah-siswa'],
            'alamat' => $validated['alamat-siswa'],
            'nama_ayah' => $validated['nama-ayah-siswa'],
            'pend_terakhir_ayah' => $validated['pendidikan-terakhir-ayah'],
            'pekerjaan_ayah' => $validated['pekerjaan-ayah'],
            'penghasilan_ayah' => $validated['penghasilan-ayah'],
            'nhp_ayah' => $validated['no-hp-ayah'],
            'nama_ibu' => $validated['nama-ibu-siswa'],
            'pend_terakhir_ibu' => $validated['pendidikan-terakhir-ibu'],
            'pekerjaan_ibu' => $validated['pekerjaan-ibu'],
            'penghasilan_ibu' => $validated['penghasilan-ibu'],
            'nhp_ibu' => $validated['no-hp-ibu'],
            'info_pendaftaran' => implode(',', $validated['info-pendaftaran'])
        ];

        $today = Carbon::now()->setTimezone('Asia/Jakarta')->format('YmdHis');
        $slugName = Str::slug(Str::lower($CalSis->nama), '-');
        $nisn = $CalSis->nisn;

        $berkasList = [
            'fileft_siswa' => 'file-ft-siswa',
            'filefc_akte' => 'file-akte',
            'filefc_kk' => 'file-kk',
            'filefc_skhu' => 'file-skhu',
            'filefc_skm' => 'file-skm',
        ];

        // ✨ 1. Rename file lama jika nama siswa berubah
        if ($namaLama !== $validated['nama-siswa']) {
            foreach ($berkasList as $fieldDb => $inputName) {
                $oldPath = $CalSis->detailSiswa?->$fieldDb;

                if (!empty($oldPath) && Storage::disk('berkas')->exists($oldPath)) {
                    $ext = pathinfo($oldPath, PATHINFO_EXTENSION);
                    $newFilename = "{$inputName}-{$nisn}-{$slugName}-{$today}.{$ext}";
                    $newPath = "siswa/{$nisn}/{$newFilename}";

                    Storage::disk('berkas')->move($oldPath, $newPath);
                    $data[$fieldDb] = $newPath;
                }
            }
        }

        // ✨ 2. Jika ada file baru di-upload, hapus file lama dan simpan yang baru
        foreach ($berkasList as $fieldDb => $inputName) {
            if ($request->hasFile($inputName)) {
                // Hapus file lama jika ada
                $old = $CalSis->detailSiswa?->$fieldDb;
                if (!empty($old) && Storage::disk('berkas')->exists($old)) {
                    Storage::disk('berkas')->delete($old);
                }
                // Simpan file baru
                $ext = $request->file($inputName)->getClientOriginalExtension();
                $newFilename = "{$inputName}-{$nisn}-{$slugName}-{$today}.{$ext}";
                $path = $request->file($inputName)->storeAs("siswa/{$nisn}", $newFilename, 'berkas');
                $data[$fieldDb] = $path;
            }
        }
        DetailSiswa::updateOrCreate(['siswa_id' => auth()->user()->id], $data);
        return redirect()->route('siswa.dashboard')->with(['message' => 'sukses menyimpan data.', 'isActive' => true, 'hasError' => false]);
    }
}