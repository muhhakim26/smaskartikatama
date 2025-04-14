@extends('layouts.preset')
@section('judul', 'Buat Admin')
@section('konten')
    <div class="row gy-4">
        <div class="col-md-6">
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
                    <div class="row gy-3">
                        <form action="{{ route('kelola-admin.store') }}" autocomplete="off" id="admin-create" method="post">
                            @csrf
                        </form>
                        <div class="col-12">
                            <label class="form-label" id="nama-lengkap">Nama Lengkap</label>
                            <input class="form-control" form="admin-create" id="nama-lengkap" name="nama-lengkap" type="text" value="{{ old('nama-lengkap') }}">
                            @error('nama-lengkap')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label class="form-label" id="surel">Email</label>
                            <input class="form-control" form="admin-create" id="surel" name="surel" type="email" value="{{ old('surel') }}">
                            @error('surel')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label class="form-label" for="role">Role</label>
                            <select class="form-select" form="admin-create" id="role" name="role">
                                <option @selected(old('role', 'admin') == 'admin') value="admin">Admin</option>
                            </select>
                            @error('role')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label class="form-label" for="kata-sandi">Kata Sandi</label>
                            <input class="form-control" form="admin-create" id="kata-sandi" name="kata-sandi" type="password">
                            @error('kata-sandi')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12 d-flex justify-content-end">
                            <button class="btn btn-primary-600 me-1 px-32" form="admin-create" type="submit">Simpan</button>
                            <a class="btn btn-neutral-400 px-32" href="{{ route('kelola-admin.index') }}">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
