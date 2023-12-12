<x-app-layout>
    <!-- Título de Novedades -->
    <h1 class="text-3xl font-extrabold text-center">
        <span class="relative inline-block rounded-lg overflow-hidden">
            <span class="absolute inset-0 bg-gradient-to-r from-blue-500 to-blue-500 border border-blue-600"></span>
            <span class="relative text-white z-10 p-4">Novedades</span>
        </span>
    </h1>

    {{-- Iterar sobre las categorías y sus elementos --}}
    @foreach (['Películas' => $peliculas, 'Series' => $series, 'Documentales' => $documentales] as $title => $items)
        {{-- Mostrar el título de la categoría --}}
        <h1 class="text-2xl font-bold mb-6 mt-9 ml-10 border-b-2 border-blue-500 w-11/12 pb-2 text-gray-800">
            {{ $title }}</h1>

        {{-- Contenedor principal para los elementos de la categoría --}}
        <div
            class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6 justify-center mx-auto">
            {{-- Iterar sobre los elementos de la categoría --}}
            @foreach ($items as $item)
                {{-- Enlace a la ruta 'audiovisual.show' con el elemento como parámetro --}}
                <a href="{{ route('audiovisual.show', $item) }}"
                    class="group p-4 transition duration-300 ease-in-out transform hover:scale-105">
                    {{-- Contenedor de la imagen del elemento --}}
                    <div class="relative w-full h-64 overflow-hidden rounded-md shadow-md">
                        {{-- Mostrar la imagen del elemento --}}
                        <img src="{{ $item->img }}" alt="{{ $item->titulo }}"
                            class="object-cover w-full h-full transition duration-300 ease-in-out transform scale-100 group-hover:scale-110" />
                    </div>

                    {{-- Contenedor para el título del elemento --}}
                    <div class="mt-3 text-center">
                        {{-- Mostrar el título del elemento --}}
                        <div class="text-lg font-semibold text-gray-800">{{ $item->titulo }}</div>
                    </div>
                </a>
            @endforeach
        </div>
    @endforeach

    @include('components.cookies')
</x-app-layout>
