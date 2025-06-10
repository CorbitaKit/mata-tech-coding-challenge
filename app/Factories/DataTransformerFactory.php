<?php

namespace App\Factories;

use App\Services\API\PizzaTypeService;

class DataTransformerFactory
{
    public function __construct(protected PizzaTypeService $pizzaTypeService){}
    public  function transform(string $model, array $record): array
    {
        return match ($model) {
            "PizzaType" => [
                'slug' => $record['pizza_type_id'],
                'name' => $record['name'],
                'category' => $record['category'],
                'ingredients' => $record['ingredients']
            ],
            "Pizza" => [
                'slug' => $record['pizza_id'],
                'pizza_type_id' => $this->pizzaTypeService->findBySlug($record['pizza_type_id']),
                'size' => $record['size'],
                'price' => $record['price']
            ],
            default => throw new \InvalidArgumentException("No transformer for model: {$model}")
        };
    }
}
