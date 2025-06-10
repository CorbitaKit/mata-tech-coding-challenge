<?php

namespace App\Services\API;

use App\Repositories\API\OrderDetailRepository;
use App\Services\Service;

class OrderDetailService extends Service
{
    public function __construct(OrderDetailRepository $orderDetailRepository)
    {
        parent::__construct($orderDetailRepository);
    }
}
