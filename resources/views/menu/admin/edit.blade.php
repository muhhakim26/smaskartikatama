@extends('layouts.preset')
@section('judul', 'Ubah Admin')
@section('konten')
    <div>
        <a href="{{ route('admin.show', $Admin->id) }}">Kembali</a>
    </div>
    {{-- blade-formatter-disable --}}
        @if (session()->has('message'))
            <div @class(['p-4', 'font-bold' => session()->get('isActive'), 'text-gray-500' => !session()->get('isActive'), 'bg-red' => session()->get('hasError'),])>
                {{ session()->get('message') }}
            </div>
        @endif
    {{-- blade-formatter-enable --}}
    <form action="{{ route('admin.update', $Admin->id) }}" id="admin-edit" method="post">
        @csrf
        @method('put')
        <div>
            <input name="nama-lengkap" type="text" value="{{ old('nama-lengkap', $Admin->nama) }}">
        </div>
        @error('nama-lengkap')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div>
            <input name="surel" type="email" value="{{ old('surel', $Admin->email) }}">
        </div>
        @error('surel')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div>
            <select name="role">
                <option @selected(old('role', $Admin->level) == 'admin') value="admin">Admin</option>
            </select>
        </div>
        @error('role')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div>
            <button type="submit">Edit</button>
        </div>
    </form>
@endsection
