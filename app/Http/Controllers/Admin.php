<?php

namespace App\Http\Controllers;

use App\Models\Admin as ModelsAdmin;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class Admin extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $rules = [
            'nama' => 'required|string|min:5,nama|max:255',
            'level' => 'required|string',
            'email' => 'required|email:rfc,dns|unique:admin,email',
            'password' => 'required|min:5|max:255|confirmed',
        ];
        $massages = [
            'confirmed' => 'konfirmasi :attribute tidak cocok.',
            'email' => ':attribute harus berupa alamat surel yang valid.',
            'max' => ':attribute harus diisi maksimal :max karakter.',
            'min' => ':attribute harus diisi minimal :min karakter.',
            'required' => ':attribute wajib diisi.',
            'unique' => ':attribute sudah digunakan.',
        ];
        $validator = Validator::make($request->all(), $rules, $massages);
        if ($validator->fails()) {
            return back()->with('failed_add_account', 'gagal menambahkan akun')->withErrors($validator)->withInput();
        }
        ModelsAdmin::create([
            'nama' => $request->input('nama'),
            'email' => $request->input('email'),
            'level' => $request->input('level'),
            'password' => bcrypt($request->input('password')),
        ]);
        return redirect()->route('login')->with('success_add_account', 'berhasil menambahkan akun');
    }

    // /**
    //  * Store a newly created resource in storage.
    //  */
    // public function store(Request $request)
    // {
    //     //
    // }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $admin = ModelsAdmin::paginate();

        return view('login', compact('admin'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
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
