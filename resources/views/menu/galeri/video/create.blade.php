@extends('layouts/preset')
@section('judul', 'Buat Video')

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
    <form action="{{ route('kelola-galeri-video.store') }}" enctype="multipart/form-data" id="galeri-video-create" method="post">
        @csrf
        <div>
            <label for="judul-video">Judul Video</label>
            <input id="judul-video" name="judul-video" type="text" value="{{ old('judul-video') }}">
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
            <input id="link-video" name="link-video" type="text" value="{{ old('link-video') }}">
        </div>
        @error('link-video')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div>
            <button type="submit">Buat</button>
        </div>
    </form>
@endsection
