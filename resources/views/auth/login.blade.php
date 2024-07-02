@extends('layouts/preset')
@section('judul', 'Masuk')
@section('konten')
    <h1>Halaman Login</h1>
    {{-- @php
        echo $errors;
        echo session('message');
    @endphp --}}
    @if ($errors->has('status'))
        @foreach ($errors->get('status') as $value)
            <div>
                {{ $value }}
            </div>
        @endforeach
    @endif
    @if (session()->has('status'))
        <div>
            {{ session('status') }}
        </div>
    @endif
    {{ session('message') }}
    <form action="{{ route('admin.login') }}" id="login" method="post">
        @csrf
        <div>
            <label for="surel">Email</label>
            <input id="surel" name="surel" type="email">
        </div>
        @error('surel', 'login')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div>
            <label for="kata-sandi">Password</label>
            <input id="kata-sandi" name="kata-sandi" type="password">
        </div>
        <div>
            <button type="submit">Login</button>
        </div>
    </form>
@endsection
