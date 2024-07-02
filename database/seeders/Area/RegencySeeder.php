<?php

namespace Database\Seeders\Area;

use Database\Seeders\Utilitas\CsvtoArray;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RegencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Regency::truncate();
        // $csvFile = fopen(base_path("database/data/regencies.csv"), "r");
        // $firstline = true;
        // while (($data = fgetcsv($csvFile, 1000)) !== false) {
        //     if (!$firstline) {
        //         Regency::create([
        //             "code" => $data['0'],
        //             "province_code" => $data['1'],
        //             "name" => $data['2'],
        //         ]);
        //     }
        //     $firstline = false;
        // }
        // fclose($csvFile);
        $csvFile = __DIR__ . '/../../data/regencies.csv';
        $csv = new CsvtoArray();
        $header = ['code', 'province_code', 'name'];
        $data = $csv->csv_to_array($csvFile, $header);
        $collection = collect($data);
        foreach ($collection->chunk(100) as $chunk) {
            DB::table(env('INDONESIA_AREA_TABLE_PREFIX', 'indonesia_') . 'regencies')->insertOrIgnore($chunk->toArray());
        }
    }
}
