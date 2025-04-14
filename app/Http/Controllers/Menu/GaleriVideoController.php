<?php

namespace App\Http\Controllers\Menu;

use App\Http\Controllers\Controller;
use App\Models\GaleriVideo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class GaleriVideoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $GaleriVideo = GaleriVideo::paginate(4);
        return view('menu/galeri/video/list', compact('GaleriVideo'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('menu/galeri/video/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        /** Pertanyaannya adalah link video pake youtube? */
        $rules = [
            'judul-video' => 'required|string|max:255',
            'keluku' => 'required|image|mimes:jpeg,jpg,png|max:3072',
            'link-video' => 'required|string|max:255',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return back()->with(['message' => 'gagal menambahkan data.', 'isActive' => false, 'hasError' => true])->withErrors($validator)->withInput();
        }
        $validator = $validator->validated();
        $parseUrl = parse_url($validator['link-video']);
        if ($parseUrl['host'] == 'youtu.be') {
            $videoId = ltrim($parseUrl['path'], '/');
        } else {
            parse_str($parseUrl['query'], $query_vars);
            $videoId = $query_vars['v'];
        }
        $data = [
            'judul_video' => $validator['judul-video'],
            'file_video' => "https://www.youtube.com/watch?v=$videoId",
        ];
        $today = Carbon::now()->setTimezone('Asia/Jakarta')->format('YmdHis');
        $converted = Str::lower($validator['judul-video']);
        $converted = Str::slug($converted, '-');

        if ($request->hasFile('keluku')) {
            $ext = $request->file('keluku')->getClientOriginalExtension();
            $keluku = $request->file('keluku')->storeAs('galeri/video', 'keluku' . '-' . $converted . '-' . $today . '.' . $ext);
            $data['thumbnail'] = $keluku;
        }

        GaleriVideo::create($data);

        return redirect()->route('kelola-galeri-video.index')->with(['message' => 'sukses menambahkan data.', 'isActive' => true, 'hasError' => false]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $GaleriVideo = GaleriVideo::findOrFail($id);
        return view('menu/galeri/video/show', compact('GaleriVideo'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $GaleriVideo = GaleriVideo::findOrFail($id);
        return view('menu/galeri/video/edit', compact('GaleriVideo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $rules = [
            'judul-video' => 'required|string|max:255',
            'keluku' => 'nullable|image|mimes:jpeg,jpg,png|max:3072',
            'link-video' => 'required|string|max:255',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return back()->with(['message' => 'gagal mengubah data.', 'isActive' => false, 'hasError' => true])->withErrors($validator)->withInput();
        }
        $validator = $validator->validated();
        $parseUrl = parse_url($validator['link-video']);
        if ($parseUrl['host'] == 'youtu.be') {
            $videoId = ltrim($parseUrl['path'], '/');
        } else {
            parse_str($parseUrl['query'], $query_vars);
            $videoId = $query_vars['v'];
        }
        $data = [
            'judul_video' => $validator['judul-video'],
            'file_video' => "https://www.youtube.com/watch?v=$videoId",
        ];
        $today = Carbon::now()->setTimezone('Asia/Jakarta')->format('YmdHis');
        $converted = Str::lower($validator['judul-video']);
        $converted = Str::slug($converted, '-');
        $getGaleriVideoData = GaleriVideo::where('id', $id)->first();
        if ($request->hasFile('keluku')) {
            if (Storage::exists($getGaleriVideoData->thumbnail)) {
                Storage::delete($getGaleriVideoData->thumbnail);
            }
            $ext = $request->file('keluku')->getClientOriginalExtension();
            $keluku = $request->file('keluku')->storeAs('galeri/video', 'keluku' . '-' . $converted . '-' . $today . '.' . $ext);
            $data['thumbnail'] = $keluku;
        }

        $getGaleriVideoData->update($data);

        return redirect()->route('kelola-galeri-video.index')->with(['message' => 'sukses mengubah data.', 'isActive' => true, 'hasError' => false]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        try {
            $GaleriVideo = GaleriVideo::findOrFail($id);
            if (!empty($GaleriVideo->thumbnail)) {
                Storage::delete($GaleriVideo->thumbnail);
            }
            $GaleriVideo->delete();
            if ($request->ajax()) {
                return response([
                    'status' => 'success',
                    'data' => 'sukses menghapus data.'
                ]);
            }
            return redirect()->route('kelola-galeri-video.index')->with('message', 'sukses menghapus data.');
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response([
                    'status' => 'error',
                    'data' => $e->getMessage()
                ], 500);
            }
            return redirect()->route('kelola-galeri-video.index')->with('message', 'gagal menghapus data: ' . $e->getMessage());
        }
    }
}