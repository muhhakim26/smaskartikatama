<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1" name="viewport">
        <meta content="{{ csrf_token() }}" name="csrf-token">
        <title>SMASKARTIKATAMA | @yield('judul')</title>
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        @stack('css')
    </head>

    <body>
        @if (Str::startsWith(Route::currentRouteName(), 'dashboard'))
            ini navigasi admin
        @endif
        @yield('konten')

        @stack('js')
    </body>

</html>
