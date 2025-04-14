<?php

namespace App\Http\Controllers\Menu;

use App\Http\Controllers\Controller;
use App\Models\Osis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;

class OsisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $OSIS = Osis::where('id', 1)->first();
        return view('menu/osis/osis', compact('OSIS'));
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
            'deskripsi-osis' => 'nullable|string',
            'foto-struktur-osis' => 'nullable|image|mimes:jpeg,jpg,png|max:3072',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return back()->with(['message' => 'gagal menambahkan data.', 'isActive' => false, 'hasError' => true])->withErrors($validator)->withInput();
        }
        $validator = $validator->validated();
        if (trim($validator['deskripsi-osis']) === '<p></p>') {
            $validator['deskripsi-osis'] = null;
        }
        $data = [
            'id' => 1,
            'deskripsi' => $validator['deskripsi-osis'],
        ];
        $today = Carbon::now()->setTimezone('Asia/Jakarta')->format('YmdHis');
        $getOsisData = Osis::where('id', 1)->first();
        if ($request->hasFile('foto-struktur-osis')) {
            if (!empty($getOsisData->foto_struktur)) {
                if (Storage::exists($getOsisData->foto_struktur)) {
                    Storage::delete($getOsisData->foto_struktur);
                } else {
                    $files = Storage::allFiles('struktur/osis');
                    Storage::delete($files);
                }
            }
            $ext = $request->file('foto-struktur-osis')->getClientOriginalExtension();
            $foto = $request->file('foto-struktur-osis')->storeAs('struktur/osis', 'struktur' . '-' . 'osis' . '-' . $today . '.' . $ext);
            $data['foto_struktur'] = $foto;
        }
        Osis::updateOrCreate(['id' => 1], $data);

        return redirect()->route('kelola-osis.index')->with(['message' => 'sukses menambahkan data.', 'isActive' => true, 'hasError' => false]);
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
    public function destroy(Request $request, string $id)
    {
        if ($request->ajax()) {
            try {
                $getOsisData = Osis::findOrFail($id);
                if (Storage::exists($getOsisData->foto_struktur)) {
                    Storage::delete($getOsisData->foto_struktur);
                }
                $data = [
                    'foto_struktur' => null
                ];
                Osis::updateOrCreate(['id' => $id], $data);
                return response([
                    'status' => 'success',
                    'data' => 'sukses menghapus data.'
                ]);
            } catch (\Throwable $e) {
                return response([
                    'status' => 'error',
                    'data' => $e->getMessage()
                ], 500);
            }
        }
        return redirect()->back();
    }
}
