@extends('layouts/preset')
@section('judul', 'Berita')
@section('konten')
    @if (!empty($Berita))
        <div>
            <h2>{{ $Berita->judul }}</h2>
            <img alt="struktur organisasi" src="{{ asset('img/' . $Berita->file_foto) }}">
            <div>
                {{ $Berita->deskripsi }}
            </div>
        </div>
    @endif
@endsection
