@extends('layouts/preset')
@section('judul', 'Kelola PPDB')
@section('konten')
    <div>
        <a href="{{ route('dashboard') }}">Kembali</a>
    </div>
    <h1>Kelola PPDB</h1>

    <a href="{{ route('kelola-ppdb.create') }}">Buat PPDB</a>
    <div>
        <ul>
            @foreach ($PPDB as $key => $value)
                <li>nama:{{ $value->nama }}, <a href="{{ route('kelola-ppdb.show', $value->id) }}">Lihat</a></li>
            @endforeach
        </ul>
    </div>
@endsection
