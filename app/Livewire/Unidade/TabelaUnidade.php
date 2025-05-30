<?php

namespace App\Livewire\Unidade;

use App\Services\UnidadeService;
use Livewire\Component;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class TabelaUnidade extends Component
{
    public int $perPage = 10;
    public int $page = 1;
    protected UnidadeService $service;

    public function boot(UnidadeService $service): void
    {
        $this->service = $service;
    }

    public function setPage(int $page): void
    {
        $this->page = $page;
    }

    public function render()
    {
        return view('livewire.unidade.tabela-unidade');
    }

    #[On('refresh-table')]
    #[Computed]
    public function unidades(): LengthAwarePaginator
    {
        return $this->service->getPaginate(perPage: $this->perPage, page: $this->page);
    }

    public function editUnidade(int $id): void
    {
        $unidade = $this->service->findById(id: $id);
        $this->dispatch('edit-unidade', unidade: $unidade)->to(ModalUnidade::class);
    }

    public function deleteUnidade(int $id): void
    {
        try {
            $this->service->delete(id: $id);
            $this->dispatch('refresh-table')->to(TabelaUnidade::class);
            $this->dispatch('notify', message: 'Unidade excluída com sucesso', variant: 'success', title: 'Sucesso');
        } catch (\Throwable $th) {
            $this->dispatch('notify', message: 'Erro ao excluir unidade', variant: 'error', title: 'Erro');
        }
    }
}
