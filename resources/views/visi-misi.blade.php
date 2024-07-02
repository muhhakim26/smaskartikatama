@extends('layouts/preset')
@section('judul', 'Visi dan Misi')
@section('konten')
    @if (!empty($VisiMisi))
        <div>
            {{ $VisiMisi->deskripsi }}
        </div>
    @endif
@endsection
