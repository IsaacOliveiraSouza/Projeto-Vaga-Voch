<?php

namespace App\Repositories;

use App\Models\Colaborador;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ColaboradorRepository
{
    public function __construct(
        private Colaborador $model,
    ) {}
    public function all()
    {
        return $this->model->get();
    }

    public function filter(array $filtro, int $perPage = 10, int $page = 1): LengthAwarePaginator
    {
        return $this->model->query()
            ->when(data_get($filtro, 'colaboradorId'), fn($q) => $q->whereIn('id', $filtro['colaboradorId']))
            ->when(data_get($filtro, 'unidadeId'), fn($q) => $q->whereIn('unidade_id', $filtro['unidadeId']))
            ->when(data_get($filtro, 'bandeiraId'), function ($q) use ($filtro) {
                $q->whereHas('unidade', fn($q) => $q->whereIn('bandeira_id', $filtro['bandeiraId']));
            })
            ->when(data_get($filtro, 'grupoEconomicoId'), function ($q) use ($filtro) {
                $q->whereHas('unidade.bandeira', fn($q) => $q->whereIn('grupo_economico_id', $filtro['grupoEconomicoId']));
            })
            ->paginate(perPage: $perPage, page: $page);
    }

    public function paginate(int $perPage = 10, int $page = 1): LengthAwarePaginator
    {
        return $this->model->paginate(perPage: $perPage, page: $page);
    }
    public function findById(int $id): Colaborador
    {
        return $this->model->findOrFail(id: $id);
    }
    public function create(array $data): Colaborador
    {
        return $this->model->create(attributes: $data);
    }
    public function update(int $id, array $data): Colaborador
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
