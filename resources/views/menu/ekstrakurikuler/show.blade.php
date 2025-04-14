@extends('layouts/preset')
@section('judul', 'Deskripsi Ekstrakurikuler')

@section('konten')
    <div>
        <a href="{{ route('kelola-ekstrakurikuler.index') }}">Kembali</a>
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
            <td align="right">Nama :</td>
            <td>{{ $Ekstrakurikuler->nama }}</td>
        </tr>
        <tr>
            <td align="right">Deskripsi :</td>
            <td>{{ $Ekstrakurikuler->deskripsi }}</td>
        </tr>
        <tr>
            <td align="right">Struktur :</td>
            <td>{{ $Ekstrakurikuler->foto_struktur }}</td>
        </tr>
        <tr>
            <td align="right">Kegiatan :</td>
            <td>
                <ul>
                    @foreach (json_decode($Ekstrakurikuler->foto_kegiatan) as $key => $value)
                        <li><img alt="{{ $key++ }}" src="{{ asset('img/' . $value) }}"></li>
                    @endforeach
                </ul>
            </td>
        </tr>
        <tr>
            <td align="right">Dibuat :</td>
            <td>{{ $Ekstrakurikuler->created_at }}</td>
        </tr>
        <tr>
            <td align="right">Diubah :</td>
            <td>{{ $Ekstrakurikuler->updated_at }}</td>
        </tr>
    </table>

    <div>
        <a href="{{ route('kelola-ekstrakurikuler.edit', $Ekstrakurikuler->id) }}">Ubah</a>
        <a href="{{ route('kelola-ekstrakurikuler.destroy', $Ekstrakurikuler->id) }}" onclick="event.preventDefault();document.getElementById('delete-form-{{ $Ekstrakurikuler->id }}').submit();">Hapus</a>
        <form action="{{ route('kelola-ekstrakurikuler.destroy', $Ekstrakurikuler->id) }}" id="delete-form-{{ $Ekstrakurikuler->id }}" method="POST" style="display:inline;" style="display: none;">
            @csrf
            @method('delete')
        </form>
    </div>
@endsection
