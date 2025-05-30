<div>
    <x-primary-button x-on:click="$openModal('modal-bandeira')">
        {{ __('Nova Bandeira') }}
    </x-primary-button>

    <x-modal name="modal-bandeira" width="lg" x-on:open-modal-bandeira.window="$openModal('modal-bandeira')"
        x-on:close="$wire.resetForm()">
        <x-card>

            <div class="p-4">
                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                    {{ __('Nova Bandeira') }}
                </h2>

                <div class="flex flex-col mt-6">
                    <x-input-label for="nome" :value="__('Nome')" />
                    <x-text-input wire:model="nome" id="nome" name="nome" type="text"
                        class="mt-1 block w-full" :value="old('nome')" required />
                    @error('nome')
                        <span class="mt-1 text-sm text-red-600">{{ $message }}</span>
                    @enderror

                    <x-select label="Grupo Econômico" placeholder="Selecione um grupo econômico" :async-data="route('grupo-economico.search')"
                        option-label="nome" option-value="id" wire:model="grupoEconomicoId" />
                </div>

                <div class="flex justify-end w-full mt-4">
                    <x-primary-button type="button" wire:click="createBandeira" wire:loading.attr="disabled"
                        wire:target="createBandeira">
                        {{ __('Salvar') }}
                    </x-primary-button>
                </div>
            </div>
        </x-card>
    </x-modal>
</div>
