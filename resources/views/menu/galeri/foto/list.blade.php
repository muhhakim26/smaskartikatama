@extends('layouts/preset')
@section('judul', 'Kelola Galeri Foto')
@section('konten')
    <div>
        <a href="{{ route('dashboard') }}">Kembali</a>
    </div>
    <h1>Kelola Galeri Foto</h1>

    <a href="{{ route('kelola-galeri-foto.create') }}">Buat Galeri Foto</a>
    <div>
        <ul>
            @foreach ($GaleriFoto as $key => $value)
                <li>Nama Foto:{{ $value->nama_foto }}, <a href="{{ route('kelola-galeri-foto.show', $value->id) }}">Lihat</a></li>
            @endforeach
        </ul>
    </div>
@endsection
