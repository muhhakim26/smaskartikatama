@extends('layouts/preset')
@section('judul', 'OSIS')
@section('konten')
    @if (!empty($OSIS))
        <div>
            <img alt="struktur osis" src="{{ asset('img/' . $OSIS->foto_struktur) }}">
            <div>
                {{ $OSIS->deskripsi }}
            </div>
        </div>
    @endif
@endsection
