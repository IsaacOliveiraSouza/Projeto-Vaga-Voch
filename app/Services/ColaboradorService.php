<?php

namespace App\Services;

use App\Repositories\ColaboradorRepository;
use App\Models\Colaborador;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ColaboradorService
{
    public function __construct(
        private ColaboradorRepository $repository,
    ) {}
    public function getAll()
    {
        return $this->repository->all();
    }

    public function filter(array $filtro, int $perPage = 10, int $page = 1): LengthAwarePaginator
    {
        return $this->repository->filter(filtro: $filtro, perPage: $perPage, page: $page);
    }

    public function getPaginate(int $perPage = 10, int $page = 1): LengthAwarePaginator
    {
        return $this->repository->paginate(perPage: $perPage, page: $page);
    }
    public function findById(int $id): Colaborador
    {
        return $this->repository->findById(id: $id);
    }
    public function create(array $data): Colaborador
    {
        try {
            return $this->repository->create(data: $data);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public function update(int $id, array $data): Colaborador
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
