<?php

namespace App\Repositories\API\v1;

use App\Models\Ingredient;
use App\Repositories\Repository;
use App\Traits\Sales;
use Illuminate\Database\Eloquent\Model;

class IngredientRepository extends Repository
{
    use Sales;
    public function __construct(Ingredient $ingredient)
    {
        parent::__construct($ingredient);
    }

    public function findByName(string $name): Model|null
    {
        return $this->model->where('name', $name)->first();
    }
}
