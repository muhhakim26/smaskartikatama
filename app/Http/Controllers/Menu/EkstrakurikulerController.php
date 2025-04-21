<?php

namespace App\Http\Controllers\Menu;

use App\Http\Controllers\Controller;
use App\Models\Ekstrakurikuler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class EkstrakurikulerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $model = Ekstrakurikuler::query()->select('nama', 'id');
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
                    return '<a class="w-32-px h-32-px bg-primary-light text-primary-600 rounded-circle d-inline-flex align-items-center justify-content-center" href="' . route('kelola-ekstrakurikuler.show', $row->id) . '"> <iconify-icon icon="iconamoon:eye-light"></iconify-icon> </a> <a class="w-32-px h-32-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center" href="' . route('kelola-ekstrakurikuler.edit', $row->id) . '"> <iconify-icon icon="lucide:edit"></iconify-icon> </a> <a class="w-32-px h-32-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center" style="cursor:pointer" onclick="hapus(\'' . $row->id . '\')"> <iconify-icon icon="mingcute:delete-2-line"></iconify-icon> </a>';
                })
                ->rawColumns(['action'])
                ->removeColumn('id')
                ->toJson(true);
        }
        return view('menu/ekstrakurikuler/list');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('menu/ekstrakurikuler/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'nama-ekskul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'foto-struktur' => 'required|image|mimes:jpeg,jpg,png|max:3072',
            'foto-kegiatan.*' => 'required|image|mimes:jpeg,jpg,png|max:3072',
            'foto-kegiatan' => 'max:3',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return back()->with(['message' => 'gagal menambahkan data.'])->withErrors($validator)->withInput();
        }
        $validator = $validator->validated();
        $data = [
            'nama' => $validator['nama-ekskul'],
            'deskripsi' => $validator['deskripsi'],
        ];
        $today = Carbon::now()->setTimezone('Asia/Jakarta')->format('YmdHis');
        $converted = Str::lower($validator['nama-ekskul']);
        $converted = Str::slug($converted, '-');

        if ($request->hasFile('foto-struktur')) {
            $ext = $request->file('foto-struktur')->getClientOriginalExtension();
            $foto = $request->file('foto-struktur')->storeAs('ekskul/' . $converted . '/struktur', 'struktur' . '-' . $converted . '-' . $today . '.' . $ext);
            $data['foto_struktur'] = $foto;
        }

        if ($request->hasFile('foto-kegiatan')) {
            $album = [];
            foreach ($request->file('foto-kegiatan') as $index => $file) {
                $fotoKegiatan = $file->storeAs('ekskul/' . $converted . '/kegiatan', 'kegiatan' . '-' . ($index + 1) . '-' . $converted . '-' . $today . '.' . $ext);
                $album[] = $fotoKegiatan;
            }
            $json = json_encode($album, JSON_UNESCAPED_SLASHES);
            $data['foto_kegiatan'] = $json;
        }

        Ekstrakurikuler::create($data);

        return redirect()->route('kelola-ekstrakurikuler.index')->with(['message' => 'sukses menambahkan data.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $Ekstrakurikuler = Ekstrakurikuler::findOrFail($id);
        return view('menu/ekstrakurikuler/show', compact('Ekstrakurikuler'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $Ekstrakurikuler = Ekstrakurikuler::findOrFail($id);
        return view('menu/ekstrakurikuler/edit', compact('Ekstrakurikuler'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $rules = [
            'nama-ekskul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'foto-struktur' => 'nullable|image|mimes:jpeg,jpg,png|max:3072',
            'foto-kegiatan.*' => 'nullable|image|mimes:jpeg,jpg,png|max:3072',
            'foto-kegiatan' => 'max:3',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return back()->with(['message' => 'gagal mengubah data.'])->withErrors($validator)->withInput();
        }
        $validator = $validator->validated();
        // dd($validator);
        $data = [
            'nama' => $validator['nama-ekskul'],
            'deskripsi' => $validator['deskripsi'],
        ];
        $today = Carbon::now()->setTimezone('Asia/Jakarta')->format('YmdHis');
        $converted = Str::lower($validator['nama-ekskul']);
        $converted = Str::slug($converted, '-');
        $getEkskulData = Ekstrakurikuler::where('id', $id)->first();
        if ($request->hasFile('foto-struktur')) {
            if (Storage::exists($getEkskulData->foto_struktur)) {
                Storage::delete($getEkskulData->foto_struktur);
            }
            $ext = $request->file('foto-struktur')->getClientOriginalExtension();
            $foto = $request->file('foto-struktur')->storeAs('ekskul/struktur', 'struktur' . '-' . $converted . '-' . $today . '.' . $ext);
            $data['foto_struktur'] = $foto;
        }

        if ($request->hasFile('foto-kegiatan')) {
            $album = [];
            if (!empty($getEkskulData->foto_kegiatan)) {
                $ConvertedStringJsonToPhpArray = json_decode($getEkskulData->foto_kegiatan, true);
                /** Pertanyaannya adalah attr foto_kegiatan diganti semua ? */
                foreach ($request->file('foto-kegiatan') as $index => $file) {
                    $fotoKegiatan = $file->storeAs('ekskul/kegiatan', 'kegiatan' . '-' . ($index + 1) . '-' . $converted . '-' . $today . '.' . $ext);
                    $album[] = $fotoKegiatan;
                }
                $json = json_encode($album, JSON_UNESCAPED_SLASHES);
                $data['foto_kegiatan'] = $json;
            }
        }

        $getEkskulData->update($data);

        return redirect()->route('kelola-ekstrakurikuler.index')->with(['message' => 'sukses mengubah data.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        if ($request->ajax()) {
            try {
                $Ekstrakurikuler = Ekstrakurikuler::findOrFail($id);
                if (!empty($Ekstrakurikuler->foto_struktur)) {
                    Storage::delete($Ekstrakurikuler->foto_struktur);
                }
                if (!empty($Ekstrakurikuler->foto_kegiatan)) {
                    $album = json_decode($Ekstrakurikuler->foto_kegiatan, true);
                    foreach ($album as $index => $file) {
                        Storage::delete($file);
                    }
                }
                $converted = Str::lower($Ekstrakurikuler->nama);
                $converted = Str::slug($converted, '-');
                Storage::deleteDirectory('ekskul/' . $converted);
                $Ekstrakurikuler->delete();
                return response([
                    'status' => 'success',
                    'data' => 'sukses menghapus data.'
                ]);
            } catch (\Exception $e) {
                return response([
                    'status' => 'error',
                    'data' => $e->getMessage()
                ], 500);
            }
        }
        return redirect()->back();
    }
}
