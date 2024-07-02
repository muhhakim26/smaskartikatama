@extends('layouts/preset')
@section('judul', 'Kelola Berita')
@section('konten')
    <div>
        <a href="{{ route('dashboard') }}">Kembali</a>
    </div>
    <h1>Kelola Berita</h1>

    <a href="{{ route('kelola-berita.create') }}">Buat Berita</a>
    <div>
        <ul>
            @foreach ($Berita as $key => $value)
                <li>Judul:{{ $value->judul }}, <a href="{{ route('kelola-berita.show', $value->id) }}">Lihat</a></li>
            @endforeach
        </ul>
    </div>
@endsection
