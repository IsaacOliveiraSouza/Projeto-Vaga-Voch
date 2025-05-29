<x-app-layout>
    <div class="py-12" x-data="modalHandler()">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-4xl">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Novo Grupo Econômico') }}
                            </h2>
                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                {{ __('Preencha as informações para criar ou editar um Grupo.') }}
                            </p>
                        </header>

                        <table class="table-auto border border-gray-300 w-full mt-4">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="border px-4 py-2">ID</th>
                                    <th class="border px-4 py-2">Nome</th>
                                    <th class="border px-4 py-2">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($gruposeconomicos as $grupo)
                                    <tr class="text-white">
                                        <td class="border px-4 py-2">{{ $grupo->id }}</td>
                                        <td class="border px-4 py-2">{{ $grupo->nome }}</td>
                                        <td class="border px-4 py-2">
                                            <button 
                                                @click="openModal({{ $grupo->id }})"
                                                class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">
                                                Editar
                                            </button>
                                            
                                            <button
                                                @click="openDeleteModal({{ $grupo->id }})"
                                                class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 ml-2"
                                            >
                                                Excluir
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </section>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div 
            x-show="open"
            x-cloak
            class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50"
        >
            <div class="bg-white p-6 rounded-lg shadow-lg w-1/2 relative max-h-[80vh] overflow-y-auto">
                <button 
                    @click="open = false"
                    class="absolute top-2 right-2 text-gray-500 hover:text-gray-700"
                >
                    ✕
                </button>


                <div x-html="content"></div>
            </div>
        </div>
    </div>

  <script>
    function modalHandler() {
        return {
            open: false,
            content: '',
            deleteId: null,
            async openModal(id) {
                const res = await fetch(`/grupo-economico/${id}/edit`);
                const html = await res.text();
                this.content = html;
                this.open = true;
            },

            async openDeleteModal(id) {
                const res = await fetch(`/grupo-economico/${id}/confirm-delete`);
                const html = await res.text();

                this.content = html;
                this.open = true;
            }
        };
    }
</script>

</x-app-layout>
