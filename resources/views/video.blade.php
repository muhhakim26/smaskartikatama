@extends('layouts/preset')
@section('judul', 'Galeri Video')
@section('konten')
    @if (!empty($Video))
        <div>
            @foreach ($Video as $key => $value)
                <img alt="{{ $value->judul_video }}" src="{{ asset('img/' . $value->thumbnail) }}">
            @endforeach
        </div>
    @endif
@endsection
