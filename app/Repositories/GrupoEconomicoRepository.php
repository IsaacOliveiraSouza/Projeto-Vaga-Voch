<?php

namespace App\Repositories;

use App\Models\GrupoEconomico;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class GrupoEconomicoRepository
{
    public function __construct(
        private GrupoEconomico $model,
    ) {}
    public function all()
    {
        return $this->model->get();
    }

    public function filter(array $filtro, int $perPage = 10, int $page = 1): LengthAwarePaginator
    {
        return $this->model->query()
            ->when(data_get($filtro, 'grupoEconomicoId'), fn($q) => $q->whereIn('id', $filtro['grupoEconomicoId']))
            ->paginate(perPage: $perPage, page: $page);
    }

    public function paginate(int $perPage = 10, int $page = 1): LengthAwarePaginator
    {
        return $this->model->paginate(perPage: $perPage, page: $page);
    }
    public function findById(int $id): GrupoEconomico
    {
        return $this->model->findOrFail(id: $id);
    }
    public function create(array $data): GrupoEconomico
    {
        return $this->model->create(attributes: $data);
    }
    public function update(int $id, array $data): GrupoEconomico
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
