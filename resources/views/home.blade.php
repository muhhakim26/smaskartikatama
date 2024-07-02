@extends('layouts.preset')
@section('judul', 'Halaman Utama')
@section('konten')
    <h1>Halaman Utama, Hi {{ auth()->user()->nama ?? 'Guest' }}</h1>
    <ul>
        <li><a href="{{ route('home') }}">Home</a></li>
        <li> Tentang Kami
            <ul>
                <li><a href="{{ route('sambutan') }}">Sambutan Kepala Sekolah</a></li>
                <li><a href="{{ route('visi-misi') }}">Visi dan Misi</a></li>
                <li><a href="{{ route('sejarah') }}">Sejarah</a></li>
                <li><a href="{{ route('struktur-organisasi') }}">Struktur Organisasi</a></li>
                <li><a href="{{ route('guru') }}">Guru</a></li>
            </ul>
        </li>
        <li><a href="{{ route('berita') }}">Berita</a></li>
        <li> Galeri
            <ul>
                <li><a href="{{ route('foto') }}">Foto</a></li>
                <li><a href="{{ route('video') }}">Video</a></li>
            </ul>
        </li>
        <li><a href="{{ route('ppdb') }}">PPDB</a></li>
        <li><a href="{{ route('osis') }}">OSIS</a></li>
        <li><a href="{{ route('kontak') }}">Kontak</a></li>
    </ul>
@endsection
