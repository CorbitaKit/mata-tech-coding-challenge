<?php

namespace App\Jobs;

use App\Factories\DataTransformerFactory;
use App\Factories\ServiceFactory;
use Illuminate\Bus\Batchable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ImportCsvRowJob implements ShouldQueue
{
    use Queueable, InteractsWithQueue, SerializesModels, Batchable;

    protected array $record;
    protected string $model;

    /**
     * Create a new job instance.
     */
    public function __construct(string $model, array $record)
    {
        $this->model = $model;
        $this->record = $record;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $transformer = app(DataTransformerFactory::class);
        $data = $transformer->transform($this->model, $this->record);

        $service = ServiceFactory::resolve($this->model);
        $service->create($data);
    }
}
