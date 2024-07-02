<?php

namespace Database\Seeders;

use App\Models\Admin;
use Database\Seeders\Area\DistrictSeeder;
use Database\Seeders\Area\ProvinceSeeder;
use Database\Seeders\Area\RegencySeeder;
use Database\Seeders\Area\VillageSeeder;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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
            'level' => 'admin',
        ]);

        $this->call([
            ProvinceSeeder::class,
            RegencySeeder::class,
            DistrictSeeder::class,
            VillageSeeder::class,
        ]);

    }
}
