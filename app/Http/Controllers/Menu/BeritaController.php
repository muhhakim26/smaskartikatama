<?php

namespace App\Http\Controllers\Menu;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class BeritaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $model = Berita::query()->select('id', 'judul');
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
                    return '<a class="w-32-px h-32-px bg-primary-light text-primary-600 rounded-circle d-inline-flex align-items-center justify-content-center" href="' . route('kelola-berita.show', $row->id) . '"> <iconify-icon icon="iconamoon:eye-light"></iconify-icon> </a> <a class="w-32-px h-32-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center" href="' . route('kelola-berita.edit', $row->id) . '"> <iconify-icon icon="lucide:edit"></iconify-icon> </a> <a class="w-32-px h-32-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center" style="cursor:pointer" onclick="hapus(\'' . $row->id . '\')"> <iconify-icon icon="mingcute:delete-2-line"></iconify-icon> </a>';
                })
                ->rawColumns(['action'])
                ->removeColumn('id')
                ->toJson(true);
        }
        return view('menu/berita/list');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('menu/berita/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'judul-berita' => 'required|string|max:255',
            'foto-berita' => 'required|image|mimes:jpeg,jpg,png|max:3072',
            'kutipan-berita' => 'required|string|max:255',
            'deskripsi-berita' => 'required|string',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return back()->with(['message' => 'gagal menambahkan data.', 'isActive' => false, 'hasError' => true])->withErrors($validator)->withInput();
        }
        $validator = $validator->validated();
        $data = [
            'judul' => trim($validator['judul-berita']),
            'kutipan' => trim($validator['kutipan-berita']),
            'deskripsi' => trim($validator['deskripsi-berita']),
        ];
        $today = Carbon::now()->setTimezone('Asia/Jakarta')->format('YmdHis');
        $converted = Str::lower($validator['judul-berita']);
        $converted = Str::slug($converted, '-');

        if ($request->hasFile('foto-berita')) {
            $ext = $request->file('foto-berita')->getClientOriginalExtension();
            $foto = $request->file('foto-berita')->storeAs('berita', 'berita' . '-' . $converted . '-' . $today . '.' . $ext);
            $data['file_foto'] = $foto;
        }

        Berita::create($data);

        return redirect()->route('kelola-berita.index')->with(['message' => 'sukses menambahkan data.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $Berita = Berita::findOrFail($id);
        return view('menu/berita/show', compact('Berita'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $Berita = Berita::findOrFail($id);
        return view('menu/berita/edit', compact('Berita'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $rules = [
            'judul-berita' => 'required|string|max:255',
            'foto-berita' => 'nullable|image|mimes:jpeg,jpg,png|max:3072',
            'kutipan-berita' => 'required|string|max:255',
            'deskripsi-berita' => 'required|string',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return back()->with(['message' => 'gagal mengubah data.', 'isActive' => false, 'hasError' => true])->withErrors($validator)->withInput();
        }
        $validator = $validator->validated();
        $data = [
            'judul' => trim($validator['judul-berita']),
            'kutipan' => trim($validator['kutipan-berita']),
            'deskripsi' => trim($validator['deskripsi-berita']),
        ];
        $today = Carbon::now()->setTimezone('Asia/Jakarta')->format('YmdHis');
        $converted = Str::lower($validator['judul-berita']);
        $converted = Str::slug($converted, '-');
        $getBeritaData = Berita::where('id', $id)->first();
        if ($request->hasFile('foto-berita')) {
            if (Storage::exists($getBeritaData->file_foto)) {
                Storage::delete($getBeritaData->file_foto);
            }
            $ext = $request->file('foto-berita')->getClientOriginalExtension();
            $foto = $request->file('foto-berita')->storeAs('berita', 'berita' . '-' . $converted . '-' . $today . '.' . $ext);
            $data['file_foto'] = $foto;
        }

        $getBeritaData->update($data);

        return redirect()->route('kelola-berita.index')->with(['message' => 'sukses mengubah data.', 'isActive' => true, 'hasError' => false]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        if ($request->ajax()) {
            try {
                $Berita = Berita::findOrFail($id);
                if (!empty($Berita->file_foto)) {
                    Storage::delete($Berita->file_foto);
                }
                $Berita->delete();

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