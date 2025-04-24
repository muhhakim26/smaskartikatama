@extends('layouts.preset')
@section('judul', 'Ubah Admin')
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
                        <form action="{{ route('kelola-admin.update', $Admin->id) }}" autocomplete="off" id="admin-edit" method="post">
                            @csrf
                            @method('put')
                        </form>
                        <div class="col-12">
                            <label class="form-label" id="nama-lengkap">Nama Lengkap</label>
                            <input class="form-control" form="admin-edit" id="nama-lengkap" name="nama-lengkap" type="text" value="{{ old('nama-lengkap', $Admin->nama) }}">
                            @error('nama-lengkap')
                                <div class="text-danger">{{ $message }} </div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label class="form-label" id="surel">Email</label>
                            <input class="form-control" form="admin-edit" id="surel" name="surel" type="email" value="{{ old('surel', $Admin->email) }}">
                            @error('surel')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label class="form-label" for="role">Role</label>
                            <select class="form-select" form="admin-edit" id="role" name="role">
                                <option @selected(old('role', $Admin->level) == 'admin') value="admin">Admin</option>
                                <option @selected(old('role', $Admin->level) == 'superadmin') value="superadmin">Superadmin</option>
                            </select>
                            @error('role')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label class="form-label" for="kata-sandi-lama">Sandi Lama</label>
                            <div class="position-relative">
                                <input class="form-control" form="admin-edit" id="kata-sandi-lama" name="kata-sandi-lama" type="password">
                                <span class="toggle-password ri-eye-line ri-eye-off-line position-absolute top-50 translate-middle-y text-secondary-light end-0 me-16 cursor-pointer" data-toggle="#kata-sandi-lama"></span>
                            </div>
                            @error('kata-sandi-lama')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label class="form-label" for="kata-sandi-baru">Sandi Baru</label>
                            <div class="position-relative">
                                <input class="form-control" form="admin-edit" id="kata-sandi-baru" name="kata-sandi-baru" type="password">
                                <span class="toggle-password ri-eye-line ri-eye-off-line position-absolute top-50 translate-middle-y text-secondary-light end-0 me-16 cursor-pointer" data-toggle="#kata-sandi-baru"></span>
                            </div>
                            @error('kata-sandi-baru')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label class="form-label" for="kata-sandi-baru_confirmation">Konfirmasi Sandi</label>
                            <div class="position-relative">
                                <input class="form-control" form="admin-edit" id="kata-sandi-baru_confirmation" name="kata-sandi-baru_confirmation" type="password">
                                <span class="toggle-password ri-eye-line ri-eye-off-line position-absolute top-50 translate-middle-y text-secondary-light end-0 me-16 cursor-pointer" data-toggle="#kata-sandi-baru_confirmation"></span>
                            </div>
                            @error('kata-sandi-baru_confirmation')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12 d-flex justify-content-end">
                            <button class="btn btn-primary-600 me-1 px-32" form="admin-edit" type="submit">Ubah</button>
                            <a class="btn btn-neutral-400 px-32" href="{{ route('kelola-admin.index') }}">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        function initializePasswordToggle(toggleSelector) {
            $(toggleSelector).on("click", function() {
                $(this).toggleClass("ri-eye-off-line");
                var input = $($(this).attr("data-toggle"));
                if (input.attr("type") === "password") {
                    input.attr("type", "text");
                } else {
                    input.attr("type", "password");
                }
            });
        }
        // Call the function
        initializePasswordToggle(".toggle-password");
    </script>
@endpush
