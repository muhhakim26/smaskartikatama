@extends('layouts/preset')
@section('judul', 'Kelola Visi Misi')
@section('konten')
    <div>
        <a href="{{ route('dashboard') }}">Kembali</a>
    </div>
    <h1>Visi Misi</h1>
    {{-- blade-formatter-disable --}}
        @if (session()->has('message'))
            <div @class(['p-4', 'font-bold' => session()->get('isActive'), 'text-gray-500' => !session()->get('isActive'), 'bg-red' => session()->get('hasError'),])>
                {{ session()->get('message') }}
            </div>
        @endif
    {{-- blade-formatter-enable --}}
    <form action="{{ route('kelola-visi-misi.store') }}" id="form" method="post">
        @csrf
        <div>
            <textarea id="isi" name="isi">{{ old('isi', empty($VisiMisi->deskripsi) ? '' : $VisiMisi->deskripsi) }}</textarea>
        </div>

    </form>
    <div>
        <button form="form" type="submit">Buat</button>
        <button onclick="document.getElementById('isi').value = ''">Ulang</button>
    </div>
@endsection
