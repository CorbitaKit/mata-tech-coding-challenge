<?php

namespace App\Console\Commands;

use App\Services\CSV\CsvReaderService;
use Illuminate\Console\Command;

class ImportCsvData extends Command
{

    public function __construct(protected CsvReaderService $csvReaderService)
    {
        parent::__construct();
    }
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:csv {file} {model}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import CSV data into designated model';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $path = $this->argument('file');
        $model = $this->argument('model');



        if (! file_exists($path)) {
             $this->error("❌ File not found at path: $path");
            return;
        }

        $modelClass = $this->getModelClass($model);
         if (!class_exists($modelClass)) {
            $this->error("❌ Model class does not exist: $modelClass");
            return;
        }

        $this->csvReaderService->execute($path, $model);


    }

     protected function getModelClass(string $model): string
    {
        return 'App\\Models\\' . ucfirst($model);
    }
}
