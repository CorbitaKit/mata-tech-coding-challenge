<?php

namespace App\Repositories\API\v1;

use App\Models\OrderDetail;
use App\Repositories\Repository;

class OrderDetailRepository extends Repository
{
    public function __construct(OrderDetail $orderDetail)
    {
        parent::__construct($orderDetail);
    }
}
