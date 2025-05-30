<?php

namespace App\Services;

use App\Repositories\UnidadeRepository;
use App\Models\Unidade;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class UnidadeService
{
    public function __construct(
        private UnidadeRepository $repository,
    ) {}
    public function getAll()
    {
        return $this->repository->all();
    }
    public function getPaginate(int $perPage = 10, int $page = 1): LengthAwarePaginator
    {
        return $this->repository->paginate(perPage: $perPage, page: $page);
    }
    public function findById(int $id): Unidade
    {
        return $this->repository->findById(id: $id);
    }
    public function create(array $data): Unidade
    {
        try {
            return $this->repository->create(data: $data);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public function update(int $id, array $data): Unidade
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
