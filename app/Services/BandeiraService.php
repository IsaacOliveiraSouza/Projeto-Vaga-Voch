<?php

namespace App\Services;

use App\Repositories\BandeiraRepository;
use App\Models\Bandeira;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class BandeiraService
{
    public function __construct(
        private BandeiraRepository $repository,
    ) {}
    public function getAll()
    {
        return $this->repository->all();
    }
    public function getPaginate(int $perPage = 10, int $page = 1): LengthAwarePaginator
    {
        return $this->repository->paginate(perPage: $perPage, page: $page);
    }
    public function findById(int $id): Bandeira
    {
        return $this->repository->findById(id: $id);
    }
    public function create(array $data): Bandeira
    {
        try {
            return $this->repository->create(data: $data);
        } catch (\Throwable $th) {
            throw $th;
        }
    }


public function filter(array $filtro, int $perPage = 10, int $page = 1): LengthAwarePaginator
{
    return $this->repository->filter(filtro: $filtro, perPage: $perPage, page: $page);
}
    public function update(int $id, array $data): Bandeira
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
