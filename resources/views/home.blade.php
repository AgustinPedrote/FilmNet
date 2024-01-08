<x-app-layout>
    {{-- Filtro de búsqueda con Alpine.js --}}
    <div x-data="{ searchTerm: '' }">
        <div class="md:w-1/3 mx-auto">
            <input type="text" x-model="searchTerm" placeholder="Buscar..."
                class="w-full p-3 mb-4 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500 transition duration-300 ease-in-out">
        </div>

        {{-- Iterar sobre todas las categorías --}}
        @foreach (['Audiovisuales' => $audiovisuales] as $title => $items)
            {{-- Mostrar el título de la categoría --}}
            <h1 class="text-2xl font-bold mb-6 mt-9 ml-10 border-b-2 border-blue-500 w-11/12 pb-2 text-gray-800">
                {{ $title }}
            </h1>

            {{-- Contenedor principal para los elementos de la categoría --}}
            <div
                class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6 justify-center mx-auto  w-full">
                {{-- Iterar sobre todos los audiovisuales --}}
                @foreach ($items as $item)
                    {{-- Aplicar filtro de búsqueda con Alpine.js --}}
                    <template
                        x-if="searchTerm === '' || '{{ strtolower($item->titulo) }}'.includes(searchTerm.toLowerCase())">
                        <a href="{{ route('audiovisual.show', $item) }}"
                            class="group p-4 transition duration-300 ease-in-out transform hover:scale-105">

                            <div class="relative w-full h-64 overflow-hidden rounded-md shadow-md">
                                <img src="{{ asset($item->img) }}" alt="{{ $item->titulo }}"
                                    class="object-cover w-full h-full transition duration-300 ease-in-out transform scale-100 group-hover:scale-110" />
                            </div>

                            <div class="mt-3 text-center">
                                <div class="text-lg font-semibold text-gray-800">{{ $item->titulo }}</div>
                            </div>
                        </a>
                    </template>
                @endforeach
            </div>
        @endforeach
    </div>

    @include('components.cookies')
</x-app-layout>
