<?php

namespace App\Livewire\Colaborador;

use App\Models\Colaborador;
use App\Services\ColaboradorService;
use Livewire\Attributes\On;
use Livewire\Component;

class ModalColaborador extends Component
{
    public string $nome = '';
    public string $email = '';
    public string $cpf = '';
    public ?int $unidadeId = null;
    public ?Colaborador $colaborador = null;
    protected ColaboradorService $service;

    public function boot(ColaboradorService $service): void
    {
        $this->service = $service;
    }

    public function render()
    {
        return view('livewire.colaborador.modal-colaborador');
    }

    public function updateColaborador(): void
    {
        try {
            $this->service->update($this->colaborador->id, [
                'nome' => $this->nome,
                'email' => $this->email,
                'cpf' => $this->cpf,
                'unidade_id' => $this->unidadeId,
            ]);

            $this->resetForm();
            $this->dispatch('close-modal', name: 'modal-colaborador');
            $this->dispatch('refresh-table')->to(TabelaColaborador::class);
            $this->dispatch('notify', message: 'Colaborador atualizado com sucesso', variant: 'success', title: 'Sucesso');
        } catch (\Throwable $th) {
            $this->dispatch('notify', message: 'Erro ao atualizar colaborador', variant: 'danger', title: 'Erro');
        }
    }

    public function createColaborador(): void
    {
        $this->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'cpf' => 'required|string|max:255',
            'unidadeId' => 'required|integer',
        ]);

        try {
            if ($this->colaborador) {
                $this->updateColaborador();
                return;
            }

            $this->service->create([
                'nome' => $this->nome,
                'email' => $this->email,
                'cpf' => $this->cpf,
                'unidade_id' => $this->unidadeId,
            ]);

            $this->resetForm();
            $this->dispatch('close-modal', name: 'modal-colaborador');
            $this->dispatch('refresh-table')->to(TabelaColaborador::class);
            $this->dispatch('notify', message: 'Colaborador criado com sucesso', variant: 'success', title: 'Sucesso');
        } catch (\Throwable $th) {
            $this->dispatch('notify', message: 'Erro ao criar colaborador', variant: 'danger', title: 'Erro');
        }
    }

    #[On('edit-colaborador')]
    public function editColaborador(Colaborador $colaborador): void
    {
        $this->colaborador = $colaborador;
        $this->nome = $colaborador->nome;
        $this->email = $colaborador->email;
        $this->cpf = $colaborador->cpf;
        $this->unidadeId = $colaborador->unidade_id;

        $this->dispatch('open-modal-colaborador', name: 'modal-colaborador');
    }

    public function resetForm(): void
    {
        $this->reset([
            'nome',
            'email',
            'cpf',
            'unidadeId',
            'colaborador',
        ]);
    }
}
