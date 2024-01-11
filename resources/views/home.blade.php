<x-app-layout>
    {{-- Campo de búsqueda con Alpine.js --}}
    <div x-data="buscarAudiovisual" x-init="buscarAudiovisual2" class="container mx-auto py-8">
        <div class="md:w-1/2 mx-auto mb-4">
            <input type="text" x-model="searchTerm" x-on:keyup="buscarAudiovisual2" placeholder="Buscar..."
                class="w-full p-4 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500 transition duration-300 ease-in-out">
        </div>

        {{-- Desplegable de géneros --}}
        <div class="md:w-1/2 mx-auto mb-4">
            <select x-model="selectedGenre" x-on:change="buscarAudiovisual2"
                class="w-full p-4 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500 transition duration-300 ease-in-out">
                <option value="">Todos los géneros</option>
                @foreach ($generos as $genero)
                    <option value="{{ $genero->id }}">{{ $genero->nombre }}</option>
                @endforeach
            </select>
        </div>

        {{-- Mostrar el título --}}
        <h1 class="text-2xl font-bold mb-6 mt-9 ml-10 border-b-2 border-blue-500 w-11/12 pb-2 text-gray-800">
            Audiovisuales
        </h1>

        {{-- Contenedor principal para los elementos de la categoría --}}
        <div x-html="resultados"
            class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6 justify-center mx-auto  w-full">
            {{-- Se itera sobre los audiovisuales en audiovisuales._busqueda --}}

        </div>

        {{-- Mensaje cuando no hay resultados con Alpine.js --}}
        <template x-if="resultados.length === 0">
            <p class="text-gray-500 text-lg text-center mt-8 h-screen">
                No se encontraron resultados de búsqueda
            </p>
        </template>
    </div>

    <!-- Lógica de las cookies -->
    @include('components.cookies')

    <!-- Script para el buscador de audiovisuales -->
    <script src="{{ asset('js/buscar-audiovisual.js') }}"></script>
</x-app-layout>
