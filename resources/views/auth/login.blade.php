@extends('layouts/preset')
@section('judul', 'Masuk')
@push('style')
    <link href="{{ asset('assets/css/iofrm-style.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/iofrm-theme7.css') }}" rel="stylesheet" type="text/css">
    <style>
        .bg-login {
            background-image: url("{{ asset('assets/images/bgloginadmin.png') }}");
            background-size: cover;
            background-position: center;
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
        }

        .website-logo img {
            width: 200px;
            height: auto;
        }
    </style>
@endpush
@section('konten')
    <div class="form-body">
        <div class="website-logo">
            <div class="website-logo">
                <a href="{{ route('home') }}">
                    <div>
                        <img alt="" src="{{ asset('assets/images/logo-smas-kartikatama-metro.svg') }}">
                    </div>
                </a>
            </div>

        </div>
        <div class="iofrm-layout">
            <div class="img-holder">
                <div class="bg-login"></div>
                {{-- <div class="info-holder">
                    <img alt="" src="{{ asset('assets/images/bgloginadmin.jpg') }}">
                </div> --}}
            </div>
            <div class="form-holder">
                <div class="form-content">
                    <div class="form-items">
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
                            <label for="surel">Email</label>
                            <input class="form-control" id="surel" name="surel" required type="email">
                            @error('surel', 'login')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <label for="kata-sandi">Password</label>
                            <input class="form-control" id="kata-sandi" name="kata-sandi" required type="password">
                            <div class="form-button">
                                <button class="ibtn" type="submit">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
