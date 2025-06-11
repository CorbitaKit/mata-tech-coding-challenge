<?php

namespace App\Factories;

use App\Services\API\v1\OrderService;
use App\Services\API\v1\PizzaService;
use App\Services\API\v1\PizzaTypeService;
use Carbon\Carbon;

class DataTransformerFactory
{
    public function __construct(
        protected PizzaTypeService $pizzaTypeService,
        protected PizzaService $pizzaService,
        protected OrderService $orderService
    ){}
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
            "Order" => [
                'ordered_at' =>  $this->transformDateAndTimeIntoTimeStamp($record['date'], $record['time']),
                'slug' => $record['order_id']
            ],
            "OrderDetail" => [
                'pizza_id' => $this->pizzaService->findBySlug($record['pizza_id']),
                'order_id' => $this->orderService->findBySlug($record['order_id']),
                'quantity' => $record['quantity'],
                'slug' => $record['order_details_id']
            ],
            default => throw new \InvalidArgumentException("No transformer for model: {$model}")
        };
    }

    private function transformDateAndTimeIntoTimeStamp(string $date, string $time): string
    {

        $carbon = Carbon::createFromFormat('Y-m-d H:i:s', "$date $time");

        return  $carbon->toDateTimeString();
    }
}
