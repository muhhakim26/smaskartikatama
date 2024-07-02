@extends('layouts.preset')
@section('judul', 'Buat Admin')
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
    <form action="{{ route('admin.store') }}" id="admin-create" method="post">
        @csrf
        <div>
            <input name="nama-lengkap" type="text">
        </div>
        @error('nama-lengkap')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div>
            <input name="surel" type="email">
        </div>
        @error('surel')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div>
            <select name="role">
                <option @selected(old('role', 'admin') == 'admin') value="admin">Admin</option>
            </select>
        </div>
        @error('role')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div>
            <input name="kata-sandi" type="password">
        </div>
        @error('password')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div>
            <button type="submit">Buat</button>
        </div>
    </form>
@endsection
