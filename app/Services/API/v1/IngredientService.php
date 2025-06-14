<?php

namespace App\Services\API\v1;

use App\Repositories\API\v1\IngredientRepository;
use App\Services\Service;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class IngredientService extends Service
{
    public function __construct(IngredientRepository $ingredientRepository)
    {
        parent::__construct($ingredientRepository);
    }

    public function findByName(string $name): Model|null
    {
        return $this->repo->findByName($name);
    }

    public function insert(string $data): array
    {
        $ingredientIds = [];

        $ingredients = explode(',', $data);

        foreach ($ingredients as $ingredient) {
            $model = $this->findByName($ingredient);

            if (!$model) {
                $model = $this->repo->create(['name' => $ingredient]);
            }

            array_push($ingredientIds, $model->id);
        }

        return $ingredientIds;
    }

    public function topSellingIngredients(): Collection
    {
        return $this->repo->topSellingIngredients();
    }
}
