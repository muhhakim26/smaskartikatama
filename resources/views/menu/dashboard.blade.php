@extends('layouts.admin.preset')
@section('judul', 'Dasbor')

@section('konten')
    <div class="d-flex align-items-center justify-content-between mb-24 flex-wrap gap-3">
        <h6 class="fw-semibold mb-0">Dashboard</h6>
    </div>
    <div class="row row-cols-xxxl-5 row-cols-lg-3 row-cols-sm-2 row-cols-1 gy-4">
        <div class="col">
            <div class="card bg-gradient-start-1 h-100 border shadow-none">
                <div class="card-body p-20">
                    <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                        <div>
                            <p class="fw-medium text-primary-light mb-1">Total Guru/Staf</p>
                            <h6 class="mb-0">{{ $jumlahGuru }}</h6>
                        </div>
                        <div class="w-50-px h-50-px bg-cyan rounded-circle d-flex justify-content-center align-items-center">
                            <iconify-icon class="mb-0 text-2xl text-white" icon="ph:chalkboard-teacher"></iconify-icon>
                        </div>
                    </div>
                </div>
            </div><!-- card end -->
        </div>
        <div class="col">
            <div class="card bg-gradient-start-1 h-100 border shadow-none">
                <div class="card-body p-20">
                    <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                        <div>
                            <p class="fw-medium text-primary-light mb-1">Total Posts Berita</p>
                            <h6 class="mb-0">{{ $jumlahBerita }}</h6>
                        </div>
                        <div class="w-50-px h-50-px bg-purple rounded-circle d-flex justify-content-center align-items-center">
                            <iconify-icon class="mb-0 text-2xl text-white" icon="mdi:newspaper-variant-multiple"></iconify-icon>
                        </div>
                    </div>
                </div>
            </div><!-- card end -->
        </div>
        <div class="col">
            <div class="card bg-gradient-start-1 h-100 border shadow-none">
                <div class="card-body p-20">
                    <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                        <div>
                            <p class="fw-medium text-primary-light mb-1">Total Pendaftar PPDB</p>
                            <h6 class="mb-0">{{ $jumlahPendaftarPpdb }}</h6>
                        </div>
                        <div class="w-50-px h-50-px bg-info rounded-circle d-flex justify-content-center align-items-center">
                            <iconify-icon class="mb-0 text-2xl text-white" icon="gridicons:multiple-users"></iconify-icon>
                        </div>
                    </div>
                </div>
            </div><!-- card end -->
        </div>
    </div>
@endsection
@push('script')
@endpush
