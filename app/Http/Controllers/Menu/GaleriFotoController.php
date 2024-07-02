<?php

namespace App\Http\Controllers\Menu;

use App\Http\Controllers\Controller;
use App\Models\GaleriFoto;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class GaleriFotoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $GaleriFoto = GaleriFoto::all();
        return view('menu/galeri/foto/list', compact('GaleriFoto'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('menu/galeri/foto/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'nama-foto' => 'required|string|max:255',
            'foto' => 'required|image|mimes:jpeg,jpg,png|max:3072',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return back()->with(['message' => 'gagal menambahkan data.', 'isActive' => false, 'hasError' => true])->withErrors($validator)->withInput();
        }
        $validator = $validator->validated();
        $data = [
            'nama_foto' => $validator['nama-foto'],
        ];
        $today = Carbon::now()->setTimezone('Asia/Jakarta')->format('YmdHis');
        $converted = Str::lower($validator['nama-foto']);
        $converted = Str::slug($converted, '-');

        if ($request->hasFile('foto')) {
            $ext = $request->file('foto')->getClientOriginalExtension();
            $foto = $request->file('foto')->storeAs('galeri/foto', 'foto' . '-' . $converted . '-' . $today . '.' . $ext);
            $data['file_foto'] = $foto;
        }

        GaleriFoto::create($data);

        return redirect()->route('kelola-galeri-foto.index')->with(['message' => 'sukses menambahkan data.', 'isActive' => true, 'hasError' => false]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $GaleriFoto = GaleriFoto::findOrFail($id);
        return view('menu/galeri/foto/show', compact('GaleriFoto'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $GaleriFoto = GaleriFoto::findOrFail($id);
        return view('menu/galeri/foto/edit', compact('GaleriFoto'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $rules = [
            'nama-foto' => 'required|string|max:255',
            'foto' => 'required|image|mimes:jpeg,jpg,png|max:3072',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return back()->with(['message' => 'gagal mengubah data.', 'isActive' => false, 'hasError' => true])->withErrors($validator)->withInput();
        }
        $validator = $validator->validated();
        $data = [
            'nama_foto' => $validator['nama-foto'],
        ];
        $today = Carbon::now()->setTimezone('Asia/Jakarta')->format('YmdHis');
        $converted = Str::lower($validator['nama-foto']);
        $converted = Str::slug($converted, '-');
        $getGaleriFotoData = GaleriFoto::where('id', $id)->first();
        if ($request->hasFile('foto')) {
            if (Storage::exists($getGaleriFotoData->file_foto)) {
                Storage::delete($getGaleriFotoData->file_foto);
            }
            $ext = $request->file('foto')->getClientOriginalExtension();
            $foto = $request->file('foto')->storeAs('galeri/foto', 'foto' . '-' . $converted . '-' . $today . '.' . $ext);
            $data['file_foto'] = $foto;
        }

        $getGaleriFotoData->update($data);

        return redirect()->route('kelola-galeri-foto.index')->with(['message' => 'sukses mengubah data.', 'isActive' => true, 'hasError' => false]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $GaleriFoto = GaleriFoto::findOrFail($id);
        if (!empty($GaleriFoto->file_foto)) {
            Storage::delete($GaleriFoto->file_foto);
        }
        $GaleriFoto->delete();
        return redirect()->route('kelola-galeri-foto.index')->with('message', 'sukses menghapus data.');

    }
}
