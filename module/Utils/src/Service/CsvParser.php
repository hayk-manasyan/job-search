<?php

namespace Utils\Service;


class CsvParser
{

    public static function parseCsv($filePath)
    {
        $row = 1;
        $fileData = [];
        if (($handle = fopen($filePath, "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $num = count($data);
                $row++;
                for ($c=0; $c < $num; $c++) {
                    $fileData[] = $data[$c];
                }
            }
            fclose($handle);
        }

        return $fileData;
    }
}