<x-app-layout>
    <h1 class="text-2xl font-bold mb-6 mt-20 ml-10 border-b-2 border-blue-500 w-11/12 pb-2 text-gray-800">
        Usuarios seguidores ({{ $seguidores->count() }})
    </h1>

    @if ($seguidores->isEmpty())
        <div class="text-gray-500 text-lg text-center mt-10 mb-48">
            <p>No te sigue ningún usuario.</p>
        </div>
    @else
        <div class="mx-auto w-11/12">
            <table class="min-w-full mt-10 table-auto border border-gray-300 divide-y divide-gray-300">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border bg-gray-200 text-gray-700 font-bold uppercase">
                            Nombre
                        </th>
                        <th class="py-2 px-4 border bg-gray-200 text-gray-700 font-bold uppercase hidden md:table-cell">
                            País
                        </th>
                        <th class="py-2 px-4 border bg-gray-200 text-gray-700 font-bold uppercase hidden md:table-cell">
                            Ciudad
                        </th>
                        <th class="py-2 px-4 border bg-gray-200 text-gray-700 font-bold uppercase hidden md:table-cell">
                            Votaciones
                        </th>
                        <th class="py-2 px-4 border bg-gray-200 text-gray-700 font-bold uppercase hidden md:table-cell">
                            Críticas
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($seguidores as $seguido)
                        <tr>
                            <td class="py-2 px-4 border text-center">{{ $seguido->name }}</td>
                            <td class="py-2 px-4 border text-center hidden md:table-cell">{{ $seguido->pais }}</td>
                            <td class="py-2 px-4 border text-center hidden md:table-cell">{{ $seguido->ciudad }}</td>
                            <td class="py-2 px-4 border text-center hidden md:table-cell">
                                <a href="{{ route('usuario.votaciones', ['usuario' => $seguido]) }}"
                                    class="text-blue-500 hover:underline">
                                    {{ $seguido->votaciones->count() }}
                                </a>
                            </td>
                            <td class="py-2 px-4 border text-center hidden md:table-cell">
                                <a href="{{ route('usuario.criticas', ['usuario' => $seguido]) }}"
                                    class="text-blue-500 hover:underline">
                                    {{ $seguido->criticas->count() }}
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

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
</x-app-layout>
