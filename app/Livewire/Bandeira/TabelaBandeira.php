<?php

namespace App\Livewire\Bandeira;

use App\Services\BandeiraService;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;
use Spatie\Activitylog\Facades\Activity;

class TabelaBandeira extends Component
{
    public int $perPage = 10;
    public int $page = 1;
    protected BandeiraService $service;
    public array $filtros = [];
    public array $grupoEconomicoId = [];
    public array $bandeiraId = [];

    public function render()
    {
        return view('livewire.bandeira.tabela-bandeira');
    }

    public function boot(BandeiraService $service): void
    {
        $this->service = $service;
    }

    public function setPage(int $page): void
    {
        $this->page = $page;
    }

    #[On('refresh-table')]
    #[Computed]
public function bandeiras(): LengthAwarePaginator
{
    $this->filtros = [
        'grupoEconomicoId' => $this->grupoEconomicoId,
        'bandeiraId' => $this->bandeiraId,
    ];

    return $this->service->filter(perPage: $this->perPage, page: $this->page, filtro: $this->filtros);
}

    
    public function editBandeira(int $id): void
    {
        try {
            $bandeira = $this->service->findById($id);
            $this->dispatch('edit-bandeira', bandeira: $bandeira)->to(ModalBandeira::class);
        } catch (\Throwable $th) {
            $this->dispatch('notify', message: 'Erro ao editar bandeira', variant: 'danger', title: 'Erro');
        }
    }

    public function deleteBandeira(int $id): void
    {
        try {
             $bandeira = $this->service->findById($id);
            $this->service->delete($id);

             Activity::performedOn($bandeira)
                ->causedBy(auth()->user())
                ->withProperties([
                    'nome' => $bandeira->nome,
                    'grupo_economico_id' => $bandeira->grupo_economico_id,
                ])
                ->log('Excluiu uma bandeira');

            $this->dispatch('notify', message: 'Bandeira excluída com sucesso', variant: 'success', title: 'Sucesso');
        } catch (\Throwable $th) {
            $this->dispatch('notify', message: 'Erro ao excluir bandeira', variant: 'danger', title: 'Erro');
        }
    }
}
