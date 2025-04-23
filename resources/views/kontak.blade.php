@extends('layouts/user/preset')
@section('judul', 'Kontak')
@section('konten')
    @push('style')
        <style>
            .btn-kirimpesan {
                background-color: #007bff;
                color: white;
                border: none;
                padding: 13px 30px;
                border-radius: 50px;
                cursor: pointer;
                font-size: 16px;
                transition: background-color 0.3s ease, transform 0.2s ease;
            }

            .btn-kirimpesan:hover {
                background-color: #0056b3;
            }
        </style>
    @endpush
    @include('layouts.user.hero', ['judul' => 'Informasi Kontak'])
    <!-- Info Section -->
    <section class="py-120" id="kontak">
        <div class="container">
            <div class="row g-5">
                <div class="col-xl-6 text-black">
                    <div class="row row-cols-md-2 g-4">
                        <div class="col-md-6">
                            <div class="d-flex justify-content-start">
                                <span class="h5">Email</span>
                            </div>
                            <span>{{ $Kontak->email ?? 'smakartikatamametro@ymail.com' }}</span>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex justify-content-start">
                                <span class="h5">Telepon</span>
                            </div>
                            <span>{{ $Kontak->notelpon ?? '0725-45311' }}</span>
                        </div>
                    </div>
                    <div class="mt-24">
                        <div class="d-flex justify-content-start">
                            <span class="h5">Alamat</span>
                        </div>
                        <span>{{ $Kontak->alamat ?? 'Jl. Kapten Tendean, Margorejo, Kec. Metro Sel., Kota Metro, Lampung 34111' }}</span>
                    </div>
                    <div class="w-100 mt-24">
                        <iframe class="w-100" height="450" loading="lazy" referrerpolicy="no-referrer-when-downgrade" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3973.763690429656!2d105.29709552433528!3d-5.141702644835496!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e40b9464c8e1355%3A0xa18bf3f399f79a31!2sSMAS%20Kartikatama%20Metro!5e0!3m2!1sid!2sid!4v1744305340014!5m2!1sid!2sid" style="border:0;"></iframe>
                    </div>
                </div>
                <div class="col-xl-6">
                    <h4 class="pb-4">Kotak Saran</h4>
                    <form id="kotak-saran">
                        <div class="mb-3">
                            <label class="form-label" for="nama">Nama</label>
                            <input class="form-control" id="nama" name="nama" placeholder="Nama" type="text">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="email">Email</label>
                            <input class="form-control" id="email" name="email" placeholder="Email" type="email">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="telepon">Nomor Telepon</label>
                            <input class="form-control" id="telepon" name="telepon" placeholder="Nomor Telepon" type="tel" pattern="[0-9]+" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="pesan">Pesan</label>
                            <textarea class="form-control" id="pesan" name="pesan" placeholder="Pesan" rows="3"></textarea>
                        </div>
                        <button class="btn-kirimpesan" type="button" onclick="kirimWhatsApp()">Kirim Pesan</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('script')
    <script>
        function kirimWhatsApp() {
            const nama = document.getElementById('nama').value;
            const email = document.getElementById('email').value;
            const telepon = document.getElementById('telepon').value;
            const pesan = document.getElementById('pesan').value;

            const message = `Nama: ${nama}%0AEmail: ${email}%0ANomor Telepon: ${telepon}%0APesan: ${pesan}`;
            const phoneNumber = '+6281377641593'; // Ganti dengan nomor WhatsApp yang diinginkan
            const url = `https://api.whatsapp.com/send?phone=${phoneNumber}&text=${message}`;

            window.open(url, '_blank');
        }
    </script>
@endpush
