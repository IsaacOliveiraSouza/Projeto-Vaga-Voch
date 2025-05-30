<div>
    <x-primary-button x-on:click="$openModal('modal-colaborador')">
        {{ __('Novo Colaborador') }}
    </x-primary-button>

    <x-modal name="modal-colaborador" width="lg" x-on:open-modal-colaborador.window="$openModal('modal-colaborador')"
        x-on:close="$wire.resetForm()">
        <x-card>
            <div class="p-4">
                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                    {{ __('Novo Colaborador') }}
                </h2>

                <div class="flex flex-col mt-6">
                    <x-input-label for="nome" :value="__('Nome')" />
                    <x-text-input wire:model="nome" id="nome" name="nome" type="text"
                        class="mt-1 block w-full" :value="old('nome')" required />
                    @error('nome')
                        <span class="mt-1 text-sm text-red-600">{{ $message }}</span>
                    @enderror

                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input wire:model="email" id="email" name="email" type="email"
                        class="mt-1 block w-full" :value="old('email')" required />
                    @error('email')
                        <span class="mt-1 text-sm text-red-600">{{ $message }}</span>
                    @enderror

                    <x-input-label for="cpf" :value="__('CPF')" />
                    <x-text-input wire:model="cpf" id="cpf" name="cpf" type="text"
                        class="mt-1 block w-full" :value="old('cpf')" required />
                    @error('cpf')
                        <span class="mt-1 text-sm text-red-600">{{ $message }}</span>
                    @enderror

                    <x-select label="Unidade" placeholder="Selecione uma unidade" :async-data="route('unidade.search')" option-label="nome"
                        option-value="id" wire:model="unidadeId" />
                </div>

                <div class="flex justify-end w-full mt-4">
                    <x-primary-button type="button" wire:click="createColaborador" wire:loading.attr="disabled"
                        wire:target="createColaborador">
                        {{ __('Salvar') }}
                    </x-primary-button>
                </div>
            </div>
        </x-card>
    </x-modal>
</div>
