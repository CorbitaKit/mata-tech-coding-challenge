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
    protected array $chunk;

    /**
     * Create a new job instance.
     */
    public function __construct(string $model, array $chunk)
    {
        $this->model = $model;
        $this->chunk = $chunk;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
         $transformer = app(DataTransformerFactory::class);
         $service = ServiceFactory::resolve($this->model);
        foreach ($this->chunk as $record) {
            $data = $transformer->transform($this->model, $record);
            $service->create($data);
        }




    }
}
