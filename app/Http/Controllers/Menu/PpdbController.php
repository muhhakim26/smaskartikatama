<?php

namespace App\Http\Controllers\Menu;

use App\Exports\SiswaExport;
use App\Http\Controllers\Controller;
use App\Models\Area\District;
use App\Models\Area\Province;
use App\Models\Area\Regency;
use App\Models\Area\Village;
use App\Models\ProgresSiswa;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class PpdbController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $model = Siswa::with('detailSiswa');
            if ($request->has('order') && !empty($request->input('order'))) {
                $order = $request->input('order')[0];
                $columnIndex = $order['column'];
                $columnName = $request->input('columns')[$columnIndex]['data'];
                $columnDirection = $order['dir'];
                $model->orderBy($columnName, $columnDirection);
            } else {
                $model->latest();
            }
            return DataTables::eloquent($model)
                ->addIndexColumn()
                ->editColumn('detail_siswa', function ($row) {
                    if (empty($row->detailSiswa->siswa_id)) {
                        return '<span class="badge text-sm fw-semibold bg-danger-600 px-20 py-9 radius-4 text-white">belum dilengkapi</span>';
                    }
                    if ($row->detailSiswa->status_siswa == 'diverifikasi') {
                        return '<span class="badge text-sm fw-semibold bg-warning-600 px-20 py-9 radius-4 text-white">' . $row->detailSiswa->status_siswa . '</span>';
                    }
                    if ($row->detailSiswa->status_siswa == 'diterima') {
                        return '<span class="badge text-sm fw-semibold bg-success-600 px-20 py-9 radius-4 text-white">' . $row->detailSiswa->status_siswa . '</span>';
                    }
                })
                ->addColumn('status_terima', function ($row) {
                    if (empty($row->detailSiswa->siswa_id)) {
                        return '-';
                    }

                    if ($row->detailSiswa->status_siswa == 'diterima') {
                        return '';
                    }

                    if ($row->detailSiswa->status_siswa == 'diverifikasi') {
                        return '<a class="w-32-px h-32-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center" onclick="terima(\'' . $row->id . '\')" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="tooltip-success" data-bs-title="Terima Siswa"> <iconify-icon icon="mdi:check-circle-outline"></iconify-icon> </a>';
                    }
                })
                ->addColumn('action', function ($row) {
                    if (empty($row->detailSiswa->siswa_id)) {
                        return '-';
                    }
                    return '<a class="w-32-px h-32-px bg-primary-light text-primary-600 rounded-circle d-inline-flex align-items-center justify-content-center" href="' . route('kelola-ppdb.show', $row->id) . '"> <iconify-icon icon="iconamoon:eye-light"></iconify-icon> </a> <a class="w-32-px h-32-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center" href="' . route('kelola-ppdb.edit', $row->id) . '"> <iconify-icon icon="lucide:edit"></iconify-icon> </a>';
                })
                ->rawColumns(['detail_siswa', 'status_terima', 'action'])
                ->removeColumn('id')
                ->toJson(true);
        }

        return view('menu/ppdb/list');
    }

    /** Show the form for creating a new resource. */
    // public function create()
    // {
    //     $Provinsi = Province::all();
    //     return view('menu/ppdb/create', compact('Provinsi'));
    // }

    /** Store a newly created resource in storage. */
    // public function store(Request $request)
    // {
    //     $rules = [
    //         'nama-siswa' => 'required|string|max:255',
    //         'provinsi-siswa' => 'required|integer',
    //         'jenis-kelamin-siswa' => 'required|string|in:laki-laki,perempuan',
    //         'kabupaten-siswa' => 'required|integer',
    //         'nisn-siswa' => 'required|digits:10|unique:tb_ppdb,nisn',
    //         'kecamatan-siswa' => 'required|integer',
    //         'tempat-lahir-siswa' => 'required|string|max:255',
    //         'desa-kelurahan-siswa' => 'required|integer',
    //         'tanggal-lahir-siswa' => 'required|date',
    //         'kode-pos-siswa' => 'required|digits:5',
    //         'agama-siswa' => 'required|string|in:buddha,hindu,islam,kristen_katolik,khonghucu,kristen_protestan',
    //         'email-siswa' => 'required|string|email:rfc,dns|unique:tb_ppdb,email',
    //         'asal-sekolah-siswa' => 'required|string|max:255',
    //         'no-hp-siswa' => ['required', 'regex:/\+?([ -]?\d+)+|\(\d+\)([ -]\d+)/'],
    //         'alamat-siswa' => 'required|string|max:16777215',
    //         'nama-ayah-siswa' => 'required|string|max:255',
    //         'pendikian-terakhir-ayah' => 'required|string|max:255',
    //         'pekerjaan-ayah' => 'required|string|max:255',
    //         'penghasilan-ayah' => 'required|numeric|gt:0|max:9999999999',
    //         'no-hp-ayah' => ['required', 'regex:/\+?([ -]?\d+)+|\(\d+\)([ -]\d+)/'],
    //         'nama-ibu-siswa' => 'required|string|max:255',
    //         'pendikian-terakhir-ibu' => 'required|string|max:255',
    //         'pekerjaan-ibu' => 'required|string|max:255',
    //         'penghasilan-ibu' => 'required|numeric|gt:0|max:9999999999',
    //         'no-hp-ibu' => ['required', 'regex:/\+?([ -]?\d+)+|\(\d+\)([ -]\d+)/'],
    //         'file-ft-siswa' => 'required|image|mimes:jpeg,jpg,png|max:3072',
    //         'file-akte' => 'required|image|mimes:jpeg,jpg,png|max:3072',
    //         'file-kk' => 'required|image|mimes:jpeg,jpg,png|max:3072',
    //         'file-skhu' => 'required|image|mimes:jpeg,jpg,png|max:3072',
    //         'file-skm' => 'required|image|mimes:jpeg,jpg,png|max:3072',
    //     ];
    //     $validator = Validator::make($request->all(), $rules);
    //     if ($validator->fails()) {
    //         return back()->with(['message' => 'gagal menambahkan data.', 'isActive' => false, 'hasError' => true])->withErrors($validator)->withInput();
    //     }
    //     $validator = $validator->validated();
    //     $getPPDB = Ppdb::latest()->first();
    //     $kodeSekolah = 'SKT';
    //     $kodeTahun = date('Y');
    //     $kodeBulan = date('m');
    //     $kodeHari = date('d');
    //     if ($getPPDB == null) {
    //         $nomorUrut = '0001';
    //     } else {
    //         $explode = explode('-', $getPPDB->id_pendaftaran);
    //         $nomorUrut = intval($explode[4]) + 1;
    //         $nomorUrut = str_pad($nomorUrut, 4, '0', STR_PAD_LEFT);
    //     }
    //     $data = [
    //         'id_pendaftaran' => "$kodeSekolah-$kodeTahun-$kodeBulan-$kodeHari-$nomorUrut",
    //         'nama' => $validator['nama-siswa'],
    //         'provinsi_id' => $validator['provinsi-siswa'],
    //         'jenis_kelamin' => $validator['jenis-kelamin-siswa'],
    //         'kabupaten_id' => $validator['kabupaten-siswa'],
    //         'nisn' => $validator['nisn-siswa'],
    //         'kecamatan_id' => $validator['kecamatan-siswa'],
    //         'tempat_lahir' => $validator['tempat-lahir-siswa'],
    //         'desa_kelurahan_id' => $validator['desa-kelurahan-siswa'],
    //         'tgl_lahir' => $validator['tanggal-lahir-siswa'],
    //         'kode_pos' => $validator['kode-pos-siswa'],
    //         'agama' => $validator['agama-siswa'],
    //         'email' => $validator['email-siswa'],
    //         'asal_sekolah' => $validator['asal-sekolah-siswa'],
    //         'nhp_siswa' => $validator['no-hp-siswa'],
    //         'alamat' => $validator['alamat-siswa'],
    //         'nama_ayah' => $validator['nama-ayah-siswa'],
    //         'pend_terakhir_ayah' => $validator['pendikian-terakhir-ayah'],
    //         'pekerjaan_ayah' => $validator['pekerjaan-ayah'],
    //         'penghasilan_ayah' => $validator['penghasilan-ayah'],
    //         'nhp_ayah' => $validator['no-hp-ayah'],
    //         'nama_ibu' => $validator['nama-ibu-siswa'],
    //         'pend_terakhir_ibu' => $validator['pendikian-terakhir-ibu'],
    //         'pekerjaan_ibu' => $validator['pekerjaan-ibu'],
    //         'penghasilan_ibu' => $validator['penghasilan-ibu'],
    //         'nhp_ibu' => $validator['no-hp-ibu'],
    //     ];

    //     $today = Carbon::now()->setTimezone('Asia/Jakarta')->format('YmdHis');
    //     $converted = Str::lower($validator['nama-siswa']);
    //     $converted = Str::slug($converted, '-');
    //     $nisn = (int) $validator['nisn-siswa'];

    //     if ($request->hasFile('file-ft-siswa') && $request->hasFile('file-akte') && $request->hasFile('file-kk') && $request->hasFile('file-skhu') && $request->hasFile('file-skm')) {
    //         $fileInputs = ['file-ft-siswa', 'file-akte', 'file-kk', 'file-skhu', 'file-skm'];
    //         $attribute = ['fileft_siswa', 'filefc_akte', 'filefc_kk', 'filefc_skhu', 'filefc_skm'];

    //         foreach ($fileInputs as $index => $value) {
    //             $ext = $request->file($value)->getClientOriginalExtension();
    //             $foto = $request->file($value)->storeAs('siswa/' . $nisn, $value . '-' . $nisn . '-' . $converted . '-' . $today . '.' . $ext, 'berkas');
    //             $data[$attribute[$index]] = $foto;
    //         }
    //     }
    //     Ppdb::create($data);
    //     return redirect()->route('home')->with(['message' => 'sukses menambahkan data.', 'isActive' => true, 'hasError' => false]);
    // }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $CalSis = Siswa::with('detailSiswa')->findOrFail($id);
        return view('menu/ppdb/show', compact('CalSis'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $CalSis = Siswa::with(['detailSiswa'])->findOrFail($id);
        $Provinsi = Province::all();
        $Kabupaten = Regency::where('province_code', $CalSis->detailSiswa->provinsi->code)->pluck('name', 'id');
        $Kecamatan = District::where('regency_code', $CalSis->detailSiswa->kabupaten->code)->pluck('name', 'id');
        $Kelurahan = Village::where('district_code', $CalSis->detailSiswa->kecamatan->code)->pluck('name', 'id');
        $vars = [
            'CalSis',
            'Provinsi',
            'Kabupaten',
            'Kecamatan',
            'Kelurahan',
        ];
        return view('menu/ppdb/edit', compact($vars));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $CalSis = Siswa::with('detailSiswa')->findOrFail($id);

        $rules = [
            // 'nomor-pendaftaran-siswa' => 'required|string|max:255',
            'email-siswa' => 'required|string|email:rfc,dns|unique:siswa,email,' . $id,
            'nama-siswa' => 'required|string|max:255',
            'no-hp-siswa' => ['required', 'regex:/\+?([ -]?\d+)+|\(\d+\)([ -]\d+)/'],
            'nisn-siswa' => 'required|digits_between:10,12|unique:siswa,nisn,' . $id,
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

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $with = ['message' => 'gagal mengubah data.', 'isActive' => false, 'hasError' => true];
            $provinceId = $request->input('provinsi-siswa');
            $kabupatenId = $request->input('kabupaten-siswa');
            $kecamatanId = $request->input('kecamatan-siswa');
            $Kabupaten = Province::with('regencies')->find($provinceId);
            $Kecamatan = Regency::with('districts')->find($kabupatenId);
            $Kelurahan = District::with('villages')->find($kecamatanId);
            $with['Kabupaten'] = $Kabupaten->regencies->pluck('name', 'id');
            $with['Kecamatan'] = $Kecamatan->districts->pluck('name', 'id');
            $with['Kelurahan'] = $Kelurahan->villages->pluck('name', 'id');
            return back()->with($with)->withErrors($validator)->withInput();
        }

        $validated = $validator->validated();

        $namaLama = $CalSis->nama;
        $nhpSiswaLama = $CalSis->nhp_siswa;
        $emailLama = $CalSis->email;
        $nisnLama = $CalSis->nisn;
        if ($namaLama !== $validated['nama-siswa'] || $nhpSiswaLama !== $validated['no-hp-siswa'] || $emailLama !== $validated['email-siswa'] || $nisnLama !== $validated['nisn-siswa']) {
            if ($namaLama !== $validated['nama-siswa']) {
                $CalSis->nama = $validated['nama-siswa'];
            }
            if ($nhpSiswaLama !== $validated['no-hp-siswa']) {
                $CalSis->nhp_siswa = $validated['no-hp-siswa'];
            }
            if ($emailLama !== $validated['email-siswa']) {
                $CalSis->email = $validated['email-siswa'];
            }

            if ($nisnLama !== $validated['nisn-siswa']) {
                $CalSis->nisn = $validated['nisn-siswa'];
            }
            $CalSis->save();
        }

        $data = [
            'siswa_id' => $CalSis->detailSiswa->siswa_id,
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

        // ✨ 1. Rename file lama jika nama atau nisn siswa berubah
        if ($namaLama !== $validated['nama-siswa'] || $nisnLama !== $validated['nisn-siswa']) {
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

        $CalSis->detailSiswa->update($data);

        return redirect()->route('kelola-ppdb.index')->with(['message' => 'sukses mengubah data.', 'isActive' => true, 'hasError' => false]);
    }

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy(string $id)
    // {
    //     $PPDB = Ppdb::findOrFail($id);
    //     if (!empty($PPDB->fileft_siswa) && !empty($PPDB->filefc_akte) && !empty($PPDB->filefc_kk) && !empty($PPDB->filefc_skhu) && !empty($PPDB->filefc_skm)) {
    //         Storage::disk('berkas')->delete([$PPDB->fileft_siswa, $PPDB->filefc_akte, $PPDB->filefc_kk, $PPDB->filefc_skhu, $PPDB->filefc_skm]);
    //         Storage::disk('berkas')->deleteDirectory('siswa/' . $PPDB->nisn);
    //     }
    //     $PPDB->delete();
    //     return redirect()->route('kelola-ppdb.index')->with('message', 'sukses menghapus data.');
    // }
    public function terimaSiswa(string $id)
    {
        $Siswa = Siswa::with('detailSiswa')->find($id);
        $ProSis = ProgresSiswa::where('siswa_id', $id)->update(['step_4' => true]);
        $Siswa->detailSiswa->update(['status_siswa' => 'diterima']);
        return response()->json(['success' => true, 'data' => $Siswa]);
    }

    public function tolakSiswa(string $id)
    {
        $Siswa = Siswa::with('detailSiswa')->find($id);
        $ProSis = ProgresSiswa::where('siswa_id', $id)->update(['step_4' => true]);
        $Siswa->detailSiswa->update(['status_siswa' => 'ditolak']);
        return response()->json(['success' => true, 'data' => $Siswa]);
    }

    public function terimaBerkas(string $berkas, string $id)
    {
        $CalSis = Siswa::with('detailSiswa')->findOrFail($id);
        $with = ['message'];
        if ($berkas === 'foto_siswa') {
            $file = ['status_fileft_siswa' => 'diterima'];
            $with['message'] = 'file foto diterima';
        }

        if ($berkas === 'file_akte') {
            $file = ['status_filefc_akte' => 'diterima'];
            $with['message'] = 'file akte diterima';
        }

        if ($berkas === 'file_kk') {
            $file = ['status_filefc_kk' => 'diterima'];
            $with['message'] = 'file kk diterima';
        }

        if ($berkas === 'file_skhu') {
            $file = ['status_filefc_skhu' => 'diterima'];
            $with['message'] = 'file skhu diterima';
        }

        if ($berkas === 'file_skm') {
            $file = ['status_filefc_skm' => 'diterima'];
            $with['message'] = 'file skm diterima';
        }
        $CalSis->detailSiswa->update($file);
        if ($CalSis->detailSiswa->status_fileft_siswa === 'diterima' && $CalSis->detailSiswa->status_filefc_akte === 'diterima' && $CalSis->detailSiswa->status_filefc_kk === 'diterima' && $CalSis->detailSiswa->status_filefc_skhu === 'diterima') {
            $CalSis->detailSiswa->update(['status_berkas' => 'diterima']);
            ProgresSiswa::where('siswa_id', $id)->update(['step_3' => true]);
        }

        return back()->with($with);
    }

    public function tolakBerkas(Request $request, string $berkas, string $id)
    {
        $CalSis = Siswa::with('detailSiswa')->findOrFail($id);
        $file = [];
        $with = ['status' => 'error', 'message'];
        if ($berkas === 'foto_siswa') {
            $file['status_fileft_siswa'] = 'ditolak';
            $file['catatan_fileft_siswa'] = $request->input('alasan_penolakan');
            $with['message'] = 'file foto ditolak';
        }

        if ($berkas === 'file_akte') {
            $file['status_filefc_akte'] = 'ditolak';
            $file['catatan_filefc_akte'] = $request->input('alasan_penolakan');
            $with['message'] = 'file akte ditolak';
        }

        if ($berkas === 'file_kk') {
            $file['status_filefc_kk'] = 'ditolak';
            $file['catatan_filefc_kk'] = $request->input('alasan_penolakan');
            $with['message'] = 'file kk ditolak';
        }

        if ($berkas === 'file_skhu') {
            $file['status_filefc_skhu'] = 'ditolak';
            $file['catatan_filefc_skhu'] = $request->input('alasan_penolakan');
            $with['message'] = 'file skhu ditolak';
        }

        if ($berkas === 'file_skm') {
            $file['status_filefc_skm'] = 'ditolak';
            $file['catatan_filefc_skm'] = $request->input('alasan_penolakan');
            $with['message'] = 'file skm ditolak';
        }
        $CalSis->detailSiswa->update($file);
        if ($CalSis->detailSiswa->status_fileft_siswa === 'ditolak' || $CalSis->detailSiswa->status_filefc_akte === 'ditolak' || $CalSis->detailSiswa->status_filefc_kk === 'ditolak' || $CalSis->detailSiswa->status_filefc_skhu === 'ditolak') {
            $CalSis->detailSiswa->update(['status_berkas' => 'ditolak']);
            ProgresSiswa::where('siswa_id', $id)->update(['step_1' => false, 'step_2' => false, 'step_3' => false]);
        }

        return back()->with($with);
    }

    public function excel()
    {
        $fileName = Carbon::now()->setTimezone('Asia/Jakarta')->format('d-m-Y_H.i.s');
        return Excel::download(new SiswaExport, 'DataCalonSiswa_' . $fileName . '.xlsx');
    }
}