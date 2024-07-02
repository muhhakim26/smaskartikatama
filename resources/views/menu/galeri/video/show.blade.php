@extends('layouts/preset')
@section('judul', 'Deskripsi Video')

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
    <table border="0" cellpadding="5" cellspacing="0">
        <tr>
            <td align="right">Judul Video :</td>
            <td>{{ $GaleriVideo->judul_video }}</td>
        </tr>
        <tr>
            <td align="right">Keluku :</td>
            <td><img alt="{{ $GaleriVideo->judul_video }}" src="{{ asset('img/' . $GaleriVideo->thumbnail) }}"></td>
        </tr>

        <tr>
            <td align="right">Dibuat :</td>
            <td>{{ $GaleriVideo->created_at }}</td>
        </tr>
        <tr>
            <td align="right">Diubah :</td>
            <td>{{ $GaleriVideo->updated_at }}</td>
        </tr>
    </table>

    <div>
        <a href="{{ route('kelola-galeri-video.edit', $GaleriVideo->id) }}">Ubah</a>
        <a href="{{ route('kelola-galeri-video.destroy', $GaleriVideo->id) }}" onclick="event.preventDefault();document.getElementById('delete-form-{{ $GaleriVideo->id }}').submit();">Hapus</a>
        <form action="{{ route('kelola-galeri-video.destroy', $GaleriVideo->id) }}" id="delete-form-{{ $GaleriVideo->id }}" method="POST" style="display:inline;" style="display: none;">
            @csrf
            @method('delete')
        </form>
    </div>
@endsection
