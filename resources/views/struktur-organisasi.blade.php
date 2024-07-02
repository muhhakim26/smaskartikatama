@extends('layouts/preset')
@section('judul', 'Struktur Organisasi')
@section('konten')
    @if (!empty($StrukturOrganisasi))
        <div>
            <img alt="struktur organisasi" src="{{ asset('img/' . $StrukturOrganisasi->foto_struktur) }}">
        </div>
    @endif
@endsection
