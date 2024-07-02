@extends('layouts/preset')
@section('judul', 'Kontak')
@section('konten')
    @if (!empty($Kontak))
        <div>
            <p>{{ $Kontak->alamat }}</p>
            <p>{{ $Kontak->notelpon }}</p>
            <p>{{ $Kontak->email }}</p>
        </div>
    @endif
@endsection
