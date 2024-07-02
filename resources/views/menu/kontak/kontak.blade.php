@extends('layouts/preset')
@section('judul', 'Kelola Kontak')
@section('konten')
    <div>
        <a href="{{ route('dashboard') }}">Kembali</a>
    </div>
    <h1>Kontak</h1>
    {{-- blade-formatter-disable --}}
        @if (session()->has('message'))
            <div @class(['p-4', 'font-bold' => session()->get('isActive'), 'text-gray-500' => !session()->get('isActive'), 'bg-red' => session()->get('hasError'),])>
                {{ session()->get('message') }}
            </div>
        @endif
    {{-- blade-formatter-enable --}}
    <form action="{{ route('kelola-kontak.store') }}" id="form" method="post">
        @csrf
        <div>
            <label for="alamat">Alamat</label>
            <textarea id="alamat" id="alamat" name="alamat">{{ old('isi', empty($Kontak->alamat) ? '' : $Kontak->alamat) }}</textarea>
        </div>
        <div>
            <label for="no-telepon">No Telepon</label>
            <input id="no-telepon" name="no-telepon" pattern="^[0-9\-\+\s\(\)]*$" type="tel" value="{{ old('no-telepon', empty($Kontak->notelpon) ? '' : $Kontak->notelpon) }}">
        </div>
        @error('no-telepon')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div>
            <label for="email">Email</label>
            <input id="email" name="email" type="email" value="{{ old('email', empty($Kontak->email) ? '' : $Kontak->email) }}">
        </div>
        @error('email')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <button type="submit">Buat</button>

    </form>
@endsection
@push('js')
    <script>
        const $input = $('input#no-telepon');
        $input.on('keypress', function(event) {
            const regex = /^[0-9\-\+\s\(\)]*$/;
            let angka = event.keyCode;
            console.log(angka);
            if (regex.test($(this).val()) && (angka >= 48 && angka <= 57) || (angka == 32 || angka == 40 || angka == 41 || angka == 43 || angka == 45))
                return true;
            return false;
        });
        $input.on('blur', function() {
            $(this).val($(this).val().trim());
        });
    </script>
@endpush
