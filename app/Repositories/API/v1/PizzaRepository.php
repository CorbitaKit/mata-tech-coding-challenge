<?php

namespace App\Repositories\API\v1;

use App\Models\Pizza;
use App\Repositories\Repository;

class PizzaRepository extends Repository
{
    public function __construct(Pizza $pizza)
    {
        parent::__construct($pizza);
    }

    public function findBySlug(string $slug): int|null
    {
        return $this->model->where('slug', $slug)->value('id');
    }
}
