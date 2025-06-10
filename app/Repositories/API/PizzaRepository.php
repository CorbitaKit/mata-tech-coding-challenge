<?php

namespace App\Repositories\API;

use App\Models\Pizza;
use App\Repositories\Repository;

class PizzaRepository extends Repository
{
    public function __construct(Pizza $pizza)
    {
        parent::__construct($pizza);
    }
}
