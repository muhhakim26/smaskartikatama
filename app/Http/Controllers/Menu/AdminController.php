<?php

namespace App\Http\Controllers\Menu;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $model = Admin::query()->select('id', 'nama', 'email', 'level');

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
                ->editColumn('level', function ($row) {
                    return "<span class='bg-success-focus text-success-600 border border-success-main px-24 py-4 radius-4 fw-medium text-sm'>$row->level</span>";
                })
                ->addColumn('action', function ($row) {
                    return '<a class="w-32-px h-32-px bg-primary-light text-primary-600 rounded-circle d-inline-flex align-items-center justify-content-center" href="' . route('kelola-admin.show', $row->id) . '"> <iconify-icon icon="iconamoon:eye-light"></iconify-icon> </a> <a class="w-32-px h-32-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center" href="' . route('kelola-admin.edit', $row->id) . '"> <iconify-icon icon="lucide:edit"></iconify-icon> </a> <a class="w-32-px h-32-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center" style="cursor:pointer" onclick="hapus(\'' . $row->id . '\')"> <iconify-icon icon="mingcute:delete-2-line"></iconify-icon> </a>';
                })
                ->rawColumns(['level', 'action'])
                ->removeColumn('id')
                ->toJson(true);
        }
        return view('menu/admin/list');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
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
            'role' => 'required|string|in:admin,superadmin',
            'surel' => 'required|email:rfc,dns|unique:admin,email',
            'kata-sandi' => ['required', 'string', Password::min(8)->mixedCase()->numbers()->symbols()->uncompromised(), 'max:255'],
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return back()->with(['message' => 'gagal menambahkan data.'])->withErrors($validator)->withInput();
        }
        $validator = $validator->validated();
        Admin::create([
            'nama' => $validator['nama-lengkap'],
            'email' => Str::lower($validator['surel']),
            'level' => $validator['role'],
            'password' => bcrypt($validator['kata-sandi']),
        ]);

        return redirect()->route('kelola-admin.index')->with(['message' => 'sukses menambahkan data.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $Admin = Admin::where('id', '!=', 1)->findOrFail($id);
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
            'surel' => 'required|email:rfc,dns|unique:admin,email,' . $id,
            'kata-sandi-lama' => ['nullable', 'string', 'max:255'],
            'kata-sandi-baru' => ['nullable', 'string', 'confirmed', Password::min(8)->mixedCase()->numbers()->symbols()->uncompromised(), 'max:255'],
            'kata-sandi-baru_confirmation' => ['nullable', 'string', 'max:255'],
        ];
        if (!request()->has('isProfil')) {
            $rules['role'] = 'required|string|in:admin,superadmin';
        }
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return back()->with(['message' => 'gagal mengubah data.', 'isActive' => true, 'hasError' => true])->withErrors($validator)->withInput();
        }
        $validating = $validator->validated();

        $validated = [
            'nama' => $validating['nama-lengkap'],
            'email' => Str::lower($validating['surel']),
        ];

        $admin = Admin::findOrFail($id);

        if (!empty($validating['kata-sandi-lama']) && !empty($validating['kata-sandi-baru']) && !empty($validating['kata-sandi-baru_confirmation'])) {
            // Cek apakah kata sandi lama cocok
            if (!Hash::check($validating['kata-sandi-lama'], $admin->password)) {
                return back()->with('message', 'Terjadi kesalahan: kata sandi lama tidak cocok');
            }

            // Cek apakah kata sandi baru sama dengan yang lama
            if ($validating['kata-sandi-lama'] === $validating['kata-sandi-baru']) {
                return back()->with('message', 'Kata sandi baru tidak boleh sama dengan kata sandi lama')->withErrors(['kata-sandi-baru' => 'Gunakan kata sandi yang berbeda dari sebelumnya.']);
            }

            // Jika lolos semua validasi
            $validated['password'] = bcrypt($validating['kata-sandi-baru']);
        }

        if (!request()->has('isProfil')) {
            $validated['level'] = $validating['role'];
        }

        Admin::findOrFail($id)->update($validated);

        if (!request()->has('isProfil')) {
            return redirect()->route('kelola-admin.index')->with(['message' => 'sukses mengubah data.']);
        } else {
            return redirect()->route('profil')->with(['message' => 'sukses mengubah data.', 'hasError' => false]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        if ($request->ajax()) {
            try {
                $admin = Admin::findOrFail($id);
                $admin->delete();

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

    public function profil()
    {
        $Admin = auth()->user();
        return view('menu.profil', compact('Admin'));
    }
}