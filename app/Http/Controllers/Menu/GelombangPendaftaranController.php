<?php

namespace App\Http\Controllers\Menu;

use App\Http\Controllers\Controller;
use App\Models\GelombangPendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class GelombangPendaftaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $model = GelombangPendaftaran::query()->select('id', 'tahun_ajaran', 'kuota_pendaftaran', 'tanggal_dibuka', 'tanggal_ditutup', 'tanggal_diumumkan', 'status_pendaftaran', 'status_pengumuman');

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
                ->editColumn('status_pendaftaran', function ($row) {
                    $checked = ($row->status_pendaftaran == 1) ? 'checked' : '';
                    $dataActive = $row->status_pendaftaran == 1 ? 'Y' : 'N';
                    $switch1 = '
                <div class="form-switch switch-primary d-flex align-items-center gap-3">
                    <input ' . $checked . ' class="form-check-input btn-active active' . $row->id . '" data-active="' . $dataActive . '" data-id="' . $row->id . '" role="switch" type="checkbox">
                </div>';
                    return $switch1;
                })
                ->editColumn('status_pengumuman', function ($row) {
                    $checked = ($row->status_pengumuman == 1) ? 'checked' : '';
                    $dataActive = $row->status_pengumuman == 1 ? 'Y' : 'N';
                    $switch2 = '
                <div class="form-switch switch-primary d-flex align-items-center gap-3">
                    <input ' . $checked . ' class="form-check-input btn-pengumuman active-pengumuman' . $row->id . '" data-active="' . $dataActive . '" data-id="' . $row->id . '" role="switch" type="checkbox">
                </div>';
                    return $switch2;
                })
                ->addColumn('action', function ($row) {
                    return '<a class="text-success-main" href="' . route('kelola-gelombang-pendaftaran.edit', $row->id) . '"><iconify-icon icon="lucide:edit"></iconify-icon></a>';
                })
                ->rawColumns(['status_pendaftaran', 'status_pengumuman', 'action'])
                ->toJson(true);
        }
        return view('admin/kelola-gelombang-pendaftaran/list');
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
        //
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
        $Gelombang = GelombangPendaftaran::findOrFail($id);
        return view('admin.kelola-gelombang-pendaftaran.edit', compact('Gelombang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $rules = [
            'tahun-ajaran' => 'required|string',
            'kuota-pendaftaran' => 'required|string',
            'tanggal-dibuka' => 'required|string',
            'tanggal-ditutup' => 'required|string',
            'tanggal-diumumkan' => 'required|string',
            'catatan' => 'required|string',
            'link-grup' => 'required|string',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return back()->with(['message' => 'gagal mengubah data.', 'isActive' => false, 'hasError' => true])->withErrors($validator)->withInput();
        }
        $validated = $validator->validated();

        $data = [
            'tahun_ajaran' => $validated['tahun-ajaran'],
            'kuota_pendaftaran' => $validated['kuota-pendaftaran'],
            'tanggal_dibuka' => $validated['tanggal-dibuka'],
            'tanggal_ditutup' => $validated['tanggal-ditutup'],
            'tanggal_diumumkan' => $validated['tanggal-diumumkan'],
            'catatan' => $validated['catatan'],
            'link_grup' => $validated['link-grup'],
        ];

        $Gelombang = GelombangPendaftaran::findOrFail($id);

        $Gelombang->update($data);

        return redirect()->route('kelola-gelombang-pendaftaran.index')->with(['message' => 'sukses mengubah data.', 'isActive' => true, 'hasError' => false]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function aksi(Request $request, $aksi)
    {
        if ($request->ajax()) {
            $Gelombang = GelombangPendaftaran::where('id', $request->id)->first();
            if ($aksi == 'status-pendaftaran') {
                if ($request->active == 'Y') {
                    $Gelombang->status_pendaftaran = true;
                } else {
                    $Gelombang->status_pendaftaran = false;
                }
            } elseif ($aksi == 'status-pengumuman') {
                if ($request->active == 'Y') {
                    $Gelombang->status_pengumuman = true;
                } else {
                    $Gelombang->status_pengumuman = false;
                }
            } else {
                return response()->json(['success' => false]);
            }

            $Gelombang->save();

            return response()->json(['success' => true]);
        }
    }
}