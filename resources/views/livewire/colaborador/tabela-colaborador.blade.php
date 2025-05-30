<div class="py-12 text-gray-900 dark:text-gray-100">
    <x-select label="Grupo Econômico" placeholder="Selecione um grupo econômico" :async-data="route('grupo-economico.search')" option-label="nome"
        option-value="id" wire:model.live="grupoEconomicoId" multiselect />
    <x-select label="Unidade" placeholder="Selecione uma unidade" :async-data="route('unidade.search')" option-label="nome" option-value="id"
        wire:model.live="unidadeId" multiselect />
    <x-select label="Bandeira" placeholder="Selecione uma bandeira" :async-data="route('bandeira.search')" option-label="nome"
        option-value="id" wire:model.live="bandeiraId" multiselect />
    <x-select label="Colaborador" placeholder="Selecione um colaborador" :async-data="route('colaborador.search')" option-label="nome"
        option-value="id" wire:model.live="colaboradorId" multiselect />
    @if (count($this->colaboradores) > 0)

        <table
            class="w-full text-left text-sm text-on-surface dark:text-on-surface-dark>
            <thead
                class="border-b
            border-outline bg-surface-alt text-sm text-on-surface-strong dark:border-outline-dark
            dark:bg-surface-dark-alt dark:text-on-surface-dark-strong">
            <tr>
                <th scope="col" class="p-4">ID</th>
                <th scope="col" class="p-4">Nome</th>
                <th scope="col" class="p-4">Email</th>
                <th scope="col" class="p-4">CPF</th>
                <th scope="col" class="p-4">Unidade</th>
                <th scope="col" class="p-4">Ações</th>
            </tr>
            </thead>
            <tbody class="divide-y divide-outline dark:divide-outline-dark">
                @foreach ($this->colaboradores as $colaborador)
                    <tr>
                        <td class="p-4">{{ $colaborador->id }}</td>
                        <td class="p-4">{{ $colaborador->nome }}</td>
                        <td class="p-4">{{ $colaborador->email }}</td>
                        <td class="p-4">{{ $colaborador->cpf }}</td>
                        <td class="p-4">{{ $colaborador->unidade->nome_fantasia }}</td>
                        <td class="p-4">
                            <x-primary-button wire:click="editColaborador({{ $colaborador->id }})">
                                {{ __('Editar') }}
                            </x-primary-button>
                            <x-primary-button wire:click="deleteColaborador({{ $colaborador->id }})">
                                {{ __('Excluir') }}
                            </x-primary-button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4 flex justify-center">
            <x-pagination :paginator="$this->colaboradores" />
        </div>
    @else
        <div class="mt-4 flex justify-center">
            <p class="text-sm text-gray-500">Nenhum colaborador encontrado</p>
        </div>
    @endif
</div>
