<?php

namespace App\Services;

use App\Repositories\GrupoEconomicoRepository;
use App\Models\GrupoEconomico;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class GrupoEconomicoService
{
    public function __construct(
        private GrupoEconomicoRepository $repository,
    ) {}
    public function getAll()
    {
        return $this->repository->all();
    }
    public function getPaginate(int $perPage = 10): LengthAwarePaginator
    {
        return $this->repository->paginate(perPage: $perPage);
    }
    public function findById(int $id): GrupoEconomico
    {
        return $this->repository->findById(id: $id);
    }
    public function create(array $data): GrupoEconomico
    {
        try {
            return $this->repository->create(data: $data);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public function update(int $id, array $data): GrupoEconomico
    {
        try {
            return $this->repository->update(id: $id, data: $data);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public function delete(int $id): bool
    {
        try {
            return $this->repository->delete(id: $id);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}