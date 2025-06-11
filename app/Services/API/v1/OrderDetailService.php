<?php

namespace App\Services\API\v1;

use App\Repositories\API\v1\OrderDetailRepository;
use App\Services\Service;
use Illuminate\Database\Eloquent\Model;

class OrderDetailService extends Service
{
    public function __construct(OrderDetailRepository $orderDetailRepository)
    {
        parent::__construct($orderDetailRepository);
    }

    public function create(array $data): Model
    {
        if ($data['source'] === 'csv') {
            $this->repo->insert($data);
            return $this->repo->latest();
        }

        return $this->repo->create($data);
    }
}
