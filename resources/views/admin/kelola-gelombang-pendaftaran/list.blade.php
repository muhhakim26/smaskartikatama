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
    <div class="card h-100 radius-12 basic-data-table p-0">
        <div class="card-header border-bottom bg-base d-flex align-items-center justify-content-between flex-wrap gap-3 px-24 py-16">
            <div class="d-flex align-items-center flex-wrap gap-3">
                <h6 class="fw-semibold mb-0">Kelola Gelombang Pendaftaran</h6>
            </div>
        </div>
        <div class="card-body p-24">
            <div class="alert alert-danger bg-danger-100 text-danger-600 border-danger-600 border-start-width-4-px border-top-0 border-end-0 border-bottom-0 py-13 fw-semibold radius-4 d-flex align-items-center justify-content-between mb-0 px-24 text-lg" role="alert">
                <div class="d-flex align-items-center gap-2">
                    <iconify-icon class="icon text-xl" icon="mdi:alert-circle-outline"></iconify-icon>
                    Pastikan tahun ajaran telah diperbarui sebelum pendaftaran PPDB dibuka.
                </div>
            </div>
            <div class="table-responsive">
                <table class="bordered-table nowrap w-100 mb-0 table" data-page-length='10' id="dataTable">
                    <thead>
                        <tr>
                            <th class="text-center" scope="col">No. Batch</th>
                            <th scope="col">Tahun Ajaran</th>
                            <th scope="col">Kuota</th>
                            <th class="text-center" scope="col">Tanggal Pembukaan</th>
                            <th class="text-center" scope="col">Tanggal Penutupan</th>
                            <th class="text-center" scope="col">Tanggal Pengumuman</th>
                            <th class="text-center" scope="col">Status Pendaftaran</th>
                            <th class="text-center" scope="col">Status Pengumuman</th>
                            <th class="text-center" scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('script')
    @if (session()->has('message'))
        <script>
            Swal2.fire({
                icon: "success",
                title: "{{ session()->get('message') }}",
            });
        </script>
    @endif
    <script>
        $(document).ready(function() {
            let table = new DataTable("#dataTable", {
                info: false,
                ordering: false,
                paging: false,
                processing: true,
                responsive: true,
                searching: false,
                serverSide: true,
                ajax: window.location.href,
                order: [],
                /*  columnDefs: [{
                      className: "text-center",
                      targets: [0, 3, 4]
                  }, ],*/
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'tahun_ajaran',
                        name: 'tahun_ajaran'
                    },
                    {
                        data: 'kuota_pendaftaran',
                        name: 'kuota_pendaftaran',
                    },
                    {
                        data: 'tanggal_dibuka',
                        name: 'tanggal_dibuka',
                    },
                    {
                        data: 'tanggal_ditutup',
                        name: 'tanggal_ditutup',
                    },
                    {
                        data: 'tanggal_diumumkan',
                        name: 'tanggal_diumumkan',
                    },
                    {
                        data: 'status_pendaftaran',
                        name: 'status_pendaftaran',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'status_pengumuman',
                        name: 'status_pengumuman',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],
            });
        });
    </script>
    <script>
        /** Status Pendaftaran */
        $(document).on('click', '.btn-active', function() {
            let dataactive;
            let token = $("meta[name='csrf-token']").attr("content");
            let id = $(this).attr("data-id");
            let active = $(".active" + id).attr("data-active");
            if (active == "Y") {
                dataactive = "N";
            } else {
                dataactive = "Y";
            }

            $.ajax({
                type: "POST",
                url: "{{ route('kelola-gelombang-pendaftaran.status', 'status-pendaftaran') }}",
                data: {
                    "id": id,
                    "active": dataactive,
                    "_token": token
                },
                success: function(data) {
                    if (active == "Y") {
                        $(".active" + id).attr("data-active", "N");
                    } else {
                        $(".active" + id).attr("data-active", "Y");
                    }
                }
            });
        });

        /** Status Pengumuman */
        $(document).on('click', '.btn-pengumuman', function() {
            let dataactive;
            let token = $("meta[name='csrf-token']").attr("content");
            let id = $(this).attr("data-id");
            let active = $(".active-pengumuman" + id).attr("data-active");
            if (active == "Y") {
                dataactive = "N";
            } else {
                dataactive = "Y";
            }
            $.ajax({
                type: "POST",
                url: "{{ route('kelola-gelombang-pendaftaran.status', 'status-pengumuman') }}",
                data: {
                    "id": id,
                    "active": dataactive,
                    "_token": token
                },
                success: function(data) {
                    console.log(data);
                    if (active == "Y") {
                        $(".active-pengumuman" + id).attr("data-active", "N");
                    } else {
                        $(".active-pengumuman" + id).attr("data-active", "Y");
                    }
                }
            });
        });
    </script>
@endpush
