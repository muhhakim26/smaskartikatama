@extends('layouts/preset')
@section('judul', 'Kelola Kontak')
@section('konten')
    <div class="row gy-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h6 class="fw-semibold mb-0">Kontak Form</h6>
                </div>
                <div class="card-body">
                    {{-- blade-formatter-disable --}}
                    @if (session()->has('message'))
                        @if(session()->get('hasError'))
                            <div class="alert alert-danger bg-danger-100 text-danger-600 border-danger-600 border-start-width-4-px border-top-0 border-end-0 border-bottom-0 px-24 py-13 mb-0 fw-semibold text-lg radius-4 d-flex align-items-center justify-content-between" role="alert">
                                <div class="d-flex align-items-center gap-2">
                                    <iconify-icon icon="ep:warning-filled" class="icon text-xl"></iconify-icon>
                                    {{ session()->get('message') }}
                                </div>
                                <button class="remove-button text-danger-600 text-xxl line-height-1">
                                    <iconify-icon icon="iconamoon:sign-times-light" class="icon"></iconify-icon>
                                </button>
                            </div>
                       @else
                            <div class="alert alert-success bg-success-100 text-success-600 border-success-600 border-start-width-4-px border-top-0 border-end-0 border-bottom-0 px-24 py-13 mb-0 fw-semibold text-lg radius-4 d-flex align-items-center justify-content-between" role="alert">
                                <div class="d-flex align-items-center gap-2">
                                    <iconify-icon icon="ep:success-filled" class="icon text-xl"></iconify-icon>
                                        {{ session()->get('message') }}
                                </div>
                                <button class="remove-button text-success-600 text-xxl line-height-1">
                                    <iconify-icon icon="iconamoon:sign-times-light" class="icon"></iconify-icon>
                                </button>
                            </div>
                         @endif
                    @endif
                    {{-- blade-formatter-enable --}}
                    <form action="{{ route('kelola-kontak.store') }}" autocomplete="off" class="d-flex flex-column mt-20 gap-20" id="form" method="post">
                        @csrf
                        <div>
                            <label class="form-label fw-bold text-neutral-900" for="no-telepon">No. Telepon</label>
                            <input class="form-control" id="no-telepon" name="no-telepon" pattern="^[0-9\-\+\s\(\)]*$" type="tel" value="{{ old('no-telepon', empty($Kontak->notelpon) ? '' : $Kontak->notelpon) }}">
                            @error('no-telepon')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <label class="form-label fw-bold text-neutral-900" for="email">Email</label>
                            <input class="form-control" id="email" name="email" type="email" value="{{ old('email', empty($Kontak->email) ? '' : $Kontak->email) }}">
                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <label class="form-label fw-bold text-neutral-900" for="alamat">Alamat</label>
                            <textarea class="form-control" id="alamat" id="alamat" name="alamat">{{ old('isi', empty($Kontak->alamat) ? '' : $Kontak->alamat) }}</textarea>
                            @error('alamat')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <label class="form-label fw-bold text-neutral-900" for="gmpas">Gmaps</label>
                            <input class="form-control" id="gmaps" name="gmaps" type="text" value="{{ old('gmaps', empty($Kontak->gmaps) ? '' : $Kontak->gmaps) }}">
                            @error('gmaps')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="d-flex justify-content-end">
                            <button class="btn btn-primary-600 px-32" type="submit">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
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
