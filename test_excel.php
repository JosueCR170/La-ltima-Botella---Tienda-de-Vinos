<?php

require __DIR__.'/vendor/autoload.php';

use Spatie\SimpleExcel\SimpleExcelReader;

$path = __DIR__.'/EJEMPLO/Datos CSV.xlsx';

if (!file_exists($path)) {
    echo "File not found: $path\n";
    exit;
}

$rows = SimpleExcelReader::create($path)->getRows();

echo "Headers:\n";
foreach ($rows->first() as $key => $value) {
    echo "- $key\n";
}
