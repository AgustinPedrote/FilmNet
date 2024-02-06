<x-app-layout>
    <!-- Mensajes de éxito y error -->
    <div class="relative z-10">
        @if (session('success'))
            <div class="absolute top-[-10px] left-0 w-full mr-10 z-50">
                <x-success :status="session('success')" />
            </div>
        @endif

        @if (session('error'))
            <div class="absolute top-[-10px] left-0 w-full mr-10 z-50">
                <x-error :status="session('error')" />
            </div>
        @endif
    </div>

    {{-- Campo de búsqueda con Alpine.js --}}
    <div x-data="buscarAudiovisual" x-init="buscarAudiovisual2" class="container mx-auto py-8 mt-6">

        {{-- Fila superior con campo de búsqueda --}}
        <div class="mb-4 text-center">
            <input type="text" x-model="searchTerm" x-on:keyup="buscarAudiovisual2" placeholder="Buscar audiovisual..."
                class="w-full md:w-1/2 p-4 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500 transition duration-300 ease-in-out mx-auto">
        </div>

        {{-- Fila inferior con desplegables --}}
        <div class="flex flex-wrap items-center justify-center space-y-4 md:space-y-0 md:space-x-4">

            {{-- Desplegable de géneros --}}
            <div class="w-full md:w-1/4 mb-4 md:mb-0">
                <select x-model="selectedGenre" x-on:change="buscarAudiovisual2"
                    class="w-full p-4 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500 transition duration-300 ease-in-out">
                    <option value="">Género</option>
                    @foreach ($generos as $genero)
                        <option value="{{ $genero->id }}">{{ $genero->nombre }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Desplegable de tipos --}}
            <div class="w-full md:w-1/4 mb-4 md:mb-0">
                <select x-model="selectedType" x-on:change="buscarAudiovisual2"
                    class="w-full p-4 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500 transition duration-300 ease-in-out">
                    <option value="">Tipo</option>
                    @foreach ($tipos as $tipo)
                        <option value="{{ $tipo->id }}">{{ $tipo->nombre }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Desplegable de recomendaciones de edad --}}
            <div class="w-full md:w-1/4 md:mb-0">
                <select x-model="selectedRecommendation" x-on:change="buscarAudiovisual2"
                    class="w-full p-4 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500 transition duration-300 ease-in-out">
                    <option value="">Recomendación</option>
                    <option value="todos">Todos los públicos</option>
                    <option value="mayores_13">Mayores de 13 años</option>
                    <option value="mayores_18">Mayores de 18 años</option>
                </select>
            </div>

        </div>

        {{-- Mostrar el título --}}
        <h1 class="text-2xl font-bold mb-6 mt-9 ml-10 border-b-2 border-blue-500 w-11/12 pb-2 text-gray-800">
            Audiovisuales
        </h1>

        {{-- Contenedor principal para los elementos de la categoría --}}
        <div x-html="resultados"
            class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6 justify-center mx-auto w-full">
            {{-- Se itera sobre los audiovisuales en audiovisuales._busqueda.blade.php y se renderiza --}}
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
