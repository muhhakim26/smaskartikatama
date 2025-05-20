<?php

namespace Database\Seeders\Utilitas;

class CsvToArray
{
    public function csv_to_array($filename, $header)
    {
        $delimiter = ',';
        if (!file_exists($filename) || !is_readable($filename)) {
            return false;
        }

        $data = [];
        if (($handle = fopen($filename, 'r')) !== false) {
            $firstline = true;
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== false) {
                if (!$firstline) {
                    $data[] = array_combine($header, $row);
                }
                $firstline = false;
            }
            fclose($handle);
        }

        return $data;
    }
}