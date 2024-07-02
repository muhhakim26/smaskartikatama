@extends('layouts/preset')
@section('judul', 'Buat Data Guru')
@push('css')
    <style>
        /* Chrome, Safari, Edge, Opera */
        input#nip-guru::-webkit-outer-spin-button,
        input#nip-guru::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number]#nip-guru {
            -moz-appearance: textfield;
        }
    </style>
@endpush
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
    <form action="{{ route('kelola-data-guru.store') }}" enctype="multipart/form-data" id="dataguru-create" method="post">
        @csrf
        <div>
            <label for="nama-guru">Nama Guru</label>
            <input id="nama-guru" name="nama-guru" type="text" value="{{ old('nama-guru') }}">
        </div>
        @error('nama-guru')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div>
            <label for="nip-guru">Nomor Induk Pegawai (NIP)</label>
            <input id="nip-guru" name="nip-guru" required type="number" value="{{ old('nip-guru') }}">
        </div>
        @error('nip-guru')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div>
            <label for="bidang-guru">Bidang</label>
            <input id="bidang-guru" name="bidang-guru" type="text" value="{{ old('bidang-guru') }}">
        </div>
        @error('bidang-guru')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div>
            <label for="jabatan-guru">Jabatan</label>
            <input id="jabatan-guru" name="jabatan-guru" type="text" value="{{ old('jabatan-guru') }}">
        </div>
        @error('jabatan-guru')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div>
            <label for="foto-guru">Foto Guru</label>
            <input accept="image/jpg, image/png, image/jpeg" id="foto-guru" name="foto-guru" type="file">
        </div>
        @error('foto-guru')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div>
            <button type="submit">Buat</button>
        </div>
    </form>
@endsection
@push('js')
    <script>
        const $input = $('input#nip-guru');

        let $valueBeforeInput = $input.val();
        $input.on('input', function(event) {
            if ($(this).val().length > 18) {
                $(this).val($valueBeforeInput);
            }
            $valueBeforeInput = $(this).val();
        });
    </script>
@endpush
