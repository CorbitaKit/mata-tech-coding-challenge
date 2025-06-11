<?php

namespace App\Services\API\v1;

use App\Repositories\API\v1\OrderDetailRepository;
use App\Services\Service;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class OrderDetailService extends Service
{
    public function __construct(OrderDetailRepository $orderDetailRepository)
    {
        parent::__construct($orderDetailRepository);
    }

    public function create(array $data): Model
    {
        return $this->repo->create($data);
    }

    public function getTotalSales(): float
    {
        return $this->repo->getTotalSales();
    }

    public function topSellingPizzas(): Collection
    {
        return $this->repo->topSellingPizzas();
    }


}
