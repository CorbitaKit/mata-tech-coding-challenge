<?php

namespace App\Services\CSV;

use App\Jobs\ImportCsvRowJob;
use Illuminate\Bus\Batch;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Log;
use League\Csv\Reader;
use Throwable;

class CsvReaderService
{
    public function execute(string $path, string $model): void
    {
        $csv = Reader::createFromPath($path, 'r');
        $csv->setHeaderOffset(0);

        $records = iterator_to_array($csv->getRecords());

        $chunks = array_chunk($records, 500);

        foreach ($chunks as $index => $chunk) {
            $jobs = [];

            foreach ($chunk as $record) {
                $jobs[] = new ImportCsvRowJob($model, $record);
            }

            Bus::batch($jobs)
                ->then(function (Batch $batch) use ($index) {
                    Log::info("✅ Batch #$index completed: {$batch->id}");
                })
                ->catch(function (Batch $batch, Throwable $e) {
                    Log::error("❌ Batch #{$batch->id} failed: {$e->getMessage()}");
                })
                ->finally(function (Batch $batch) use ($index) {
                    Log::info("📦 Batch #$index finished.");
                })
                ->dispatch();
        }
    }
}
