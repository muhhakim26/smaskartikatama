@extends('layouts/preset')
@section('judul', 'Sejarah')
@section('konten')
    @if (!empty($Sejarah))
        <div>
            {{ $Sejarah->deskripsi }}
        </div>
    @endif
@endsection
