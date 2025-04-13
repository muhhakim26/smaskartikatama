<?php

namespace App\Http\Controllers\Menu;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $model = Admin::query()->select('id', 'nama', 'email', 'level')->where('id', '!=', 1);

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
            'role' => 'required|string|in:admin',
            'surel' => 'required|email:rfc,dns|unique:admin,email',
            'kata-sandi' => 'required|min:5|max:255',
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
        $Admin = Admin::where('id', '!=', 1)->findOrFail($id);
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
            return back()->with(['message' => 'gagal menambahkan data.'])->withErrors($validator)->withInput();
        }
        $validator = $validator->validated();
        Admin::where('id', '!=', 1)->findOrFail($id)->update([
            'nama' => $validator['nama-lengkap'],
            'email' => Str::lower($validator['surel']),
            'level' => $validator['role'],
            // 'password' => bcrypt($validator['kata-sandi']),
        ]);

        return redirect()->route('kelola-admin.index')->with(['message' => 'sukses mengubah data.']);
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
}