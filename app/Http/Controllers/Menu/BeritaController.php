<?php

namespace App\Http\Controllers\Menu;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class BeritaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Berita = Berita::all();
        return view('menu/berita/list', compact('Berita'));
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
            'deskripsi-berita' => 'required|string',
            'foto-berita' => 'required|image|mimes:jpeg,jpg,png|max:3072',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return back()->with(['message' => 'gagal menambahkan data.', 'isActive' => false, 'hasError' => true])->withErrors($validator)->withInput();
        }
        $validator = $validator->validated();
        $data = [
            'judul' => $validator['judul-berita'],
            'deskripsi' => $validator['deskripsi-berita'],
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

        return redirect()->route('kelola-berita.index')->with(['message' => 'sukses menambahkan data.', 'isActive' => true, 'hasError' => false]);
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
            'deskripsi-berita' => 'required|string',
            'foto-berita' => 'nullable|image|mimes:jpeg,jpg,png|max:3072',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return back()->with(['message' => 'gagal mengubah data.', 'isActive' => false, 'hasError' => true])->withErrors($validator)->withInput();
        }
        $validator = $validator->validated();
        $data = [
            'judul' => $validator['judul-berita'],
            'deskripsi' => $validator['deskripsi-berita'],
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
    public function destroy(string $id)
    {
        $Berita = Berita::findOrFail($id);
        if (!empty($Berita->file_foto)) {
            Storage::delete($Berita->file_foto);
        }
        $Berita->delete();
        return redirect()->route('kelola-berita.index')->with('message', 'sukses menghapus data.');

    }
}
