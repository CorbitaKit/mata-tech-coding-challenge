<?php

namespace App\Factories;

class ServiceFactory
{
    public static function resolve(string $model): object
    {
        $modelName = class_basename($model);
        $serviceClass = "App\\Services\\API\\{$modelName}Service";

        if (!class_exists($serviceClass)) {
            throw new \InvalidArgumentException("Service for {$modelName} not found.");
        }

        return app()->make($serviceClass);
    }
}
