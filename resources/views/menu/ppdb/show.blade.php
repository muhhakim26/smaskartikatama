@extends('layouts/preset')
@section('judul', 'Deskripsi PPDB Siswa')

@section('konten')
    <div>
        <a href="{{ route('kelola-ppdb.index') }}">Kembali</a>
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
            <td align="right">Nama :</td>
            <td>{{ $PPDB->nama }}</td>
        </tr>
        <tr>
            <td align="right">Jenis Kelamin :</td>
            <td>{{ $PPDB->jenis_kelamin }}</td>
        </tr>
        <tr>
            <td align="right">NISN :</td>
            <td>{{ $PPDB->nisn }}</td>
        </tr>
        <tr>
            <td align="right">Tempat Lahir :</td>
            <td>{{ $PPDB->tempat_lahir }}</td>
        </tr>
        <tr>
            <td align="right">Tanggal Lahir :</td>
            <td>{{ $PPDB->tgl_lahir }}</td>
        </tr>
        <tr>
            <td align="right">Agama :</td>
            <td>{{ $PPDB->agama }}</td>
        </tr>
        <tr>
            <td align="right">Berkebutuhan Khusus :</td>
            <td>{{ $PPDB->brkthn_khusus_siswa }}</td>
        </tr>
        <tr>
            <td align="right">Alamat :</td>
            <td>{{ $PPDB->alamat }}</td>
        </tr>
        <tr>
            <td align="right">Provinsi :</td>
            <td>{{ $PPDB->provinsi->name }}</td>
        </tr>
        <tr>
            <td align="right">Kabupaten :</td>
            <td>{{ $PPDB->kabupaten->name }}</td>
        </tr>
        <tr>
            <td align="right">Kecamatan :</td>
            <td>{{ $PPDB->kecamatan->name }}</td>
        </tr>
        <tr>
            <td align="right">Kelurahan :</td>
            <td>{{ $PPDB->kelurahan->name }}</td>
        </tr>
        <tr>
            <td align="right">Kode POS :</td>
            <td>{{ $PPDB->kode_pos }}</td>
        </tr>
        <tr>
            <td align="right">Nomor HP Orang Tua :</td>
            <td>{{ $PPDB->nhp_ortu }}</td>
        </tr>
        <tr>
            <td align="right">Nomor HP Siswa:</td>
            <td>{{ $PPDB->nhp_siswa }}</td>
        </tr>
        <tr>
            <td align="right">Email:</td>
            <td>{{ $PPDB->email }}</td>
        </tr>
        <tr>
            <td align="right">Asal Sekolah SMP/Mts:</td>
            <td>{{ $PPDB->asal_sekolah }}</td>
        </tr>
        <hr>
        <h3>Data Orang Tua</h3>
        <h4>Data Ayah</h4>
        <tr>
            <td align="right">Nama:</td>
            <td>{{ $PPDB->nama_ayah }}</td>
        </tr>
        <tr>
            <td align="right">Pendidikan Terakhir:</td>
            <td>{{ $PPDB->pend_terakhir_ayah }}</td>
        </tr>
        <tr>
            <td align="right">Pekerjaan:</td>
            <td>{{ $PPDB->pekerjaan_ayah }}</td>
        </tr>
        <tr>
            <td align="right">Penghasilan:</td>
            <td>{{ $PPDB->penghasilan_ayah }}</td>
        </tr>
        <tr>
            <td align="right">Berkebutuhan Khusus:</td>
            <td>{{ $PPDB->brkthn_khusus_ayah }}</td>
        </tr>
        <h4>Data Ibu</h4>
        <tr>
            <td align="right">Nama:</td>
            <td>{{ $PPDB->nama_ibu }}</td>
        </tr>
        <tr>
            <td align="right">Pendidikan Terakhir:</td>
            <td>{{ $PPDB->pend_terakhir_ibu }}</td>
        </tr>
        <tr>
            <td align="right">Pekerjaan:</td>
            <td>{{ $PPDB->pekerjaan_ibu }}</td>
        </tr>
        <tr>
            <td align="right">Penghasilan:</td>
            <td>{{ $PPDB->penghasilan_ibu }}</td>
        </tr>
        <tr>
            <td align="right">Berkebutuhan Khusus:</td>
            <td>{{ $PPDB->brkthn_khusus_ibu }}</td>
        </tr>
        <hr>
        @if (!empty($PPDB->nama_wali))
            <h4>Data Wali</h4>
            <tr>
                <td align="right">Nama:</td>
                <td>{{ $PPDB->nama_wali }}</td>
            </tr>
            <tr>
                <td align="right">Pendidikan Terakhir:</td>
                <td>{{ $PPDB->pend_terakhir_wali }}</td>
            </tr>
            <tr>
                <td align="right">Pekerjaan:</td>
                <td>{{ $PPDB->pekerjaan_wali }}</td>
            </tr>
            <tr>
                <td align="right">Penghasilan:</td>
                <td>{{ $PPDB->penghasilan_wali }}</td>
            </tr>
            <tr>
                <td align="right">Berkebutuhan Khusus:</td>
                <td>{{ $PPDB->brkthn_khusus_wali }}</td>
            </tr>
        @endif
        <tr>
            <td align="right">Akte :</td>
            <td><img alt="Akte {{ $PPDB->nama }}" src="{{ route('berkas', $PPDB->filefc_akte) }}"></td>
        </tr>
        <tr>
            <td align="right">KK :</td>
            <td><img alt="KK {{ $PPDB->nama }}" src="{{ route('berkas', $PPDB->filefc_kk) }}"></td>
        </tr>
        <tr>
            <td align="right">SKHU :</td>
            <td><img alt="SKHU {{ $PPDB->nama }}" src="{{ route('berkas', $PPDB->filefc_skhu) }}"></td>
        </tr>
        <tr>
            <td align="right">SKM :</td>
            <td><img alt="SKM {{ $PPDB->nama }}" src="{{ route('berkas', $PPDB->filefc_skm) }}"></td>
        </tr>
        <tr>
            <td align="right">Dibuat :</td>
            <td>{{ $PPDB->created_at }}</td>
        </tr>
        <tr>
            <td align="right">Diubah :</td>
            <td>{{ $PPDB->updated_at }}</td>
        </tr>
    </table>

    <div>
        <a href="{{ route('kelola-ppdb.edit', $PPDB->id) }}">Ubah</a>
        <a href="{{ route('kelola-ppdb.destroy', $PPDB->id) }}" onclick="event.preventDefault();document.getElementById('delete-form-{{ $PPDB->id }}').submit();">Hapus</a>
        <form action="{{ route('kelola-ppdb.destroy', $PPDB->id) }}" id="delete-form-{{ $PPDB->id }}" method="POST" style="display:inline;" style="display: none;">
            @csrf
            @method('delete')
        </form>
    </div>
@endsection
