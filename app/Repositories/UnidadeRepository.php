<?php

namespace App\Repositories;

use App\Models\Unidade;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class UnidadeRepository
{
    public function __construct(
        private Unidade $model,
    ) {}
    public function all()
    {
        return $this->model->get();
    }
    public function paginate(int $perPage = 10, int $page = 1): LengthAwarePaginator
    {
        return $this->model->paginate(perPage: $perPage, page: $page);
    }
    public function findById(int $id): Unidade
    {
        return $this->model->findOrFail(id: $id);
    }
    public function create(array $data): Unidade
    {
        return $this->model->create(attributes: $data);
    }
    public function update(int $id, array $data): Unidade
    {
        $account = $this->findById(id: $id);
        $account->update(attributes: $data);
        return $account;
    }
    public function delete(int $id): bool
    {
        $account = $this->findById(id: $id);
        return $account->delete();
    }
}
