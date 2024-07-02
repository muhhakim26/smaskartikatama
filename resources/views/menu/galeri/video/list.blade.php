@extends('layouts/preset')
@section('judul', 'Kelola Galeri video')
@section('konten')
    <div>
        <a href="{{ route('dashboard') }}">Kembali</a>
    </div>
    <h1>Kelola Galeri Video</h1>

    <a href="{{ route('kelola-galeri-video.create') }}">Buat Galeri Video</a>
    <div>
        <ul>
            @foreach ($GaleriVideo as $key => $value)
                <li>Judul Video:{{ $value->judul_video }}, <a href="{{ route('kelola-galeri-video.show', $value->id) }}">Lihat</a></li>
            @endforeach
        </ul>
    </div>
@endsection
