@extends('layouts/preset')
@section('judul', 'Kelola Ekstrakurikuler')
@section('konten')
    <div>
        <a href="{{ route('dashboard') }}">Kembali</a>
    </div>
    <h1>Kelola Ekstrakurikuler</h1>

    <a href="{{ route('kelola-ekstrakurikuler.create') }}">Buat Ekstrakurikuler</a>
    <div>
        <ul>
            @foreach ($Ekstrakurikuler as $key => $value)
                <li>nama:{{ $value->nama }}, <a href="{{ route('kelola-ekstrakurikuler.show', $value->id) }}">Lihat</a></li>
            @endforeach
        </ul>
    </div>
@endsection
