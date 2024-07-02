@extends('layouts/preset')
@section('judul', 'Buat Osis')

@section('konten')
    <div>
        <a href="{{ route('dashboard') }}">Kembali</a>
    </div>
    {{-- blade-formatter-disable --}}
        @if (session()->has('message'))
            <div @class(['p-4', 'font-bold' => session()->get('isActive'), 'text-gray-500' => !session()->get('isActive'), 'bg-red' => session()->get('hasError'),])>
                {{ session()->get('message') }}
            </div>
        @endif
    {{-- blade-formatter-enable --}}
    <form action="{{ route('kelola-osis.store') }}" enctype="multipart/form-data" id="osis-create" method="post">
        @csrf
        <div>
            <label for="deskripsi-osis">Deskripsi</label>
            <textarea id="deskripsi-osis" name="deskripsi-osis">{{ old('deskripsi-osis', empty($OSIS->deskripsi) ? '' : $OSIS->deskripsi) }}</textarea>
        </div>
        @error('deskripsi-osis')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div>
            <label for="foto-struktur-osis">Foto Struktur OSIS</label>
            <input accept="image/jpg, image/png, image/jpeg" id="foto-struktur-osis" name="foto-struktur-osis" type="file">
            @if (!empty($OSIS->foto_struktur))
                <div>
                    <img alt="struktur osis" src="{{ asset('img/' . $OSIS->foto_struktur) }}">
                </div>
            @endif
        </div>
        @error('foto-struktur-osis')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div>
            <button type="submit">Buat</button>
        </div>
    </form>
@endsection
