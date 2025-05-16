<?php

namespace App\Http\Controllers\Respon;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class ResponBerkasController extends Controller
{
    public function berkas($path)
    {
        if (auth('admin')->check() || auth('siswa')->check()) {
            $file = Storage::disk('berkas')->get($path);
            $type = File::mimeType(storage_path('app/berkas/' . $path));
            $response = Response::make($file, 200);
            $response->header('Content-Type', $type);
            return $response;
        }
        abort(404);
    }
}
