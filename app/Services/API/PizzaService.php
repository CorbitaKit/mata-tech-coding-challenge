<?php

namespace App\Services\API;

use App\Repositories\API\PizzaRepository;
use App\Services\Service;

class PizzaService extends Service
{
    public function __construct(PizzaRepository $pizzaRepository)
    {
        parent::__construct($pizzaRepository);
    }
}
