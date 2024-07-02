@extends('layouts/preset')
@section('judul', 'Kelola Struktur Organisasi')
@section('konten')
    <div>
        <a href="{{ route('dashboard') }}">Kembali</a>
    </div>
    <h1>Struktur Organisasi</h1>
    {{-- blade-formatter-disable --}}
        @if (session()->has('message'))
            <div @class(['p-4', 'font-bold' => session()->get('isActive'), 'text-gray-500' => !session()->get('isActive'), 'bg-red' => session()->get('hasError'),])>
                {{ session()->get('message') }}
            </div>
        @endif
    {{-- blade-formatter-enable --}}
    <form action="{{ route('kelola-struktur-organisasi.store') }}" enctype="multipart/form-data" id="form" method="post">
        @csrf
        <div>
            <label for="foto-struktur-organisasi">Foto Struktur Organisasi</label>
            <input accept="image/jpg, image/png, image/jpeg" id="foto-struktur-organisasi" name="foto-struktur-organisasi" type="file">
            @error('foto-struktur-organisasi')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

    </form>
    <div>
        <button form="form" type="submit">Buat</button>
    </div>
@endsection
