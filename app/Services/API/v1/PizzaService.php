<?php

namespace App\Services\API\v1;

use App\Repositories\API\v1\PizzaRepository;
use App\Services\Service;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PizzaService extends Service
{
    public function __construct(PizzaRepository $pizzaRepository)
    {
        parent::__construct($pizzaRepository);
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
            return $this->repo->create($data);
        });
    }
}
