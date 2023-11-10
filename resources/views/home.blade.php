<x-app-layout>
    <h1 class="text-2xl font-bold my-6 ml-10 border-b">Películas nuevas</h1>

    <div class="movie-card-13 grid grid-cols-3 gap-4 justify-center mx-auto">
        @foreach ($peliculas as $pelicula)
            <a href="{{ route('audiovisual.show', $pelicula) }}" class="flex-1 p-4">
                <div class="mc-image flex items-center justify-center">
                    <img
                        src="{{ $pelicula->img }}"
                        alt="{{ $pelicula->titulo }}"
                        class="lazyloaded border border-solid border-gray-300 rounded-md shadow-md w-52 h-auto"/>
                </div>
                <div class="fringe mt-2 flex justify-center mx-auto">
                    <div class="mtitle text-xl font-semibold">{{ $pelicula->titulo }}</div>
                </div>
            </a>
        @endforeach
    </div>
</x-app-layout>












