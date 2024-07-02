@extends('layouts/preset')
@section('judul', 'Ubah Video')

@section('konten')
    <div>
        <a href="{{ route('kelola-galeri-video.index') }}">Kembali</a>
    </div>
    {{-- blade-formatter-disable --}}
        @if (session()->has('message'))
            <div @class(['p-4', 'font-bold' => session()->get('isActive'), 'text-gray-500' => !session()->get('isActive'), 'bg-red' => session()->get('hasError'),])>
                {{ session()->get('message') }}
            </div>
        @endif
    {{-- blade-formatter-enable --}}
    <form action="{{ route('kelola-galeri-video.update', $GaleriVideo->id) }}" enctype="multipart/form-data" id="galeri-video-edit" method="post">
        @csrf
        @method('put')
        <div>
            <label for="judul-video">Nama Video</label>
            <input id="judul-video" name="judul-video" type="text" value="{{ old('judul-video', $GaleriVideo->judul_video) }}">
        </div>
        @error('judul-video')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div>
            <label for="keluku">Keluku</label>
            <input accept="image/jpg, image/png, image/jpeg" id="keluku" name="keluku" type="file">
        </div>
        @error('keluku')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div>
            <label for="link-video">Link Video</label>
            <input id="link-video" name="link-video" type="text" value="{{ old('link-video', $GaleriVideo->file_video) }}">
        </div>
        @error('link-video')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div>
            <button type="submit">Buat</button>
        </div>
    </form>
@endsection
