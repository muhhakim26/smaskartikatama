<?php

namespace App\Http\Controllers\Menu;

use App\Http\Controllers\Controller;
use App\Models\StrukturOrganisasi;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class StrukturOrganisasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('menu.struktur.organisasi');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'foto-struktur-organisasi' => 'required|image|mimes:jpeg,jpg,png|max:3072',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return back()->with(['message' => 'gagal menambahkan data.', 'isActive' => false, 'hasError' => true])->withErrors($validator)->withInput();
        }
        $today = Carbon::now()->setTimezone('Asia/Jakarta')->format('YmdHis');
        $getStrukturOrganisasiData = StrukturOrganisasi::where('id', 1)->first();
        if ($request->hasFile('foto-struktur-organisasi')) {
            if (!empty($getStrukturOrganisasiData)) {
                if (Storage::exists($getStrukturOrganisasiData->foto_struktur)) {
                    Storage::delete($getStrukturOrganisasiData->foto_struktur);
                } else {
                    $files = Storage::allFiles('struktur/organisasi');
                    Storage::delete($files);
                }
            }
            $ext = $request->file('foto-struktur-organisasi')->getClientOriginalExtension();
            $foto = $request->file('foto-struktur-organisasi')->storeAs('struktur/organisasi', 'struktur' . '-' . 'organisasi' . '-' . $today . '.' . $ext);

            StrukturOrganisasi::updateOrCreate(['id' => 1], [
                'id' => 1,
                'foto_struktur' => $foto,
            ]);
        }

        return redirect()->route('kelola-struktur-organisasi.index')->with(['message' => 'sukses menambahkan data.', 'isActive' => true, 'hasError' => false]);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
