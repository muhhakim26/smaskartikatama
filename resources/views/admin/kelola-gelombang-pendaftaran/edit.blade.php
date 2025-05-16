@extends('layouts.admin.preset')
@section('judul', 'Kelola Gelombang Pendaftaran')
@push('style')
    <!-- style untuk kolom serach -->
    <style>
        div.dt-container .dt-search input {
            text-align: left
        }
    </style>
@endpush
@section('konten')
    <div class="card">
        <div class="card-header">
            <h6 class="fw-semibold mb-0">Input Form</h6>
        </div>
        <div class="card-body">
            {{-- blade-formatter-disable --}}
                @if (session()->has('message'))
                    <div class="alert alert-danger bg-danger-100 text-danger-600 border-danger-600 border-start-width-4-px border-top-0 border-end-0 border-bottom-0 px-24 py-13 mb-0 fw-semibold text-lg radius-4 d-flex align-items-center justify-content-between" role="alert">
                        <div class="d-flex align-items-center gap-2">
                            <iconify-icon icon="ep:warning-filled" class="icon text-xl"></iconify-icon>
                            {{ session()->get('message') }}
                        </div>
                        <button class="remove-button text-danger-600 text-xxl line-height-1">
                            <iconify-icon icon="iconamoon:sign-times-light" class="icon"></iconify-icon>
                        </button>
                    </div>
                @endif
            {{-- blade-formatter-enable --}}
            <form action="{{ route('kelola-gelombang-pendaftaran.update', $Gelombang->id) }}" id="gelombang-edit" method="post">
                @csrf
                @method('put')
                <div class="row flex-column gy-4">
                    <div class="col-md-6 col-12">
                        <label class="form-label fw-bold text-neutral-900" id="gelombang-pendaftaran">Batch</label>
                        <input class="form-control" id="gelombang-pendaftaran" name="gelombang-pendaftaran" readonly type="text" value="{{ $Gelombang->id }}">
                        @error('gelombang-pendaftaran')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 col-12">
                        <label class="form-label fw-bold text-neutral-900" id="tahun-ajaran">Tahun Ajaran</label>
                        <input class="form-control tahun-ajaran" id="tahun-ajaran" name="tahun-ajaran" type="text" value="{{ old('tahun-ajaran', $Gelombang->tahun_ajaran) }}">
                        @error('tahun-ajaran')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 col-12">
                        <label class="form-label fw-bold text-neutral-900" id="kuota-pendaftaran">Kuota Pendaftaran</label>
                        <input class="form-control" id="kuota-pendaftaran" name="kuota-pendaftaran" onkeypress="return hanyaAngka(event)" type="text" value="{{ old('kuota-pendaftaran', $Gelombang->kuota_pendaftaran) }}">
                        @error('kuota-pendaftaran')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 col-12">
                        <label class="form-label fw-bold text-neutral-900" id="tanggal-dibuka">Tanggal Dibuka</label>
                        <input class="form-control" id="tanggal-dibuka" name="tanggal-dibuka" type="date" value="{{ old('tanggal-dibuka', $Gelombang->tanggal_dibuka) }}">
                        @error('tanggal-dibuka')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 col-12">
                        <label class="form-label fw-bold text-neutral-900" id="tanggal-ditutup">Tanggal Ditutup</label>
                        <input class="form-control" id="tanggal-ditutup" name="tanggal-ditutup" type="date" value="{{ old('tanggal-ditutup', $Gelombang->tanggal_ditutup) }}">
                        @error('tanggal-ditutup')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 col-12">
                        <label class="form-label fw-bold text-neutral-900" id="tanggal-diumumkan">Tanggal Diumumkan</label>
                        <input class="form-control" id="tanggal-diumumkan" name="tanggal-diumumkan" type="date" value="{{ old('tanggal-diumumkan', $Gelombang->tanggal_diumumkan) }}">
                        @error('tanggal-diumumkan')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 col-12">
                        <label class="form-label fw-bold text-neutral-900" for="catatan">Catatan</label>
                        <textarea class="form-control" id="catatan" name="catatan" rows="3">{{ old('catatan', $Gelombang->catatan) }}</textarea>
                    </div>
                    <div class="col-md-6 col-12">
                        <label class="form-label fw-bold text-neutral-900" id="link-grup">Link Grup</label>
                        <input class="form-control" id="link-grup" name="link-grup" type="text" value="{{ old('link-grup', $Gelombang->link_grup) }}">
                        @error('link-grup')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 col-12">
                        <button class="btn btn-primary-600 me-1 px-32" type="submit">Simpan</button>
                        <a class="btn btn-neutral-400 px-32" href="{{ route('kelola-gelombang-pendaftaran.index') }}">Kembali</a>
                    </div>
                </div>
            </form>
        </div>
    @endsection

    @push('script')
        <script>
            $('.tahun-ajaran').inputmask("9999/9999");
        </script>
        <script>
            function hanyaAngka(event) {
                var angka = (event.which) ? event.which : event.keyCode
                if (angka != 46 && angka > 31 && (angka < 48 || angka > 57))
                    return false;
                return true;
            };
        </script>
    @endpush
