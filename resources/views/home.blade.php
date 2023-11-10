<x-app-layout>
    {{-- Iterar sobre las categorías y sus elementos --}}
    @foreach (['Películas nuevas' => $peliculas, 'Series nuevas' => $series, 'Documentales nuevos' => $documentales] as $title => $items)
        {{-- Mostrar el título de la categoría --}}
        <h1 class="text-xl font-bold my-6 ml-10 border-b-2">{{ $title }}</h1>

        {{-- Contenedor principal para los elementos de la categoría --}}
        <div class="movie-card-13 grid grid-cols-3 gap-4 justify-center mx-auto">
            {{-- Iterar sobre los elementos de la categoría --}}
            @foreach ($items as $item)
                {{-- Enlace a la ruta 'audiovisual.show' con el elemento como parámetro --}}
                <a href="{{ route('audiovisual.show', $item) }}" class="flex-1 p-4">
                    {{-- Contenedor de la imagen del elemento --}}
                    <div class="mc-image flex items-center justify-center">
                        {{-- Mostrar la imagen del elemento --}}
                        <img src="{{ $item->img }}" alt="{{ $item->titulo }}"
                            class="lazyloaded border border-solid border-gray-300 rounded-md shadow-md w-44 h-64" />
                    </div>

                    {{-- Contenedor para el título del elemento --}}
                    <div class="fringe mt-2 flex justify-center mx-auto">
                        {{-- Mostrar el título del elemento --}}
                        <div class="mtitle text-lg font-semibold">{{ $item->titulo }}</div>
                    </div>
                </a>
            @endforeach
        </div>
    @endforeach
</x-app-layout>
