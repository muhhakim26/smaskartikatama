@extends('layouts/preset')
@section('judul', 'Ubah Berita')

@section('konten')
    <div>
        <a href="{{ route('kelola-berita.index') }}">Kembali</a>
    </div>
    {{-- blade-formatter-disable --}}
        @if (session()->has('message'))
            <div @class(['p-4', 'font-bold' => session()->get('isActive'), 'text-gray-500' => !session()->get('isActive'), 'bg-red' => session()->get('hasError'),])>
                {{ session()->get('message') }}
            </div>
        @endif
    {{-- blade-formatter-enable --}}
    <form action="{{ route('kelola-berita.update', $Berita->id) }}" enctype="multipart/form-data" id="berita-create" method="post">
        @csrf
        @method('put')
        <div>
            <label for="judul-berita">Judul</label>
            <input id="judul-berita" name="judul-berita" type="text" value="{{ old('judul-berita', $Berita->judul) }}">
        </div>
        @error('judul-berita')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div>
            <label for="deskripsi-berita">Deskripsi</label>
            <textarea id="deskripsi-berita" name="deskripsi-berita">{{ old('deskripsi-berita', $Berita->deskripsi) }}</textarea>
        </div>
        @error('deskripsi-berita')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div>
            <label for="foto-berita">Foto Berita</label>
            <input accept="image/jpg, image/png, image/jpeg" id="foto-berita" name="foto-berita" type="file">
        </div>
        @error('foto-berita')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div>
            <button type="submit">Buat</button>
        </div>
    </form>
@endsection
