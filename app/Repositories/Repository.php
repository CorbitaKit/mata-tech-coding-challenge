<?php

namespace App\Repositories;

use App\Interfaces\CRUDInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class Repository implements CRUDInterface
{
    public function __construct(protected Model $model){}

    public function get(): Collection
    {
        return $this->model->get();
    }

    public function create(array $data): Model
    {
        return $this->model->create($data);
    }

    public function update(array $data, int $id): Model
    {
        $model = $this->model->findOrFail($id);
        $model->update($data);
        return $model;
    }

    public function delete(int $id): bool
    {
        $model = $this->model->findOrFail($id);

        return $model->delete();
    }
}
