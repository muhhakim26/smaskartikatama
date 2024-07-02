@extends('layouts.preset')
@section('judul', 'Deskripsi Admin')

@section('konten')
    <div>
        <a href="{{ route('admin.index') }}">Kembali</a>
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
            <td>{{ $Admin->nama }}</td>
        </tr>
        <tr>
            <td align="right">Email :</td>
            <td>{{ $Admin->email }}</td>
        </tr>
        <tr>
            <td align="right">Level :</td>
            <td>{{ $Admin->level }}</td>
        </tr>
        <tr>
            <td align="right">Dibuat :</td>
            <td>{{ $Admin->created_at }}</td>
        </tr>
        <tr>
            <td align="right">Diubah :</td>
            <td>{{ $Admin->updated_at }}</td>
        </tr>
    </table>

    <div>
        <a href="{{ route('admin.edit', $Admin->id) }}">Ubah</a>
        <a href="{{ route('admin.destroy', $Admin->id) }}" onclick="event.preventDefault();document.getElementById('delete-form-{{ $Admin->id }}').submit();">Hapus</a>
        <form action="{{ route('admin.destroy', $Admin->id) }}" id="delete-form-{{ $Admin->id }}" method="POST" style="display:inline;" style="display: none;">
            @csrf
            @method('delete')
        </form>
    </div>
@endsection
