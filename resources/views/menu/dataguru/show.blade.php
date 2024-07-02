@extends('layouts/preset')
@section('judul', 'Deskripsi Data Guru')

@section('konten')
    <div>
        <a href="{{ route('kelola-data-guru.index') }}">Kembali</a>
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
            <td>{{ $DataGuru->nama }}</td>
        </tr>
        <tr>
            <td align="right">NIP :</td>
            <td>{{ $DataGuru->nip }}</td>
        </tr>
        <tr>
            <td align="right">Jabatan :</td>
            <td>{{ $DataGuru->jabatan }}</td>
        </tr>
        <tr>
            <td align="right">Bidang :</td>
            <td>{{ $DataGuru->bidang }}</td>
        </tr>
        <tr>
            <td align="right">Foto :</td>
            <td><img alt="{{ $DataGuru->nama }}" src="{{ asset('img/' . $DataGuru->file_foto) }}"></td>
        </tr>

        <tr>
            <td align="right">Dibuat :</td>
            <td>{{ $DataGuru->created_at }}</td>
        </tr>
        <tr>
            <td align="right">Diubah :</td>
            <td>{{ $DataGuru->updated_at }}</td>
        </tr>
    </table>

    <div>
        <a href="{{ route('kelola-data-guru.edit', $DataGuru->id) }}">Ubah</a>
        <a href="{{ route('kelola-data-guru.destroy', $DataGuru->id) }}" onclick="event.preventDefault();document.getElementById('delete-form-{{ $DataGuru->id }}').submit();">Hapus</a>
        <form action="{{ route('kelola-data-guru.destroy', $DataGuru->id) }}" id="delete-form-{{ $DataGuru->id }}" method="POST" style="display:inline;" style="display: none;">
            @csrf
            @method('delete')
        </form>
    </div>
@endsection
