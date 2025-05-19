<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\GelombangPendaftaran;
use App\Models\ProgresSiswa;
use App\Models\Siswa;
use Database\Seeders\Area\DistrictSeeder;
use Database\Seeders\Area\ProvinceSeeder;
use Database\Seeders\Area\RegencySeeder;
use Database\Seeders\Area\VillageSeeder;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        Admin::create([
            'nama' => 'Admin',
            'email' => 'admin@test.com',
            'password' => bcrypt('admin'),
            'level' => 'superadmin',
        ]);
        Siswa::create([
            'gelombang_pendaftaran' => 1,
            'tahun_ajaran' => '2025/2026',
            'id_pendaftaran' => 'SKT202505100001',
            'nama' => 'AZKA KAMAL FADHIL AL-FATIH',
            'email' => 'siswa@test.com',
            'nhp_siswa' => '081234567890',
            'nisn' => '0123456789',
            'password' => bcrypt('siswa'),
        ]);

        ProgresSiswa::create([
            'siswa_id' => 1,
            'step_1' => 0,
            'step_2' => 0,
            'step_3' => 0,
            'step_4' => 0,
        ]);

        $Batch = [
            [
                'tahun_ajaran' => '2025/2026',
                'kuota_pendaftaran' => 100,
                'tanggal_dibuka' => Carbon::create(2025, 5, 10),
                'tanggal_ditutup' => Carbon::create(2025, 5, 20),
                'tanggal_diumumkan' => Carbon::create(2025, 5, 25),
                'catatan' => 'Gelombang pertama dibuka untuk umum.',
                'link_grup' => 'https://t.me/gelombang1',
                'status_pendaftaran' => 1,
                'status_pengumuman' => 0,
            ],
            [
                'tahun_ajaran' => '2025/2026',
                'kuota_pendaftaran' => 80,
                'tanggal_dibuka' => Carbon::create(2025, 6, 1),
                'tanggal_ditutup' => Carbon::create(2025, 6, 10),
                'tanggal_diumumkan' => Carbon::create(2025, 6, 15),
                'catatan' => 'Gelombang kedua terbatas untuk internal.',
                'link_grup' => 'https://t.me/gelombang2',
                'status_pendaftaran' => 0,
                'status_pengumuman' => 0,
            ],
            [
                'tahun_ajaran' => '2025/2026',
                'kuota_pendaftaran' => 60,
                'tanggal_dibuka' => Carbon::create(2025, 7, 1),
                'tanggal_ditutup' => Carbon::create(2025, 7, 10),
                'tanggal_diumumkan' => Carbon::create(2025, 7, 15),
                'catatan' => 'Gelombang ketiga cadangan.',
                'link_grup' => 'https://t.me/gelombang3',
                'status_pendaftaran' => 0,
                'status_pengumuman' => 0,
            ],
        ];
        foreach ($Batch as $item) {
            GelombangPendaftaran::create($item);
        }

        $this->call([
            ProvinceSeeder::class,
            RegencySeeder::class,
            DistrictSeeder::class,
            VillageSeeder::class,
        ]);
    }
}