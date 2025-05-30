<?php

namespace App\Livewire\GrupoEconomico;

use App\Services\GrupoEconomicoService;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;

class TabelaGrupoEconomico extends Component
{
    public int $perPage = 10;
    public int $page = 1;
    protected GrupoEconomicoService $service;
    public ?array $grupoEconomicoId = [];
    public array $filtros = [];

    public function render()
    {
        return view('livewire.grupo-economico.tabela-grupo-economico');
    }

    public function boot(GrupoEconomicoService $service): void
    {
        $this->service = $service;
    }

    public function setPage(int $page): void
    {
        $this->page = $page;
    }

    #[On('refresh-table')]
    #[Computed]
    public function gruposEconomicos(): LengthAwarePaginator
    {
        $this->filtros = [
            'grupoEconomicoId' => $this->grupoEconomicoId,
        ];

        return $this->service->filter(perPage: $this->perPage, page: $this->page, filtro: $this->filtros);
    }

    public function editGrupoEconomico(int $id): void
    {
        try {
            $grupoEconomico = $this->service->findById($id);
            $this->dispatch('edit-grupo-economico', grupoEconomico: $grupoEconomico)->to(ModalGrupoEconomico::class);
        } catch (\Throwable $th) {
            $this->dispatch('notify', message: 'Erro ao editar grupo econômico', variant: 'danger', title: 'Erro');
        }
    }

    public function Exportar(){
        dd("Exportar");
    }

    public function deleteGrupoEconomico(int $id): void
    {
        try {
            $this->service->delete($id);
            $this->dispatch('notify', message: 'Grupo econômico excluído com sucesso', variant: 'success', title: 'Sucesso');
        } catch (\Throwable $th) {
            $this->dispatch('notify', message: 'Erro ao excluir grupo econômico', variant: 'danger', title: 'Erro');
        }
    }
}
