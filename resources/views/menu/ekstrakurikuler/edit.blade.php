@extends('layouts/preset')
@section('judul', 'Ubah Ekstrakurikuler')
@section('konten')
    <div>
        <a href="{{ route('kelola-ekstrakurikuler.show', $Ekstrakurikuler->id) }}">Kembali</a>
    </div>
    {{-- blade-formatter-disable --}}
        @if (session()->has('message'))
            <div @class(['p-4', 'font-bold' => session()->get('isActive'), 'text-gray-500' => !session()->get('isActive'), 'bg-red' => session()->get('hasError'),])>
                {{ session()->get('message') }}
            </div>
        @endif
    {{-- blade-formatter-enable --}}
    <form action="{{ route('kelola-ekstrakurikuler.update', $Ekstrakurikuler->id) }}" enctype="multipart/form-data" id="ekstrakurikuler-edit" method="post">
        @csrf
        @method('put')
        <div>
            <label for="nama-ekskul">Nama Ekstrakurikuler</label>
            <input id="nama-ekskul" name="nama-ekskul" type="text" value="{{ old('nama-ekskul', $Ekstrakurikuler->nama) }}">
        </div>
        @error('nama-ekskul')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div>
            <label for="deskripsi">Deskripsi</label>
            <textarea id="deskripsi" name="deskripsi">{{ old('deskripsi', $Ekstrakurikuler->deskripsi) }}</textarea>
        </div>
        @error('deskripsi')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div>
            <label for="foto-struktur">Foto Struktur</label>
            <input accept="image/jpg, image/png, image/jpeg" id="foto-struktur" name="foto-struktur" type="file">
        </div>
        @error('foto-struktur')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div>
            <label for="foto-kegiatan">Foto Kegiatan</label>
            <input accept="image/jpg, image/png, image/jpeg" id="foto-kegiatan" multiple name="foto-kegiatan[]" type="file">
        </div>
        @error('foto-kegiatan')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div>
            <button type="submit">Buat</button>
        </div>
    </form>
@endsection
