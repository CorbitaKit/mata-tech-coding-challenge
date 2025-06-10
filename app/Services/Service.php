<?php

namespace App\Services;

use App\Interfaces\CRUDInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class Service implements CRUDInterface
{
    public function __construct(protected $repo){}

    public function get(): Collection
    {
        return $this->repo->get();
    }

    public function create(array $data): Model
    {
        return $this->repo->create($data);
    }

    public function update(array $data, int $id): Model
    {
        return $this->repo->update($data, $id);
    }

    public function delete(int $id): bool
    {
        return $this->repo->delete($id);
    }
}
