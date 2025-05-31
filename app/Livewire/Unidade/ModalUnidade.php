<?php

namespace App\Livewire\Unidade;

use App\Models\Unidade;
use App\Rules\CnpjValido;
use App\Services\UnidadeService;
use Livewire\Attributes\On;
use Livewire\Component;
use Spatie\Activitylog\Facades\Activity;

class ModalUnidade extends Component
{
    public string $nomeFantasia = '';
    public string $razaoSocial = '';
    public string $cnpj = '';
    public ?int $bandeiraId = null;
    protected UnidadeService $service;
    public ?Unidade $unidade = null;

    public function boot(UnidadeService $service): void
    {
        $this->service = $service;
    }

    public function render()
    {
        return view('livewire.unidade.modal-unidade');
    }

    public function updateUnidade(): void
    {
        try {
            $unidade = $this->service->update($this->unidade->id, [
                'nome_fantasia' => $this->nomeFantasia,
                'razao_social' => $this->razaoSocial,
                'cnpj' => $this->cnpj,
                'bandeira_id' => $this->bandeiraId,
            ]);

                Activity::performedOn($unidade)
                ->causedBy(auth()->user())
                ->withProperties([
                    'nome_fantasia' => $unidade->nomeFantasia,
                    'razao_social' => $unidade->razaoSocial,
                    'cnpj' => $unidade->cnpj,
                    'bandeira_id' => $unidade->bandeira_id,
                ])
                ->log('Atualizou uma unidade');
                
            $this->resetForm();
            $this->dispatch('close-modal', name: 'modal-unidade');
            $this->dispatch('refresh-table')->to(TabelaUnidade::class);
            $this->dispatch('notify', message: 'Unidade atualizada com sucesso', variant: 'success', title: 'Sucesso');
        } catch (\Throwable $th) {
            $this->dispatch('notify', message: 'Erro ao atualizar unidade', variant: 'error', title: 'Erro');
        }
    }

    public function createUnidade(): void
    {
        $this->validate([
            'nomeFantasia' => 'required|string|max:255',
            'razaoSocial' => 'required|string|max:255',
            'cnpj' => ['required', new CnpjValido()],
        ]);

        try {
            if ($this->unidade) {
                $this->updateUnidade();
                return;
            }

            $unidade = $this->service->create([
                'nome_fantasia' => $this->nomeFantasia,
                'razao_social' => $this->razaoSocial,
                'cnpj' => $this->cnpj,
                'bandeira_id' => $this->bandeiraId,
            ]);

            Activity::performedOn($unidade)
                ->causedBy(auth()->user())
                ->withProperties([
                    'nome_fantasia' => $unidade->nomeFantasia,
                    'razao_social' => $unidade->razaoSocial,
                    'cnpj' => $unidade->cnpj,
                    'bandeira_id' => $unidade->bandeira_id,
                ])
                ->log('Criou uma unidade');

            $this->resetForm();
            $this->dispatch('close-modal', name: 'modal-unidade');
            $this->dispatch('refresh-table')->to(TabelaUnidade::class);
            $this->dispatch('notify', message: 'Unidade criada com sucesso', variant: 'success', title: 'Sucesso');
        } catch (\Throwable $th) {
            $this->dispatch('notify', message: 'Erro ao criar unidade', variant: 'error', title: 'Erro');
        }
    }

    #[On('edit-unidade')]
    public function editUnidade(Unidade $unidade): void
    {
        $this->unidade = $unidade;
        $this->nomeFantasia = $unidade->nome_fantasia;
        $this->razaoSocial = $unidade->razao_social;
        $this->cnpj = $unidade->cnpj;
        $this->bandeiraId = $unidade->bandeira_id;

        $this->dispatch('open-modal-unidade', name: 'modal-unidade');
    }

    public function resetForm(): void
    {
        $this->reset([
            'nomeFantasia',
            'razaoSocial',
            'cnpj',
            'bandeiraId',
            'unidade',
        ]);
    }
}
