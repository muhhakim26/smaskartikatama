@extends('layouts/preset')
@section('judul', 'Kelola Data Guru')
@section('konten')
    <div>
        <a href="{{ route('dashboard') }}">Kembali</a>
    </div>
    <h1>Kelola Data Guru</h1>

    <a href="{{ route('kelola-data-guru.create') }}">Buat Data Guru</a>
    <div>
        <ul>
            @foreach ($DataGuru as $key => $value)
                <li>nama:{{ $value->nama }}, <a href="{{ route('kelola-data-guru.show', $value->id) }}">Lihat</a></li>
            @endforeach
        </ul>
    </div>
@endsection
