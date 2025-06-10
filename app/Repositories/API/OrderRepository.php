<?php

namespace App\Repositories\API;

use App\Models\Order;
use App\Repositories\Repository;

class OrderRepository extends Repository
{
    public function __construct(Order $order)
    {
        parent::__construct($order);
    }

    public function findBySlug(int $slug): int|null
    {
        return $this->model->where('slug', $slug)->value('id');
    }
}
