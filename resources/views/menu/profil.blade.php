@extends('layouts/preset')
@section('judul', 'Profil')

@section('konten')
    <div class="row gy-4">
        <div class="col-12">
            <div class="card">
                <div class="border-bottom-0 card-header">
                    <h6 class="fw-semibold mb-0">Profil</h6>
                </div>
                <div class="card-body">
                    <ul class="nav border-gradient-tab nav-pills d-inline-flex mb-20" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            {{-- blade-formatter-disable --}}
                            <button @class(['nav-link', 'd-flex', 'align-items-center', 'px-24', 'active' => session()->get('isActive',true)]) data-bs-target="#pills-edit-profile" data-bs-toggle="pill" id="pills-edit-profile-tab" role="tab" type="button">
                                Edit Profile
                            </button>
                            {{-- blade-formatter-enable --}}
                        </li>
                        @can('isSuperAdmin')
                            <li class="nav-item" role="presentation">
                                {{-- blade-formatter-disable --}}
                            <button @class(['nav-link', 'd-flex', 'align-items-center', 'px-24', 'active' => !session()->get('isActive',true)]) data-bs-target="#pills-change-password" data-bs-toggle="pill" id="pills-change-passwork-tab" role="tab" tabindex="-1" type="button">
                                Change Password
                            </button>
                             {{-- blade-formatter-enable --}}
                            </li>
                        @endcan
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        {{-- blade-formatter-disable --}}
                        <div @class([ 'tab-pane', 'fade', 'show active' => session()->get('isActive',true)]) id="pills-edit-profile" role="tabpanel" tabindex="0">
                            {{-- blade-formatter-enable --}}
                        <form action="{{ route('profil.update', ['profil' => $Admin->id, 'isProfil' => true]) }}" autocomplete="off" id="admin-edit" method="post">
                            @csrf
                            @method('put')
                            <div class="row flex-column">
                                <div class="col-sm-6">
                                    <div class="mb-20">
                                        <label class="form-label fw-semibold text-primary-light mb-8 text-sm" for="nama-lengkap">Nama Lengkap <span class="text-danger-600">*</span></label>
                                        <input class="form-control radius-8" id="nama-lengkap" name="nama-lengkap" type="text" value="{{ old('nama-lengkap', $Admin->nama) }}">
                                        @error('nama-lengkap')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-20">
                                        <label class="form-label fw-semibold text-primary-light mb-8 text-sm" for="surel">Email <span class="text-danger-600">*</span></label>
                                        <input class="form-control radius-8" id="surel" name="surel" type="email" value="{{ old('surel', $Admin->email) }}">
                                        @error('surel')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="align-items-center d-flex justify-content-start gap-3 py-3">
                                <button class="btn btn-primary border-primary-600 text-md radius-8 border px-56 py-12" type="submit">Simpan</button>
                                <a class="border-danger-600 bg-hover-danger-200 text-danger-600 text-md radius-8 border px-56 py-11" href="{{ route('dashboard') }}">Kembali</a>
                            </div>
                        </form>
                    </div>
                    @can('isSuperAdmin')
                        {{-- blade-formatter-disable --}}
                         <div @class([ 'tab-pane', 'fade', 'show active' => !session()->get('isActive',true)]) id="pills-change-password" role="tabpanel" tabindex="0">
                      {{-- blade-formatter-enable --}}
                        <form action="{{ route('admin.ubah-sandi.update', $Admin->id) }}" autocomplete="off" id="ubah-sandi" method="post">
                            @csrf
                            @method('put')
                            <div class="row flex-column">
                                <div class="col-sm-6">
                                    <div class="mb-20">
                                        <label class="form-label fw-semibold text-primary-light mb-8 text-sm" for="kata-sandi-lama">Sandi Lama <span class="text-danger-600">*</span></label>
                                        <div class="position-relative">
                                            <input class="form-control radius-8" id="kata-sandi-lama" name="kata-sandi-lama" required type="password">
                                            <span class="toggle-password ri-eye-line ri-eye-off-line position-absolute top-50 translate-middle-y text-secondary-light end-0 me-16 cursor-pointer" data-toggle="#kata-sandi-lama"></span>
                                        </div>
                                        @error('kata-sandi-lama')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-20">
                                        <label class="form-label fw-semibold text-primary-light mb-8 text-sm" for="kata-sandi-baru">Sandi Baru <span class="text-danger-600">*</span></label>
                                        <div class="position-relative">
                                            <input class="form-control radius-8" id="kata-sandi-baru" name="kata-sandi-baru" required type="password">
                                            <span class="toggle-password ri-eye-line ri-eye-off-line position-absolute top-50 translate-middle-y text-secondary-light end-0 me-16 cursor-pointer" data-toggle="#kata-sandi-baru"></span>
                                        </div>
                                        @error('kata-sandi-baru')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-20">
                                        <label class="form-label fw-semibold text-primary-light mb-8 text-sm" for="kata-sandi-baru_confirmation">Konfirmasi Sandi <span class="text-danger-600">*</span></label>
                                        <div class="position-relative">
                                            <input class="form-control radius-8" id="kata-sandi-baru_confirmation" name="kata-sandi-baru_confirmation" required type="password">
                                            <span class="toggle-password ri-eye-line ri-eye-off-line position-absolute top-50 translate-middle-y text-secondary-light end-0 me-16 cursor-pointer" data-toggle="#kata-sandi-baru_confirmation"></span>
                                        </div>
                                        @error('kata-sandi-baru_confirmation')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="align-items-center d-flex justify-content-start gap-3 py-3">
                                <button class="btn btn-primary border-primary-600 text-md radius-8 border px-56 py-12" type="submit">Ubah</button>
                            </div>
                        </form>
                    </div>
                @endcan
            </div>
        </div>
    </div>
    </div>
    </div>
@endsection

@push('script')
    @if (session()->has('message'))
        <script>
            Swal2.fire({
                icon: "{{ session()->get('hasError') == true ? 'error' : 'success' }}",
                timer: 1500,
                title: "{{ session()->get('message') }}",
                showConfirmButton: false,
            });
        </script>
    @endif
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
