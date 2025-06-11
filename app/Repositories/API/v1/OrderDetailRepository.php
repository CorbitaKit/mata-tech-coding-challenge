<?php

namespace App\Repositories\API\v1;

use App\Models\OrderDetail;
use App\Repositories\Repository;
use App\Traits\Sales;
use Illuminate\Database\Eloquent\Model;

class OrderDetailRepository extends Repository
{
    use Sales;
    public function __construct(OrderDetail $orderDetail)
    {
        parent::__construct($orderDetail);
    }

    public function insert(array $data): bool
    {
        return $this->model::insert($data);
    }

    public function latest(): Model
    {
        return $this->model::latest('created_at')->first();
    }
}
