@extends('layouts/preset')
@section('judul', 'Guru')
@section('konten')
    @if (!empty($DataGuru))
        <div>
            <p>{{ $DataGuru->nip }}</p>
            <p>{{ $DataGuru->nama }}</p>
            <img alt="{{ $DataGuru->nama }}" src="{{ asset('img/' . $DataGuru->file_foto) }}">
            <p>{{ $DataGuru->bidang }}</p>
            <p>{{ $DataGuru->jabatan }}</p>
        </div>
    @endif
@endsection
