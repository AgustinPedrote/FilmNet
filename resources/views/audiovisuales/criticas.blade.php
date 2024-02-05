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

    <!-- Encabezado de la página -->
    <h1 class="text-2xl font-bold mb-6 mt-20 ml-10 mx-4 border-b-2 border-blue-500 w-11/12 pb-2 text-gray-800">
        Críticas
    </h1>

    <!-- Sección de información del audiovisual -->
    <div class="mt-10 mb-10 mx-4 relative">
        <a href="{{ route('audiovisual.show', ['audiovisual' => $audiovisual->id]) }}">
            <div class="max-w-5xl mx-auto relative">
                <!-- Imagen panorámica -->
                <img src="{{ asset($audiovisual->img) }}" alt="{{ $audiovisual->titulo }}"
                    class="w-full h-48 object-cover object-center rounded-md shadow-md mb-8">

                <!-- Contenedor absoluto para el título y la nota media -->
                <div class="absolute top-0 left-0 w-full h-full flex flex-col justify-center items-center text-white">
                    <!-- Nombre del audiovisual con fondo semi-transparente -->
                    <p class="text-2xl font-bold mb-4 bg-blue-500 bg-opacity-50 p-4 rounded-md">
                        {{ $audiovisual->titulo }}
                    </p>

                    <!-- Nota media del audiovisual con fondo semi-transparente -->
                    <p class="text-xl font-semibold mb-4 bg-blue-500 bg-opacity-50 p-2 rounded-md">
                        Nota Media: {{ number_format($notaMedia, 1) }}
                    </p>
                </div>
            </div>
        </a>


        @if (!$criticas->isEmpty())
            <!-- Lógica para que la crítica del usuario logueado siempre salga en primer lugar -->
            @php
                $criticasUsuarioLogueado = [];
                $otrasCriticas = [];
            @endphp

            @foreach ($criticas->sortByDesc('created_at') as $critica)
                @php
                    $votacion = $critica->audiovisual->obtenerVotacion($critica->user_id, $critica->audiovisual_id);
                @endphp

                @if ($critica->user_id == auth()->id())
                    @php
                        $criticasUsuarioLogueado[] = $critica;
                    @endphp
                @else
                    @php
                        $otrasCriticas[] = $critica;
                    @endphp
                @endif
            @endforeach

            @php
                $todasLasCriticas = array_merge($criticasUsuarioLogueado, $otrasCriticas);
            @endphp

            @foreach ($todasLasCriticas as $critica)
                <!-- Votación del usuario al audiovisual -->
                @php
                    $votacion = $critica->audiovisual->obtenerVotacion($critica->user_id, $critica->audiovisual_id);
                @endphp

                <div class="flex justify-center mb-8">
                    <div class="bg-white p-6 max-w-4xl rounded-md shadow-lg w-full">

                        <!-- Primera fila (fila de arriba) -->
                        <div
                            class="flex items-center justify-between mb-4 bg-gray-100 border border-gray-300 p-4 rounded-md">

                            <!-- Columna 1: Detalles del usuario y fecha -->
                            <div class="w-2/3 flex flex-col ml-4">
                                <div class="flex flex-col">

                                    <!-- Autor de la crítica -->
                                    <div class="font-medium mb-2 text-lg sm:text-2xl flex items-center">

                                        <!-- Icono de usuario -->
                                        <svg xmlns="http://www.w3.org/2000/svg" height="26" width="26"
                                            viewBox="0 0 512 512" class="mr-2">
                                            <path
                                                d="M256 288A144 144 0 1 0 256 0a144 144 0 1 0 0 288zm-94.7 32C72.2 320 0 392.2 0 481.3c0 17 13.8 30.7 30.7 30.7H481.3c17 0 30.7-13.8 30.7-30.7C512 392.2 439.8 320 350.7 320H161.3z" />
                                        </svg>

                                        <!-- Nombre del usuario -->
                                        {{ $critica->user->name }}

                                        <!-- Ciudad del usuario -->
                                        <span class="ml-2 text-base italic text-gray-900 hidden sm:inline">
                                            {{ $critica->user->ciudad }} ({{ $critica->user->pais }})
                                        </span>

                                        <!-- Editar y eliminar crítica solo para el usuario logueado -->
                                        @if ($critica->user_id == auth()->id())
                                            <div class="flex justify-end items-center mt-2">

                                                <!-- Editar crítica de usuario logueado -->
                                                <span class="ml-6 cursor-pointer hover:scale-110">
                                                    <svg xmlns="http://www.w3.org/2000/svg" height="20"
                                                        width="20" viewBox="0 0 512 512"
                                                        data-modal-target="EditarModal{{ $critica }}"
                                                        data-modal-toggle="EditarModal{{ $critica }}">
                                                        <path
                                                            d="M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.7 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7zM96 64C43 64 0 107 0 160V416c0 53 43 96 96 96H352c53 0 96-43 96-96V320c0-17.7-14.3-32-32-32s-32 14.3-32 32v96c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32h96c17.7 0 32-14.3 32-32s-14.3-32-32-32H96z" />
                                                    </svg>
                                                </span>

                                                <!-- Eliminar crítica de usuario logueado -->
                                                <span class="ml-4 cursor-pointer hover:scale-110">
                                                    <svg xmlns="http://www.w3.org/2000/svg" height="20"
                                                        width="18" viewBox="0 0 448 512"
                                                        data-modal-target="popup-modal{{ $critica }}"
                                                        data-modal-toggle="popup-modal{{ $critica }}">
                                                        <path
                                                            d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z" />
                                                    </svg>
                                                </span>
                                            </div>

                                            <!-- Ventana modal para editar una crítica -->
                                            @include('criticas.edit')

                                            <!-- Ventana modal para borrar una crítica -->
                                            @include('criticas.delete')
                                        @endif
                                    </div>

                                    <!-- Número de críticas y votaciones realizadas por el usuario -->
                                    <div class="font-medium mb-2 text-base sm:text-lg flex items-center">
                                        <!-- Críticas -->
                                        <span class="mr-2">
                                            <a href="{{ route('usuario.criticas', ['usuario' => $critica->user]) }}"
                                                class="text-blue-500 hover:underline">
                                                {{ $critica->user->criticas->count() }} críticas
                                            </a>
                                        </span>

                                        <span class="text-gray-500">|</span>

                                        <!-- Votaciones -->
                                        <span class="ml-2">
                                            <a href="{{ route('usuario.votaciones', ['usuario' => $critica->user]) }}"
                                                class="text-blue-500 hover:underline">
                                                {{ $critica->user->votaciones->count() }} votaciones
                                            </a>
                                        </span>
                                    </div>

                                    <!-- Fecha de la crítica -->
                                    <div class="font-medium mb-2 text-base sm:text-lg flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="16" width="14"
                                            viewBox="0 0 448 512" class="mr-2">
                                            <path
                                                d="M152 24c0-13.3-10.7-24-24-24s-24 10.7-24 24V64H64C28.7 64 0 92.7 0 128v16 48V448c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V192 144 128c0-35.3-28.7-64-64-64H344V24c0-13.3-10.7-24-24-24s-24 10.7-24 24V64H152V24zM48 192h80v56H48V192zm0 104h80v64H48V296zm128 0h96v64H176V296zm144 0h80v64H320V296zm80-48H320V192h80v56zm0 160v40c0 8.8-7.2 16-16 16H320V408h80zm-128 0v56H176V408h96zm-144 0v56H64c-8.8 0-16-7.2-16-16V408h80zM272 248H176V192h96v56z" />
                                        </svg>
                                        {{ $critica->created_at->format('d/m/Y') }}
                                    </div>
                                </div>
                            </div>

                            <!-- Columna 2: Nota Usuario -->
                            <div class="w-1/3 flex justify-end items-center">
                                <div class="mt-2 flex space-x-4">

                                    <!-- Nota del usuario al audiovisual -->
                                    <p
                                        class="font-bold {{ $votacion && $votacion->voto ? 'font-bold text-2xl bg-white text-blue-500 bg-white-500 border border-gray-300 rounded-md p-3.5 mb-4' : 'text-base sm:text-lg text-gray-500' }}">
                                        @if ($votacion && $votacion->voto)
                                            {{ number_format($votacion->voto, 1) }}
                                        @else
                                            El usuario no ha votado.
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>

                        <hr class="my-4 mx-2">

                        <!-- Segunda fila: Crítica -->
                        <div class="bg-gray-100 border border-gray-300 p-4 rounded-md m-2">
                            <div class="text-base sm:text-lg font-bold mb-2">Crítica:</div>
                            <p class="text-base sm:text-lg" style="min-height: 6rem;">{{ $critica->critica }}</p>
                        </div>
                    </div>

                    <!-- Línea divisoria entre críticas -->
                    <hr class="my-4">
                </div>
            @endforeach
        @else
            <!-- Mensaje si no hay críticas -->
            <p class="text-gray-500 text-lg text-center mt-8 mb-72">No hay críticas disponibles.</p>
        @endif

    </div>

    <!-- Botón para volver a la página anterior -->
    <div class="mt-6">
        <a href="{{ route('audiovisual.show', $audiovisual) }}" onclick="goBack()" class="flex items-center ml-6">
            <span class="bottom-4 right-4 p-2 bg-blue-500 text-white rounded-full cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                    class="h-6 w-6">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
            </span>
        </a>
    </div>
</x-app-layout>
