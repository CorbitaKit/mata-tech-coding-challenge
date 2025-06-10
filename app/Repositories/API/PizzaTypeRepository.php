<?php

namespace App\Repositories\API;

use App\Models\PizzaType;
use App\Repositories\Repository;

class PizzaTypeRepository extends Repository
{
    public function __construct(PizzaType $pizzaType)
    {
        parent::__construct($pizzaType);
    }

    public function findBySlug(string $slug): int|null
    {
        return $this->model->where('slug', $slug)->value('id');
    }
}
