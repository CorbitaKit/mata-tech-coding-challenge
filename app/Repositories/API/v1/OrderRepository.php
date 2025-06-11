<?php

namespace App\Repositories\API\v1;

use App\Models\Order;
use App\Repositories\Repository;
use App\Traits\Sales;
use Illuminate\Database\Eloquent\Collection;

class OrderRepository extends Repository
{
    use Sales;
    public function __construct(Order $order)
    {
        parent::__construct($order);
    }

    public function findBySlug(int $slug): int|null
    {
        return $this->model->where('slug', $slug)->value('id');
    }

    public function total(): int
    {
        return $this->model::count();
    }

    public function latest(int $take = 1): Collection
    {
        return $this->model::latest()->take($take)->get();
    }
}
