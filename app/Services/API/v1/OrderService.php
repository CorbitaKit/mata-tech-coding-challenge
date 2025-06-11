<?php

namespace App\Services\API\v1;

use App\Repositories\API\v1\OrderRepository;
use App\Services\Service;
use Illuminate\Database\Eloquent\Collection;

class OrderService extends Service
{
    public function __construct(OrderRepository $orderRepository)
    {
        parent::__construct($orderRepository);
    }

    public function findBySlug(int $slug): int|null
    {
        return $this->repo->findBySlug($slug);
    }

    public function total(): int
    {
        return $this->repo->total();
    }

    public function getSalesSummary(): array
    {
        return [
            'daily' => $this->repo->dailySales(),
            'weekly' => $this->repo->weeklySales(),
            'monthly' => $this->repo->yearlySales()

        ];
    }

    public function getLatestOrders(): Collection
    {
        return $this->repo->latest(5)->load('orderDetail.pizza.pizzaType');
    }
}
