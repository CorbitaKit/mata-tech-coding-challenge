<?php

namespace App\Services\API\v1;

use App\Repositories\API\v1\PizzaTypeRepository;
use App\Services\Service;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PizzaTypeService extends Service
{
    public function __construct(
        PizzaTypeRepository $repo,
        protected IngredientService $ingredientService
    )
    {
        parent::__construct($repo);
    }

    public function findBySlug(string $slug): int|null
    {
        return $this->repo->findBySlug($slug);
    }

    public function create(array $data): Model
    {
        if ($this->findBySlug($data['slug'])) {
            throw new \InvalidArgumentException("Pizza type is already added");
        }

        return DB::transaction(function () use ($data){
            $model = $this->repo->create($data);

            $ingredientIds = $this->ingredientService->insert($data['ingredients']);

            $model->ingredients()->attach($ingredientIds);

            return $model;

        });
    }
}
