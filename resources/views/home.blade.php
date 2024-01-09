<x-app-layout>
    {{-- Filtro de búsqueda con Alpine.js --}}
    <div x-data="buscarAudiovisual" x-init="buscarAudiovisual2" class="h-full">
        <div class="md:w-1/3 mx-auto">
            <input type="text" x-model="searchTerm" x-on:keyup="buscarAudiovisual2" placeholder="Buscar..."
                class="w-full p-3 mb-4 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500 transition duration-300 ease-in-out">
        </div>

        <script>
            function buscarAudiovisual() {
                return {
                    searchTerm: '',
                    resultados: [],

                    buscarAudiovisual2() {
                        let titulo = this.searchTerm.trim().toLowerCase();

                        axios.get(`/buscar-audiovisual`, {
                                params: {
                                    search: titulo,
                                }
                            })
                            .then(response => {
                                this.resultados = response.data;
                            })
                            .catch(error => {
                                console.error(error);
                            });
                    }
                };
            }
        </script>

        {{-- Mostrar el título --}}
        <h1 class="text-2xl font-bold mb-6 mt-9 ml-10 border-b-2 border-blue-500 w-11/12 pb-2 text-gray-800">
            Audiovisuales
        </h1>

        {{-- Contenedor principal para los elementos de la categoría --}}
        <div x-html="resultados"
            class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6 justify-center mx-auto  w-full">
            {{-- Iterar sobre todos los audiovisuales --}}

        </div>

        <template x-if="resultados.length === 0">
            <p class="text-gray-500 text-lg text-center mt-8 h-screen">
                No se encontraron resultados de búsqueda
            </p>
        </template>
    </div>

    @include('components.cookies')
</x-app-layout>
