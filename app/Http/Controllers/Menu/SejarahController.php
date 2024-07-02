<?php

namespace App\Http\Controllers\Menu;

use App\Http\Controllers\Controller;
use App\Models\Sejarah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SejarahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Sejarah = Sejarah::where('id', 1)->first();
        return view('menu/sejarah/sejarah', compact('Sejarah'));
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
            'isi' => 'nullable|string',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return back()->with(['message' => 'gagal menambahkan data.', 'isActive' => false, 'hasError' => true])->withErrors($validator)->withInput();
        }
        $validator = $validator->validated();
        Sejarah::updateOrCreate(['id' => 1], [
            'id' => 1,
            'deskripsi' => $validator['isi'],
        ]);

        return redirect()->route('kelola-sejarah.index')->with(['message' => 'sukses menambahkan data.', 'isActive' => true, 'hasError' => false]);

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
