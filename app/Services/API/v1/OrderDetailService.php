<?php

namespace App\Services\API\v1;

use App\Repositories\API\v1\OrderDetailRepository;
use App\Services\Service;

class OrderDetailService extends Service
{
    public function __construct(OrderDetailRepository $orderDetailRepository)
    {
        parent::__construct($orderDetailRepository);
    }
}
