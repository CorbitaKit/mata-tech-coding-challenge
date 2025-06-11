<?php

namespace App\Services\API\v1;

use App\Repositories\API\v1\OrderRepository;
use App\Services\Service;

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
}
