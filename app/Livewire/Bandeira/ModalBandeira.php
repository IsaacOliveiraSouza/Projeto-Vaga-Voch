<?php

namespace App\Livewire\Bandeira;

use App\Services\BandeiraService;
use App\Models\Bandeira;
use Livewire\Attributes\On;
use Livewire\Component;

class ModalBandeira extends Component
{
    public string $nome = '';
    public ?int $grupoEconomicoId = null;
    protected BandeiraService $service;
    public ?Bandeira $bandeira = null;

    public function boot(BandeiraService $service): void
    {
        $this->service = $service;
    }

    public function updateBandeira(): void
    {
        try {
            $this->service->update($this->bandeira->id, [
                'nome' => $this->nome,
                'grupo_economico_id' => $this->grupoEconomicoId,
            ]);

            $this->reset([
                'nome',
                'bandeira',
                'grupoEconomicoId',
            ]);
            $this->dispatch('close-modal', name: 'modal-bandeira');
            $this->dispatch('refresh-table')->to(TabelaBandeira::class);
            $this->dispatch('notify', message: 'Bandeira atualizada com sucesso', variant: 'success', title: 'Sucesso');
        } catch (\Throwable $th) {
            $this->dispatch('notify', message: 'Erro ao atualizar bandeira', variant: 'danger', title: 'Erro');
        }
    }

    public function createBandeira(): void
    {
        $this->validate([
            'nome' => 'required|string|max:255',
            'grupoEconomicoId' => 'required|exists:grupo_economicos,id',
        ]);

        try {
            if ($this->bandeira) {

                $this->updateBandeira();
                return;
            }

            $this->service->create([
                'nome' => $this->nome,
                'grupo_economico_id' => $this->grupoEconomicoId,
            ]);

            $this->reset([
                'nome',
                'bandeira',
                'grupoEconomicoId',
            ]);
            $this->dispatch('close-modal', name: 'modal-bandeira');
            $this->dispatch('refresh-table')->to(TabelaBandeira::class);
            $this->dispatch('notify', message: 'Bandeira criada com sucesso', variant: 'success', title: 'Sucesso');
        } catch (\Throwable $th) {
            $this->dispatch('notify', message: 'Erro ao criar bandeira', variant: 'danger', title: 'Erro');
        }
    }

    #[On('edit-bandeira')]
    public function editBandeira(Bandeira $bandeira): void
    {
        $this->bandeira = $bandeira;
        $this->nome = $bandeira->nome;
        $this->grupoEconomicoId = $bandeira->grupo_economico_id;
        $this->dispatch('open-modal-bandeira', name: 'modal-bandeira');
    }

    public function resetForm(): void
    {
        $this->reset([
            'nome',
            'bandeira',
            'grupoEconomicoId',
        ]);
    }

    public function render()
    {
        return view('livewire.bandeira.modal-bandeira');
    }
}
