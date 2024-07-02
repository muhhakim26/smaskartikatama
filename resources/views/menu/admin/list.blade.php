@extends('layouts.preset')
@section('judul', 'Kelola Admin')
@section('konten')
    <div>
        <a href="{{ route('dashboard') }}">Kembali</a>
    </div>
    <h1>Kelola Admin</h1>

    <a href="{{ route('admin.create') }}">Buat Admin</a>
    <div>
        <ul>
            @foreach ($Admin as $key => $value)
                <li>email:{{ $value->email }}, level:{{ $value->level }}, <a href="{{ route('admin.show', $value->id) }}">Lihat</a></li>
            @endforeach
        </ul>
    </div>
@endsection
