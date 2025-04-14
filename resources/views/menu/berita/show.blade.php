@extends('layouts/preset')
@section('judul', 'Deskripsi Berita')

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
    <table border="0" cellpadding="5" cellspacing="0">
        <tr>
            <td align="right">Judul :</td>
            <td>{{ $Berita->judul }}</td>
        </tr>
        <tr>
            <td align="right">Deskripsi :</td>
            <td>{!! $Berita->deskripsi !!}</td>
        </tr>
        <tr>
            <td align="right">Foto :</td>
            <td><img alt="{{ $Berita->judul }}" src="{{ asset('img/' . $Berita->file_foto) }}"></td>
        </tr>

        <tr>
            <td align="right">Dibuat :</td>
            <td>{{ $Berita->created_at }}</td>
        </tr>
        <tr>
            <td align="right">Diubah :</td>
            <td>{{ $Berita->updated_at }}</td>
        </tr>
    </table>

    <div>
        <a href="{{ route('kelola-berita.edit', $Berita->id) }}">Ubah</a>
        <a href="{{ route('kelola-berita.destroy', $Berita->id) }}" onclick="event.preventDefault();document.getElementById('delete-form-{{ $Berita->id }}').submit();">Hapus</a>
        <form action="{{ route('kelola-berita.destroy', $Berita->id) }}" id="delete-form-{{ $Berita->id }}" method="POST" style="display:inline;" style="display: none;">
            @csrf
            @method('delete')
        </form>
    </div>
@endsection
