@extends('layouts/preset')
@section('judul', 'Sambutan Kepala Sekolah')
@section('konten')
    @if (!empty($SambutanKepsek))
        <div>
            {{ $SambutanKepsek->deskripsi }}
        </div>
    @endif
@endsection
