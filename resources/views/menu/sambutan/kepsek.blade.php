@extends('layouts.preset')
@section('judul', 'Kelola Sambutan KepSek')
@section('konten')
    <div>
        <a href="{{ route('dashboard') }}">Kembali</a>
    </div>
    <h1>Sambutan Kepala Sekolah</h1>
    {{-- blade-formatter-disable --}}
        @if (session()->has('message'))
            <div @class(['p-4', 'font-bold' => session()->get('isActive'), 'text-gray-500' => !session()->get('isActive'), 'bg-red' => session()->get('hasError'),])>
                {{ session()->get('message') }}
            </div>
        @endif
    {{-- blade-formatter-enable --}}
    <form action="{{ route('kelola-sambutan-kepsek.store') }}" id="form" method="post">
        @csrf
        <div>
            <textarea id="deskripsi-kepsek" name="deskripsi-kepsek">{{ old('deskripsi-kepsek', empty($SambutanKepsek->deskripsi) ? '' : $SambutanKepsek->deskripsi) }}</textarea>
        </div>

    </form>
    <div>
        <button form="form" type="submit">Buat</button>
        <button onclick="document.getElementById('deskripsi-kepsek').value = ''">Ulang</button>
    </div>
@endsection
