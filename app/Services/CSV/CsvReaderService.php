<?php

namespace App\Services\CSV;

use App\Factories\DataTransformerFactory;
use App\Factories\ServiceFactory;
use League\Csv\Reader;

class CsvReaderService
{
    public function execute(string $path, string $model): void
    {

        $csv = Reader::createFromPath($path, 'r');

        $csv->setHeaderOffset(0);

        $records = $csv->getRecords();
        $service = ServiceFactory::resolve($model);
        foreach ($records as $record) {

            $transformer = app(DataTransformerFactory::class);
            $data = $transformer->transform($model, $record);

            $service->create($data);
        }
    }
}
