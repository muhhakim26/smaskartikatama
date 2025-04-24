<?php

namespace App\Http\Controllers\Menu;

use App\Http\Controllers\Controller;
use App\Models\Area\District;
use App\Models\Area\Province;
use App\Models\Area\Regency;
use App\Models\Area\Village;
use App\Models\Ppdb;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class PpdbController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $model = Ppdb::query()->select('*');
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
                ->addColumn('action', function ($row) {
                    return '<a class="w-32-px h-32-px bg-primary-light text-primary-600 rounded-circle d-inline-flex align-items-center justify-content-center" href="' . route('kelola-ppdb.show', $row->id) . '"> <iconify-icon icon="iconamoon:eye-light"></iconify-icon> </a> <a class="w-32-px h-32-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center" href="' . route('kelola-ppdb.edit', $row->id) . '"> <iconify-icon icon="lucide:edit"></iconify-icon> </a> <a class="w-32-px h-32-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center" style="cursor:pointer" onclick="hapus(\'' . $row->id . '\')"> <iconify-icon icon="mingcute:delete-2-line"></iconify-icon> </a>';
                })
                ->rawColumns(['action'])
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

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'nama-siswa' => 'required|string|max:255',
            'provinsi-siswa' => 'required|integer',
            'jenis-kelamin-siswa' => 'required|string|in:laki-laki,perempuan',
            'kabupaten-siswa' => 'required|integer',
            'nisn-siswa' => 'required|digits:10|unique:tb_ppdb,nisn',
            'kecamatan-siswa' => 'required|integer',
            'tempat-lahir-siswa' => 'required|string|max:255',
            'desa-kelurahan-siswa' => 'required|integer',
            'tanggal-lahir-siswa' => 'required|date',
            'kode-pos-siswa' => 'required|digits:5',
            'agama-siswa' => 'required|string|in:buddha,hindu,islam,katolik,khonghucu,kristen',
            'email-siswa' => 'required|string|email:rfc,dns|unique:tb_ppdb,email',
            'asal-sekolah-siswa' => 'required|string|max:255',
            'no-hp-siswa' => ['required', 'regex:/\+?([ -]?\d+)+|\(\d+\)([ -]\d+)/'],
            'alamat-siswa' => 'required|string|max:16777215',
            'nama-ayah-siswa' => 'required|string|max:255',
            'pendikian-terakhir-ayah' => 'required|string|max:255',
            'pekerjaan-ayah' => 'required|string|max:255',
            'penghasilan-ayah' => 'required|numeric|gt:0|max:9999999999',
            'no-hp-ayah' => ['required', 'regex:/\+?([ -]?\d+)+|\(\d+\)([ -]\d+)/'],
            'nama-ibu-siswa' => 'required|string|max:255',
            'pendikian-terakhir-ibu' => 'required|string|max:255',
            'pekerjaan-ibu' => 'required|string|max:255',
            'penghasilan-ibu' => 'required|numeric|gt:0|max:9999999999',
            'no-hp-ibu' => ['required', 'regex:/\+?([ -]?\d+)+|\(\d+\)([ -]\d+)/'],
            'file-ft-siswa' => 'required|image|mimes:jpeg,jpg,png|max:3072',
            'file-akte' => 'required|image|mimes:jpeg,jpg,png|max:3072',
            'file-kk' => 'required|image|mimes:jpeg,jpg,png|max:3072',
            'file-skhu' => 'required|image|mimes:jpeg,jpg,png|max:3072',
            'file-skm' => 'required|image|mimes:jpeg,jpg,png|max:3072',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return back()->with(['message' => 'gagal menambahkan data.', 'isActive' => false, 'hasError' => true])->withErrors($validator)->withInput();
        }
        $validator = $validator->validated();
        $getPPDB = Ppdb::latest()->first();
        $kodeSekolah = 'SKT';
        $kodeTahun = date('Y');
        $kodeBulan = date('m');
        $kodeHari = date('d');
        if ($getPPDB == null) {
            $nomorUrut = '0001';
        } else {
            $explode = explode('-', $getPPDB->id_pendaftaran);
            $nomorUrut = intval($explode[4]) + 1;
            $nomorUrut = str_pad($nomorUrut, 4, '0', STR_PAD_LEFT);
        }
        $data = [
            'id_pendaftaran' => "$kodeSekolah-$kodeTahun-$kodeBulan-$kodeHari-$nomorUrut",
            'nama' => $validator['nama-siswa'],
            'provinsi_id' => $validator['provinsi-siswa'],
            'jenis_kelamin' => $validator['jenis-kelamin-siswa'],
            'kabupaten_id' => $validator['kabupaten-siswa'],
            'nisn' => $validator['nisn-siswa'],
            'kecamatan_id' => $validator['kecamatan-siswa'],
            'tempat_lahir' => $validator['tempat-lahir-siswa'],
            'desa_kelurahan_id' => $validator['desa-kelurahan-siswa'],
            'tgl_lahir' => $validator['tanggal-lahir-siswa'],
            'kode_pos' => $validator['kode-pos-siswa'],
            'agama' => $validator['agama-siswa'],
            'email' => $validator['email-siswa'],
            'asal_sekolah' => $validator['asal-sekolah-siswa'],
            'nhp_siswa' => $validator['no-hp-siswa'],
            'alamat' => $validator['alamat-siswa'],
            'nama_ayah' => $validator['nama-ayah-siswa'],
            'pend_terakhir_ayah' => $validator['pendikian-terakhir-ayah'],
            'pekerjaan_ayah' => $validator['pekerjaan-ayah'],
            'penghasilan_ayah' => $validator['penghasilan-ayah'],
            'nhp_ayah' => $validator['no-hp-ayah'],
            'nama_ibu' => $validator['nama-ibu-siswa'],
            'pend_terakhir_ibu' => $validator['pendikian-terakhir-ibu'],
            'pekerjaan_ibu' => $validator['pekerjaan-ibu'],
            'penghasilan_ibu' => $validator['penghasilan-ibu'],
            'nhp_ibu' => $validator['no-hp-ibu'],
        ];

        $today = Carbon::now()->setTimezone('Asia/Jakarta')->format('YmdHis');
        $converted = Str::lower($validator['nama-siswa']);
        $converted = Str::slug($converted, '-');
        $nisn = (int) $validator['nisn-siswa'];

        if ($request->hasFile('file-ft-siswa') && $request->hasFile('file-akte') && $request->hasFile('file-kk') && $request->hasFile('file-skhu') && $request->hasFile('file-skm')) {
            $fileInputs = ['file-ft-siswa', 'file-akte', 'file-kk', 'file-skhu', 'file-skm'];
            $attribute = ['fileft_siswa', 'filefc_akte', 'filefc_kk', 'filefc_skhu', 'filefc_skm'];

            foreach ($fileInputs as $index => $value) {
                $ext = $request->file($value)->getClientOriginalExtension();
                $foto = $request->file($value)->storeAs('siswa/' . $nisn, $value . '-' . $nisn . '-' . $converted . '-' . $today . '.' . $ext, 'berkas');
                $data[$attribute[$index]] = $foto;
            }
        }
        Ppdb::create($data);
        return redirect()->route('kelola-ppdb.create')->with(['message' => 'sukses menambahkan data.', 'isActive' => true, 'hasError' => false]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $PPDB = Ppdb::with(['provinsi', 'kabupaten', 'kecamatan', 'kelurahan'])->findOrFail($id);
        return view('menu/ppdb/show', compact('PPDB'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $PPDB = Ppdb::with(['provinsi', 'kabupaten', 'kecamatan', 'kelurahan'])->findOrFail($id);
        $Provinsi = Province::all();
        $Kabupaten = Regency::where('province_code', $PPDB->provinsi->code)->pluck('name', 'id');
        $Kecamatan = District::where('regency_code', $PPDB->kabupaten->code)->pluck('name', 'id');
        $Kelurahan = Village::where('district_code', $PPDB->kecamatan->code)->pluck('name', 'id');
        $data = [
            'PPDB',
            'Provinsi',
            'Kabupaten',
            'Kecamatan',
            'Kelurahan',
        ];
        return view('menu/ppdb/edit', compact($data));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $rules = [
            'nama-siswa' => 'required|string|max:255',
            'provinsi-siswa' => 'required|integer',
            'jenis-kelamin-siswa' => 'required|string|in:laki-laki,perempuan',
            'kabupaten-siswa' => 'required|integer',
            'nisn-siswa' => 'required|digits:10|unique:tb_ppdb,nisn,' . $id,
            'kecamatan-siswa' => 'required|integer',
            'tempat-lahir-siswa' => 'required|string|max:255',
            'desa-kelurahan-siswa' => 'required|integer',
            'tanggal-lahir-siswa' => 'required|date',
            'kode-pos-siswa' => 'required|digits:5',
            'agama-siswa' => 'required|string|in:buddha,hindu,islam,katolik,khonghucu,kristen',
            'email-siswa' => 'required|string|email:rfc,dns|unique:tb_ppdb,email,' . $id,
            'asal-sekolah-siswa' => 'required|string|max:255',
            'no-hp-siswa' => ['required', 'regex:/\+?([ -]?\d+)+|\(\d+\)([ -]\d+)/'],
            'alamat-siswa' => 'required|string|max:16777215',
            'nama-ayah-siswa' => 'required|string|max:255',
            'pendikian-terakhir-ayah' => 'required|string|max:255',
            'pekerjaan-ayah' => 'required|string|max:255',
            'penghasilan-ayah' => 'required|numeric|gt:0|max:9999999999',
            'no-hp-ayah' => ['required', 'regex:/\+?([ -]?\d+)+|\(\d+\)([ -]\d+)/'],
            'nama-ibu-siswa' => 'required|string|max:255',
            'pendikian-terakhir-ibu' => 'required|string|max:255',
            'pekerjaan-ibu' => 'required|string|max:255',
            'penghasilan-ibu' => 'required|numeric|gt:0|max:9999999999',
            'no-hp-ibu' => ['required', 'regex:/\+?([ -]?\d+)+|\(\d+\)([ -]\d+)/'],
            'file-ft-siswa' => 'nullable|image|mimes:jpeg,jpg,png|max:3072',
            'file-akte' => 'nullable|image|mimes:jpeg,jpg,png|max:3072',
            'file-kk' => 'nullable|image|mimes:jpeg,jpg,png|max:3072',
            'file-skhu' => 'nullable|image|mimes:jpeg,jpg,png|max:3072',
            'file-skm' => 'nullable|image|mimes:jpeg,jpg,png|max:3072',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return back()->with(['message' => 'gagal mengubah data.', 'isActive' => false, 'hasError' => true])->withErrors($validator)->withInput();
        }
        $validator = $validator->validated();

        $data = [
            'nama' => $validator['nama-siswa'],
            'provinsi_id' => $validator['provinsi-siswa'],
            'jenis_kelamin' => $validator['jenis-kelamin-siswa'],
            'kabupaten_id' => $validator['kabupaten-siswa'],
            'nisn' => $validator['nisn-siswa'],
            'kecamatan_id' => $validator['kecamatan-siswa'],
            'tempat_lahir' => $validator['tempat-lahir-siswa'],
            'desa_kelurahan_id' => $validator['desa-kelurahan-siswa'],
            'tgl_lahir' => $validator['tanggal-lahir-siswa'],
            'kode_pos' => $validator['kode-pos-siswa'],
            'agama' => $validator['agama-siswa'],
            'email' => $validator['email-siswa'],
            'asal_sekolah' => $validator['asal-sekolah-siswa'],
            'nhp_siswa' => $validator['no-hp-siswa'],
            'alamat' => $validator['alamat-siswa'],
            'nama_ayah' => $validator['nama-ayah-siswa'],
            'pend_terakhir_ayah' => $validator['pendikian-terakhir-ayah'],
            'pekerjaan_ayah' => $validator['pekerjaan-ayah'],
            'penghasilan_ayah' => $validator['penghasilan-ayah'],
            'nhp_ayah' => $validator['no-hp-ayah'],
            'nama_ibu' => $validator['nama-ibu-siswa'],
            'pend_terakhir_ibu' => $validator['pendikian-terakhir-ibu'],
            'pekerjaan_ibu' => $validator['pekerjaan-ibu'],
            'penghasilan_ibu' => $validator['penghasilan-ibu'],
            'nhp_ibu' => $validator['no-hp-ibu'],
        ];

        $today = Carbon::now()->setTimezone('Asia/Jakarta')->format('YmdHis');
        $converted = Str::lower($validator['nama-siswa']);
        $converted = Str::slug($converted, '-');
        $nisn = (int) $validator['nisn-siswa'];
        $getSiwaPPDBData = Ppdb::where('id', $id)->first();
        if ($request->hasFile('file-ft-siswa')) {
            if (Storage::disk('berkas')->exists($getSiwaPPDBData->fileft_siswa)) {
                Storage::disk('berkas')->delete($getSiwaPPDBData->fileft_siswa);
            }
            $ext = $request->file('file-ft-siswa')->getClientOriginalExtension();
            $foto = $request->file('file-ft-siswa')->storeAs('siswa/' . $nisn, 'file-ft-siswa' . '-' . $nisn . '-' . $converted . '-' . $today . '.' . $ext, 'berkas');
            $data['fileft_siswa'] = $foto;
        }
        if ($request->hasFile('file-akte')) {
            if (Storage::disk('berkas')->exists($getSiwaPPDBData->filefc_akte)) {
                Storage::disk('berkas')->delete($getSiwaPPDBData->filefc_akte);
            }
            $ext = $request->file('file-akte')->getClientOriginalExtension();
            $foto = $request->file('file-akte')->storeAs('siswa/' . $nisn, 'file-akte' . '-' . $nisn . '-' . $converted . '-' . $today . '.' . $ext, 'berkas');
            $data['filefc_akte'] = $foto;
        }
        if ($request->hasFile('file-kk')) {
            if (Storage::disk('berkas')->exists($getSiwaPPDBData->filefc_kk)) {
                Storage::disk('berkas')->delete($getSiwaPPDBData->filefc_kk);
            }
            $ext = $request->file('file-kk')->getClientOriginalExtension();
            $foto = $request->file('file-kk')->storeAs('siswa/' . $nisn, 'file-kk' . '-' . $nisn . '-' . $converted . '-' . $today . '.' . $ext, 'berkas');
            $data['filefc_kk'] = $foto;
        }
        if ($request->hasFile('file-skhu')) {
            if (Storage::disk('berkas')->exists($getSiwaPPDBData->filefc_skhu)) {
                Storage::disk('berkas')->delete($getSiwaPPDBData->filefc_skhu);
            }
            $ext = $request->file('file-skhu')->getClientOriginalExtension();
            $foto = $request->file('file-skhu')->storeAs('siswa/' . $nisn, 'file-skhu' . '-' . $nisn . '-' . $converted . '-' . $today . '.' . $ext, 'berkas');
            $data['filefc_skhu'] = $foto;
        }
        if ($request->hasFile('file-skm')) {
            if (Storage::disk('berkas')->exists($getSiwaPPDBData->filefc_skm)) {
                Storage::disk('berkas')->delete($getSiwaPPDBData->filefc_skm);
            }
            $ext = $request->file('file-skm')->getClientOriginalExtension();
            $foto = $request->file('file-skm')->storeAs('siswa/' . $nisn, 'file-skm' . '-' . $nisn . '-' . $converted . '-' . $today . '.' . $ext, 'berkas');
            $data['filefc_skm'] = $foto;
        }

        $getSiwaPPDBData->update($data);

        return redirect()->route('kelola-ppdb.index')->with(['message' => 'sukses mengubah data.', 'isActive' => true, 'hasError' => false]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $PPDB = Ppdb::findOrFail($id);
        if (!empty($PPDB->fileft_siswa) && !empty($PPDB->filefc_akte) && !empty($PPDB->filefc_kk) && !empty($PPDB->filefc_skhu) && !empty($PPDB->filefc_skm)) {
            Storage::disk('berkas')->delete([$PPDB->fileft_siswa, $PPDB->filefc_akte, $PPDB->filefc_kk, $PPDB->filefc_skhu, $PPDB->filefc_skm]);
            Storage::disk('berkas')->deleteDirectory('siswa/' . $PPDB->nisn);
        }
        $PPDB->delete();
        return redirect()->route('kelola-ppdb.index')->with('message', 'sukses menghapus data.');
    }
}
