@extends('layouts.admin.preset')
@section('judul', 'Deskripsi Foto')

@section('konten')
    <div>
        <a href="{{ route('kelola-galeri-foto.index') }}">Kembali</a>
    </div>
    {{-- blade-formatter-disable --}}
        @if (session()->has('message'))
            <div @class(['p-4', 'font-bold' => session()->get('isActive'), 'text-gray-500' => !session()->get('isActive'), 'bg-red' => session()->get('hasError'),])>
                {{ session()->get('message') }}
            </div>
        @endif
    {{-- blade-formatter-enable --}}
    <table border="0" cellpadding="5" cellspacing="0">
        <tr>
            <td align="right">Nama Foto :</td>
            <td>{{ $GaleriFoto->nama_foto }}</td>
        </tr>
        <tr>
            <td align="right">Foto :</td>
            <td>
                <a class="magnific-image" href="{{ asset('img/' . $GaleriFoto->file_foto) }}" title="{{ Str::title($GaleriFoto->nama_foto) }}">
                    <img alt="{{ $GaleriFoto->nama_foto }}" src="{{ asset('img/' . $GaleriFoto->file_foto) }}">
                </a>
            </td>
        </tr>

        <tr>
            <td align="right">Dibuat :</td>
            <td>{{ $GaleriFoto->created_at }}</td>
        </tr>
        <tr>
            <td align="right">Diubah :</td>
            <td>{{ $GaleriFoto->updated_at }}</td>
        </tr>
    </table>

    <div>
        <a href="{{ route('kelola-galeri-foto.edit', $GaleriFoto->id) }}">Ubah</a>
        <a href="{{ route('kelola-galeri-foto.destroy', $GaleriFoto->id) }}" onclick="event.preventDefault();document.getElementById('delete-form-{{ $GaleriFoto->id }}').submit();">Hapus</a>
        <form action="{{ route('kelola-galeri-foto.destroy', $GaleriFoto->id) }}" id="delete-form-{{ $GaleriFoto->id }}" method="POST" style="display:inline;" style="display: none;">
            @csrf
            @method('delete')
        </form>
    </div>
@endsection

@push('script')
    <script>
        $(".magnific-image").magnificPopup({
            type: "image",
            closeOnContentClick: true,
            mainClass: 'mfp-img-mobile',
            image: {
                verticalFit: true
            },
            zoom: {
                enabled: true,
            }
        });
    </script>
@endpush
