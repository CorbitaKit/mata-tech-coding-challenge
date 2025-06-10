<?php

namespace App\Repositories\API;

use App\Models\Ingredient;
use App\Repositories\Repository;
use Illuminate\Database\Eloquent\Model;

class IngredientRepository extends Repository
{
    public function __construct(Ingredient $ingredient)
    {
        parent::__construct($ingredient);
    }

    public function findByName(string $name): Model|null
    {
        return $this->model->where('name', $name)->first();
    }
}
