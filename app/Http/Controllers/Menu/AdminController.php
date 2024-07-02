<?php

namespace App\Http\Controllers\Menu;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Admin = Admin::get();
        return view('menu/admin/list', compact('Admin'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        return view('menu/admin/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'nama-lengkap' => 'required|string|min:5,nama|max:255',
            'role' => 'required|string|in:admin',
            'surel' => 'required|email:rfc,dns|unique:admin,email',
            'kata-sandi' => 'required|min:5|max:255',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return back()->with(['message' => 'gagal menambahkan data.', 'isActive' => false, 'hasError' => true])->withErrors($validator)->withInput();
        }
        $validator = $validator->validated();
        Admin::create([
            'nama' => $validator['nama-lengkap'],
            'email' => $validator['surel'],
            'level' => $validator['role'],
            'password' => bcrypt($validator['kata-sandi']),
        ]);

        return redirect()->route('admin.index')->with(['message' => 'sukses menambahkan data.', 'isActive' => true, 'hasError' => false]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $Admin = Admin::findOrFail($id);
        return view('menu/admin/show', compact('Admin'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $Admin = Admin::findOrFail($id);
        return view('menu/admin/edit', compact('Admin'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $rules = [
            'nama-lengkap' => 'required|string|min:5,nama|max:255',
            'role' => 'required|string|in:admin',
            'surel' => 'required|email:rfc,dns|unique:admin,email,' . $id,
            // 'kata-sandi' => 'required|min:5|max:255',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return back()->with(['message' => 'gagal menambahkan data.', 'isActive' => false, 'hasError' => true])->withErrors($validator)->withInput();
        }
        $validator = $validator->validated();
        Admin::findOrFail($id)->update([
            'nama' => $validator['nama-lengkap'],
            'email' => $validator['surel'],
            'level' => $validator['role'],
            // 'password' => bcrypt($validator['kata-sandi']),
        ]);

        return redirect()->route('admin.show')->with(['message' => 'sukses mengubah data.', 'isActive' => true, 'hasError' => false]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (Admin::count() < 2) {
            return back()->with('message', 'gagal menghapus data yang terkahir.');
        }

        Admin::findOrFail($id)->delete();
        return redirect()->route('admin.index')->with('message', 'sukses menghapus data.');
    }
}
