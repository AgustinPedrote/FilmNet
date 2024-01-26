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

    <h1 class="text-2xl font-bold mb-6 mt-20 ml-10 mx-4 border-b-2 border-blue-500 w-11/12 pb-2 text-gray-800"">
        Usuarios seguidos ({{ $amigos->count() }})
    </h1>

    <!-- Buscador de usuarios para seguir -->
    <div class="w-11/12 sm:w-1/2 mx-auto mt-2 mb-6">
        <form action="{{ route('seguir.amigo') }}" method="POST">
            @csrf

            <x-input-label for="search_amigo" class="block mb-2 text-xl font-bold text-gray-900 dark:text-white mt-2" />

            <div class="flex items-center">
                <input id="search_amigo"
                    class="block w-full border-blue-500 focus:border-blue-600 focus:ring-blue-500 rounded-md shadow-sm"
                    type="text" name="search_amigo" placeholder="Buscar usuarios..." />

                <!-- Campo oculto -->
                <input type="hidden" name="amigo" id="amigoId" class="amigo">

                <button type="button" onclick="buscarAmigo()"
                    class="px-4 py-2 ml-4 cursor-pointer bg-green-500 border border-green-600 hover:bg-green-600 text-white rounded-md font-semibold focus:outline-none focus:shadow-outline-green active:bg-green-600">
                    Buscar
                </button>

                <!-- Botón "Crear" -->
                <button type="submit"
                    class="ml-2 cursor-pointer bg-blue-500 border border-blue-600 hover:bg-blue-600 text-white rounded-md px-4 py-2 font-semibold focus:outline-none focus:shadow-outline-blue active:bg-blue-600">
                    Seguir
                </button>
            </div>

            <!-- Lista de resultados de la búsqueda -->
            <ul id="amigoResults"
                class="absolute bg-white borde divide-y divide-gray-300 overflow-y-auto max-h-52 w-52 mt-1 z-10">
            </ul>
        </form>
    </div>

    @if ($amigos->isEmpty())
        <div class="text-gray-500 text-lg text-center mt-10 min-h-screen">
            <p>No sigues a ningún usuario.</p>
        </div>
    @else
        <div class="mx-auto w-11/12 min-h-screen">
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
                        <th class="py-2 px-4 border bg-gray-200 text-gray-700 font-bold uppercase">
                            Acciones
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($amigos as $amigo)
                        <tr>
                            <td class="py-2 px-4 border text-center">{{ $amigo->name }}</td>
                            <td class="py-2 px-4 border text-center hidden md:table-cell">{{ $amigo->pais }}</td>
                            <td class="py-2 px-4 border text-center hidden md:table-cell">{{ $amigo->ciudad }}</td>
                            <td class="py-2 px-4 border text-center hidden md:table-cell">
                                <a href="{{ route('usuario.votaciones', ['usuario' => $amigo]) }}"
                                    class="text-blue-500 hover:underline">
                                    {{ $amigo->votaciones->count() }}
                                </a>
                            </td>
                            <td class="py-2 px-4 border text-center hidden md:table-cell">
                                <a href="{{ route('usuario.criticas', ['usuario' => $amigo]) }}"
                                    class="text-blue-500 hover:underline">
                                    {{ $amigo->criticas->count() }}
                                </a>
                            </td>
                            <td class="py-2 px-4 border text-center">
                                <form action="{{ route('dejar.dejarSeguir', $amigo->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                        class="cursor-pointer bg-red-500 border border-red-600 hover:bg-red-600 text-white rounded-md px-4 py-2 font-semibold focus:outline-none focus:shadow-outline-red active:bg-red-600">
                                        Dejar de seguir
                                    </button>
                                </form>
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

    <!-- Script para buscador de usuarios -->
    <script src="{{ asset('js/buscadorUsuarios.js') }}"></script>

</x-app-layout>
