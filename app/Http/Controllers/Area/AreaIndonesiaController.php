<?php

namespace App\Http\Controllers\Area;

use App\Http\Controllers\Controller;
use App\Models\Area\District;
use App\Models\Area\Province;
use App\Models\Area\Regency;
use Illuminate\Http\Request;

class AreaIndonesiaController extends Controller
{
    public function provinces()
    {
        $Provinsi = Province::all();
        return $Provinsi;
    }

    public function regencies(Request $request)
    {
        $Kabupaten = Province::with('regencies')->find($request->id);
        return $Kabupaten->regencies->pluck('name', 'id');
    }

    public function districts(Request $request)
    {
        $Kecamatan = Regency::with('districts')->find($request->id);
        return $Kecamatan->districts->pluck('name', 'id');
    }

    public function villages(Request $request)
    {
        $Kelurahan = District::with('villages')->find($request->id);
        return $Kelurahan->villages->pluck('name', 'id');
    }
}
