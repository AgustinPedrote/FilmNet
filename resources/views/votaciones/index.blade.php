<x-app-layout>
    <h1 class="text-2xl font-bold mb-6 mt-16 ml-10 border-b-2 border-blue-500 w-11/12 pb-2 text-gray-800">
        Mis votaciones
    </h1>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        @if ($votaciones->isEmpty())
            <p class="text-gray-500 text-lg text-center mt-8 h-screen">No has realizado votaciones.</p>
        @else
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <table class="min-w-full divide-y divide-gray-100 text-left">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-6 py-3 text-xl font-semibold text-gray-900">
                                Audiovisuales
                            </th>
                            <th class="px-6 py-3 text-xl font-semibold text-gray-900">
                                Características
                            </th>
                            <th class="px-6 py-3 text-xl font-semibold text-gray-900">
                                <div class="flex items-center justify-center">
                                    <span class="mr-2">Votos</span>
                                    <span class="bg-blue-500 text-white px-2 py-1 rounded-full">
                                        {{ auth()->user()->votaciones->count() }}
                                    </span>
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($votaciones->reverse() as $votacion)
                            <tr>
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-20 w-20">
                                            <a
                                                href="{{ route('audiovisual.show', ['audiovisual' => $votacion->audiovisual]) }}">
                                                <img class="h-20 w-20 rounded-full object-cover"
                                                    src="{{ $votacion->audiovisual->img }}"
                                                    alt="{{ $votacion->audiovisual->titulo }}">
                                            </a>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-lg font-medium text-gray-900">
                                                <a href="{{ route('audiovisual.show', ['audiovisual' => $votacion->audiovisual]) }}"
                                                    class="hover:underline font-bold">
                                                    {{ $votacion->audiovisual->titulo }}
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-lg">
                                    Año: {{ $votacion->audiovisual->year }}<br>
                                    Duración: {{ $votacion->audiovisual->duracion }} minutos<br>
                                    País: {{ $votacion->audiovisual->pais }}<br>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <div class="font-semibold text-xl">
                                        {{ $votacion->voto }}
                                        <!-- Mostrar las estrellas (1 al 10) -->
                                        <div class="flex items-center justify-center mt-2">
                                            @for ($i = 1; $i <= 10; $i++)
                                                @if ($i <= $votacion->voto)
                                                    <span class="text-yellow-300 text-2xl">&#9733;</span>
                                                @else
                                                    <span class="text-gray-400 text-2xl">&#9733;</span>
                                                @endif
                                            @endfor
                                        </div>
                                        <!-- Mostrar el nombre correspondiente a la puntuación -->
                                        <div class="text-lg text-gray-500 mt-2">
                                            {{ $puntuacionesNombres[$votacion->voto] }}
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
        @endif
    </div>
    </div>

    <!-- Botón para volver a la página anterior -->
    <div class="mt-6">
        <a href="#" onclick="goBack()" class="flex items-center ml-6">
            <span class="bottom-4 right-4 p-2 bg-blue-500 text-white rounded-full cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                    class="h-6 w-6">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
            </span>
        </a>
    </div>

    <script>
        function goBack() {
            window.history.back();
        }
    </script>

    <div class="mx-6 mt-6 mb-10">
        {{ $votaciones->links() }}
    </div>
</x-app-layout>
