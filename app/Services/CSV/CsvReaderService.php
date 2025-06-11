<?php

namespace App\Services\CSV;

use App\Jobs\ImportCsvChunkJob;
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

        $chunks = array_chunk($records, 1000);

        $jobs = [];

        foreach ($chunks as $chunk) {
            $jobs[] = new ImportCsvRowJob($model, $chunk);
        }

        Bus::batch($jobs)
            ->then(function (Batch $batch) {
                Log::info("✅ Batch completed: {$batch->id}");
            })
            ->catch(function (Batch $batch, Throwable $e) {
                Log::error("❌ Batch #{$batch->id} failed: {$e->getMessage()}");
            })
            ->finally(function (Batch $batch) {
                Log::info("📦 Batch finished: {$batch->id}");
            })
            ->dispatch();
    }
}
