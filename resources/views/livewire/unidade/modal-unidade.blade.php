<div>
    <x-primary-button x-on:click="$openModal('modal-unidade')">
        {{ __('Nova Unidade') }}
    </x-primary-button>

    <x-modal name="modal-unidade" width="lg" x-on:open-modal-unidade.window="$openModal('modal-unidade')"
        x-on:close="$wire.resetForm()">
        <x-card>
            <div class="p-4">
                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                    {{ __('Nova Unidade') }}
                </h2>

                <div class="flex flex-col mt-6">
                    <x-input-label for="nomeFantasia" :value="__('Nome Fantasia')" />
                    <x-text-input wire:model="nomeFantasia" id="nomeFantasia" name="nomeFantasia" type="text"
                        class="mt-1 block w-full" :value="old('nomeFantasia')" required />
                    @error('nomeFantasia')
                        <span class="mt-1 text-sm text-red-600">{{ $message }}</span>
                    @enderror

                    <x-input-label for="razaoSocial" :value="__('Razão Social')" />
                    <x-text-input wire:model="razaoSocial" id="razaoSocial" name="razaoSocial" type="text"
                        class="mt-1 block w-full" :value="old('razaoSocial')" required />
                    @error('razaoSocial')
                        <span class="mt-1 text-sm text-red-600">{{ $message }}</span>
                    @enderror

                    <x-input-label for="cnpj" :value="__('CNPJ')" />
                    <x-text-input wire:model="cnpj" id="cnpj" name="cnpj" type="text"
                        class="mt-1 block w-full" :value="old('cnpj')" required />
                    @error('cnpj')
                        <span class="mt-1 text-sm text-red-600">{{ $message }}</span>
                    @enderror

                    <x-select label="Bandeira" placeholder="Selecione uma bandeira" :async-data="route('bandeira.search')"
                        option-label="nome" option-value="id" wire:model="bandeiraId" />

                    <div class="flex justify-end w-full mt-4">
                        <x-primary-button type="button" wire:click="createUnidade" wire:loading.attr="disabled"
                            wire:target="createUnidade">
                            {{ __('Salvar') }}
                        </x-primary-button>
                    </div>
                </div>
            </div>
        </x-card>
    </x-modal>
</div>
