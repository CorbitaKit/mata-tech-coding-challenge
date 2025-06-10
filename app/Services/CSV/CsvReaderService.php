<?php

namespace App\Services\CSV;
use League\Csv\Reader;

class CsvReaderService
{
    public function execute(string $path, string $model): void
    {
        $csv = Reader::createFromPath($path, 'r');

        $csv->setHeaderOffset(0);

        $records = $csv->getRecords();

        foreach ($records as $record) {
            dd($record['pizza_id']);
        }
    }
}
