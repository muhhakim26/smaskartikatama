@extends('layouts/preset')
@section('judul', 'Galeri Foto')
@section('konten')
    @if (!empty($Foto))
        <div>
            @foreach ($Foto as $key => $value)
                <img alt="{{ $value->nama_foto }}" src="{{ asset('img/' . $value->file_foto) }}">
            @endforeach
        </div>
    @endif
@endsection
