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

    <h1 class="text-2xl font-bold mb-8 mt-20 ml-10 border-b-2 border-blue-500 w-11/12 pb-2 text-gray-800">
        Mis críticas
    </h1>

    @forelse ($criticas->reverse() as $critica)
        <!-- Votación del usuario al audiovisual -->
        @php
            $votacion = $critica->audiovisual->obtenerVotacion($critica->user_id, $critica->audiovisual_id);
        @endphp

        <div class="flex justify-center mb-8">
            <div class="bg-white p-6 max-w-4xl rounded-md shadow-lg w-full">

                <!-- Primera fila (fila de arriba) -->
                <div class="flex items-center justify-between mb-4 bg-gray-100 p-4 rounded-md">
                    <!-- Columna 1: Imagen -->
                    <div class="relative w-1/5 h-auto overflow-hidden rounded-md shadow-md">
                        <a href="{{ route('audiovisual.show', ['audiovisual' => $critica->audiovisual]) }}">
                            <img src="{{ $critica->audiovisual->img }}" alt="{{ $critica->audiovisual->titulo }}"
                                class="object-cover w-full h-full rounded-md transition duration-300 ease-in-out transform scale-100 group-hover:scale-110" />
                        </a>
                    </div>

                    <!-- Columna 2: Detalles del usuario y fecha -->
                    <div class="w-full flex flex-col ml-4">
                        <!-- Título en la parte superior -->
                        <div class="text-2xl font-bold mb-2">{{ $critica->audiovisual->titulo }}</div>

                        <!-- Fecha de la crítica -->
                        <div class="font-medium mb-2 text-lg flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" height="16" width="14" viewBox="0 0 448 512"
                                class="mr-2">
                                <path
                                    d="M152 24c0-13.3-10.7-24-24-24s-24 10.7-24 24V64H64C28.7 64 0 92.7 0 128v16 48V448c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V192 144 128c0-35.3-28.7-64-64-64H344V24c0-13.3-10.7-24-24-24s-24 10.7-24 24V64H152V24zM48 192h80v56H48V192zm0 104h80v64H48V296zm128 0h96v64H176V296zm144 0h80v64H320V296zm80-48H320V192h80v56zm0 160v40c0 8.8-7.2 16-16 16H320V408h80zm-128 0v56H176V408h96zm-144 0v56H64c-8.8 0-16-7.2-16-16V408h80zM272 248H176V192h96v56z" />
                            </svg>
                            {{ $critica->created_at->format('d/m/Y') }}
                        </div>

                        <!-- Nota del usuario al audiovisual -->
                        <div class="mt-2 flex space-x-4">
                            <p
                                class="font-bold {{ $votacion && $votacion->voto ? 'text-xl text-white bg-blue-500 border border-blue-700 rounded-md p-3 mr-10 mb-4' : 'text-lg text-gray-500' }}">
                                @if ($votacion && $votacion->voto)
                                    {{ number_format($votacion->voto, 1) }}
                                @else
                                    El usuario no ha votado.
                                @endif
                            </p>
                        </div>
                    </div>

                    <!-- Columna 3: Acciones -->
                    <div class="w-1/4 flex justify-end items-center">
                        <div class="mt-2 flex space-x-4">
                            <button type="button"
                                class="px-4 py-2 bg-blue-500 border border-blue-600 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:shadow-outline-red active:bg-blue-600 mx-auto font-semibold"
                                data-modal-target="EditarModal{{ $critica }}"
                                data-modal-toggle="EditarModal{{ $critica }}">
                                Editar
                            </button>

                            <button type="submit"
                                class="px-4 py-2 bg-red-500 border border-red-600 text-white rounded-md hover:bg-red-600 focus:outline-none focus:shadow-outline-red active:bg-red-600 mx-auto font-semibold"
                                data-modal-target="popup-modal{{ $critica }}"
                                data-modal-toggle="popup-modal{{ $critica }}">
                                Borrar
                            </button>
                        </div>
                    </div>
                </div>

                <hr class="my-4 bg-blue-500">

                <!-- Segunda fila (fila de abajo) -->
                <div class="bg-gray-100 p-4 rounded-md">
                    <!-- Contenido de la segunda fila -->
                    <div class="text-lg font-bold mb-2">Crítica:</div>
                    <p class="text-lg" style="min-height: 6rem;">{{ $critica->critica }}</p>
                </div>

            </div>
            <hr class="my-4">
        </div>

        <!-- Ventana modal para editar una crítica -->
        @include('criticas.edit')

        <!-- Ventana modal para editar una crítica -->
        @include('criticas.delete', ['critica' => $critica])

    @empty
        <p class="text-lg text-center font-semibold">No hay críticas disponibles.</p>
    @endforelse

    <div class="mx-6 mt-4 mb-10">
        {{ $criticas->links() }}
    </div>
</x-app-layout>
