<?php

namespace Database\Seeders\Area;

use Database\Seeders\Utilitas\CsvtoArray;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Province::truncate();

        // $csvFile = fopen(base_path("database/data/provinces.csv"), "r");

        // $firstline = true;
        // while (($data = fgetcsv($csvFile, 1000)) !== false) {
        //     if (!$firstline) {
        //         Province::create([
        //             "code" => $data['0'],
        //             "name" => $data['1'],
        //         ]);
        //     }
        //     $firstline = false;
        // }

        // fclose($csvFile);

        $csvFile = __DIR__ . '/../../data/provinces.csv';
        $csv = new CsvtoArray();
        $header = ['code', 'name'];
        $data = $csv->csv_to_array($csvFile, $header);
        DB::table(env('INDONESIA_AREA_TABLE_PREFIX', '') . 'provinces')->insertOrIgnore($data);
    }
}
