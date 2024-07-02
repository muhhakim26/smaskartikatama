<?php

namespace App\Http\Controllers\Menu;

use App\Http\Controllers\Controller;
use App\Models\Kontak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KontakController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Kontak = Kontak::where('id', 1)->first();
        return view('menu/kontak/kontak', compact('Kontak'));
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
        /**
         * Pertanyaannya adalah alamat pake google map?
         */
        $rules = [
            'alamat' => 'nullable|string',
            'no-telepon' => ['nullable', 'regex:/\+?([ -]?\d+)+|\(\d+\)([ -]\d+)/'],
            'email' => 'nullable|string|email:rfc,dns',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return back()->with(['message' => 'gagal menambahkan data.', 'isActive' => false, 'hasError' => true])->withErrors($validator)->withInput();
        }
        $validator = $validator->validated();

        Kontak::updateOrCreate(['id' => 1], [
            'id' => 1,
            'alamat' => $validator['alamat'],
            'notelpon' => $validator['no-telepon'],
            'email' => $validator['email'],
        ]);

        return redirect()->route('kelola-kontak.index')->with(['message' => 'sukses menambahkan data.', 'isActive' => true, 'hasError' => false]);

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
