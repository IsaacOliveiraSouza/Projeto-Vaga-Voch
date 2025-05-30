<?php

namespace App\Livewire\Colaborador;

use App\Services\ColaboradorService;
use Livewire\Component;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class TabelaColaborador extends Component
{
    public int $perPage = 10;
    public int $page = 1;
    protected ColaboradorService $service;
    public ?array $grupoEconomicoId = [];
    public ?array $unidadeId = [];
    public ?array $bandeiraId = [];
    public ?array $colaboradorId = [];
    public array $filtros = [];

    public function boot(ColaboradorService $service): void
    {
        $this->service = $service;
    }

    public function setPage(int $page): void
    {
        $this->page = $page;
    }

    public function render()
    {
        return view('livewire.colaborador.tabela-colaborador');
    }

    #[On('refresh-table')]
    #[Computed]
    public function colaboradores(): LengthAwarePaginator
    {
        $this->filtros = [
            'grupoEconomicoId' => $this->grupoEconomicoId,
            'unidadeId' => $this->unidadeId,
            'bandeiraId' => $this->bandeiraId,
            'colaboradorId' => $this->colaboradorId,
        ];

        return $this->service->filter(perPage: $this->perPage, page: $this->page, filtro: $this->filtros);
    }

    public function editColaborador(int $id): void
    {
        try {
            $colaborador = $this->service->findById(id: $id);
            $this->dispatch('edit-colaborador', colaborador: $colaborador)->to(ModalColaborador::class);
        } catch (\Throwable $th) {
            $this->dispatch('notify', message: 'Erro ao editar colaborador', variant: 'danger', title: 'Erro');
        }
    }

    public function deleteColaborador(int $id): void
    {
        try {
            $this->service->delete(id: $id);
            $this->dispatch('refresh-table')->to(TabelaColaborador::class);
            $this->dispatch('notify', message: 'Colaborador excluído com sucesso', variant: 'success', title: 'Sucesso');
        } catch (\Throwable $th) {
            $this->dispatch('notify', message: 'Erro ao excluir colaborador', variant: 'danger', title: 'Erro');
        }
    }
}
