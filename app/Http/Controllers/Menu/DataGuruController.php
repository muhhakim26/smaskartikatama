<?php

namespace App\Http\Controllers\Menu;

use App\Http\Controllers\Controller;
use App\Models\DataGuru;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class DataGuruController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $DataGuru = DataGuru::all();
        return view('menu/dataguru/list', compact('DataGuru'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('menu/dataguru/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'nama-guru' => 'required|string|max:255',
            'nip-guru' => 'required|digits:18',
            'bidang-guru' => 'required|string',
            'jabatan-guru' => 'required|string',
            'foto-guru' => 'required|image|mimes:jpeg,jpg,png|max:3072',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return back()->with(['message' => 'gagal menambahkan data.', 'isActive' => false, 'hasError' => true])->withErrors($validator)->withInput();
        }
        $validator = $validator->validated();
        $data = [
            'nama' => $validator['nama-guru'],
            'nip' => $validator['nip-guru'],
            'bidang' => $validator['bidang-guru'],
            'jabatan' => $validator['jabatan-guru'],
        ];
        $today = Carbon::now()->setTimezone('Asia/Jakarta')->format('YmdHis');
        $converted = Str::lower($validator['nama-guru']);
        $converted = Str::slug($converted, '-');

        if ($request->hasFile('foto-guru')) {
            $ext = $request->file('foto-guru')->getClientOriginalExtension();
            $foto = $request->file('foto-guru')->storeAs('guru', 'guru' . '-' . $converted . '-' . $today . '.' . $ext);
            $data['file_foto'] = $foto;
        }

        DataGuru::create($data);

        return redirect()->route('kelola-data-guru.index')->with(['message' => 'sukses menambahkan data.', 'isActive' => true, 'hasError' => false]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $DataGuru = DataGuru::findOrFail($id);
        return view('menu/dataguru/show', compact('DataGuru'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $DataGuru = DataGuru::findOrFail($id);
        return view('menu/dataguru/edit', compact('DataGuru'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $rules = [
            'nama-guru' => 'required|string|max:255',
            'nip-guru' => 'required|digits:18|unique:data_guru,nip,' . $id,
            'bidang-guru' => 'required|string',
            'jabatan-guru' => 'required|string',
            'foto-guru' => 'nullable|image|mimes:jpeg,jpg,png|max:3072',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return back()->with(['message' => 'gagal mengubah data.', 'isActive' => false, 'hasError' => true])->withErrors($validator)->withInput();
        }
        $validator = $validator->validated();
        $data = [
            'nama' => $validator['nama-guru'],
            'nip' => $validator['nip-guru'],
            'bidang' => $validator['bidang-guru'],
            'jabatan' => $validator['jabatan-guru'],
        ];
        $today = Carbon::now()->setTimezone('Asia/Jakarta')->format('YmdHis');
        $converted = Str::lower($validator['nama-guru']);
        $converted = Str::slug($converted, '-');
        $getDataGuru = DataGuru::where('id', $id)->first();
        if ($request->hasFile('foto-guru')) {
            if (Storage::exists($getDataGuru->file_foto)) {
                Storage::delete($getDataGuru->file_foto);
            }
            $ext = $request->file('foto-guru')->getClientOriginalExtension();
            $foto = $request->file('foto-guru')->storeAs('guru', 'guru' . '-' . $converted . '-' . $today . '.' . $ext);
            $data['file_foto'] = $foto;
        }

        $getDataGuru->update($data);

        return redirect()->route('kelola-data-guru.index')->with(['message' => 'sukses mengubah data.', 'isActive' => true, 'hasError' => false]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $DataGuru = DataGuru::findOrFail($id);
        if (!empty($DataGuru->file_foto)) {
            Storage::delete($DataGuru->file_foto);
        }
        $DataGuru->delete();
        return redirect()->route('kelola-data-guru.index')->with('message', 'sukses menghapus data.');
    }
}
