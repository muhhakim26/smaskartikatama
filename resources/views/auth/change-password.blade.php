@extends('layouts/preset')
@section('judul', 'Ubah Kata Sandi')
@section('konten')
    <h1>Halaman Ubah Sandi</h1>
    <form action="{{ route('admin.ubah-sandi.update', ['id' => auth()->user()->id]) }}" id="ubah-sandi" method="post">
        @csrf
        @method('put')
        <div>
            <label for="kata-sandi-lama">Password Lama</label>
            <input id="kata-sandi-lama" name="kata-sandi-lama" required type="text">
        </div>
        @error('kata-sandi-lama')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div>
            <label for="kata-sandi-baru">Password Baru</label>
            <input id="kata-sandi-baru" name="kata-sandi-baru" required type="text">
        </div>
        @error('kata-sandi-baru')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div>
            <label for="kata-sandi-baru_confirmation">Konfirmasi Password Baru</label>
            <input id="kata-sandi-baru_confirmation" name="kata-sandi-baru_confirmation" required type="text">
        </div>
        @error('kata-sandi-baru_confirmation')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <button type="submit">Ubah</button>
    </form>
@endsection
