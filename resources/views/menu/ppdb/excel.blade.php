<table>
    <thead>
        <tr>
            <th align="center" colspan="35">Data Calon Siswa SMA Kartikatama Metro</th>
        </tr>
        <tr>
            <th align="center" colspan="35">Export: {{ $Tanggal }}</th>
        </tr>
        <tr>
            <th>No.</th>
            <th>Tahun Ajaran</th>
            <th>Gelombang Pendaftaran</th>
            <th>No. Pendaftaran</th>
            <th>NISN</th>
            <th>Nama Lengkap</th>
            <th>Email</th>
            <th>No. HP Siswa</th>
            <th>Jenis Kelamin</th>
            <th>Agama</th>
            <th>Tempat Lahir</th>
            <th>Alamat</th>
            <th>Asal Sekolah</th>
            <th>Provinsi</th>
            <th>Kabupaten</th>
            <th>Kecamatan</th>
            <th>Desa/Kelurahan</th>
            <th>Info Pendaftaran</th>
            <th>Nama Ayah</th>
            <th>Pendidikan Terkahir</th>
            <th>Pekerjaan</th>
            <th>Penghasilan</th>
            <th>No. HP Ayah</th>
            <th>Nama Ibu</th>
            <th>Pendidikan Terkahir</th>
            <th>Pekerjaan</th>
            <th>Penghasilan</th>
            <th>No. HP Ibu</th>
            <th>Status File Foto Siswa</th>
            <th>Status File Akte</th>
            <th>Status File KK</th>
            <th>Status File SKHU</th>
            <th>Status File SKM</th>
            <th>Status Berkas</th>
            <th>Status Siswa</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($CalSis as $value)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $value->tahun_ajaran }}</td>
                <td>{{ $value->gelombang_pendaftaran }}</td>
                <td>{{ $value->id_pendaftaran }}</td>
                <td>{{ $value->nisn }}</td>
                <td>{{ $value->nama }}</td>
                <td>{{ $value->email }}</td>
                <td>{{ $value->nhp_siswa }}</td>
                <td>{{ $value->detailSiswa->jenis_kelamin ?? '' }}</td>
                <td>{{ $value->detailSiswa->agama ?? '' }}</td>
                <td>{{ $value->detailSiswa->tempat_lahir ?? '' }}</td>
                <td>{{ $value->detailSiswa->alamat ?? '' }}</td>
                <td>{{ $value->detailSiswa->asal_sekolah ?? '' }}</td>
                <td>{{ $value->detailSiswa->provinsi->name ?? '' }}</td>
                <td>{{ $value->detailSiswa->kabupaten->name ?? '' }}</td>
                <td>{{ $value->detailSiswa->kecamatan->name ?? '' }}</td>
                <td>{{ $value->detailSiswa->kelurahan->name ?? '' }}</td>
                <td>{{ implode(', ', $value->detailSiswa?->info_pendaftaran ?? []) }}</td>
                <td>{{ $value->detailSiswa->nama_ayah ?? '' }}</td>
                <td>{{ $value->detailSiswa->pend_terakhir_ayah ?? '' }}</td>
                <td>{{ $value->detailSiswa->pekerjaan_ayah ?? '' }}</td>
                <td>{{ $value->detailSiswa->penghasilan_ayah ?? '' }}</td>
                <td>{{ $value->detailSiswa->nhp_ayah ?? '' }}</td>
                <td>{{ $value->detailSiswa->nama_ibu ?? '' }}</td>
                <td>{{ $value->detailSiswa->pend_terakhir_ibu ?? '' }}</td>
                <td>{{ $value->detailSiswa->pekerjaan_ibu ?? '' }}</td>
                <td>{{ $value->detailSiswa->penghasilan_ibu ?? '' }}</td>
                <td>{{ $value->detailSiswa->nhp_ibu ?? '' }}</td>
                <td>{{ $value->detailSiswa->status_fileft_siswa ?? '' }}</td>
                <td>{{ $value->detailSiswa->status_filefc_akte ?? '' }}</td>
                <td>{{ $value->detailSiswa->status_filefc_kk ?? '' }}</td>
                <td>{{ $value->detailSiswa->status_filefc_skhu ?? '' }}</td>
                <td>{{ $value->detailSiswa->status_filefc_skm ?? '' }}</td>
                <td>{{ $value->detailSiswa->status_berkas ?? '' }}</td>
                <td>{{ $value->detailSiswa->status_siswa ?? '' }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
