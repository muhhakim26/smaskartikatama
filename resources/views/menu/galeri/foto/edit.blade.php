@extends('layouts/preset')
@section('judul', 'Ubah Foto')

@section('konten')
    <div>
        <a href="{{ route('kelola-galeri-foto.index') }}">Kembali</a>
    </div>
    {{-- blade-formatter-disable --}}
        @if (session()->has('message'))
            <div @class(['p-4', 'font-bold' => session()->get('isActive'), 'text-gray-500' => !session()->get('isActive'), 'bg-red' => session()->get('hasError'),])>
                {{ session()->get('message') }}
            </div>
        @endif
    {{-- blade-formatter-enable --}}
    <form action="{{ route('kelola-galeri-foto.update', $GaleriFoto->id) }}" enctype="multipart/form-data" id="galeri-foto-edit" method="post">
        @csrf
        @method('put')
        <div>
            <label for="nama-foto">Nama Foto</label>
            <input id="nama-foto" name="nama-foto" type="text" value="{{ old('nama-foto', $GaleriFoto->nama_foto) }}">
        </div>
        @error('nama-foto')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div>
            <label for="foto">Foto</label>
            <input accept="image/jpg, image/png, image/jpeg" id="foto" name="foto" type="file">
        </div>
        @error('foto')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div>
            <button type="submit">Buat</button>
        </div>
    </form>
@endsection
