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

    <!-- Contenido de la Página -->
    <div class="flex flex-wrap items-start ml-6">
        <!-- Título del Audiovisual -->
        <div class="w-full p-4 mt-16">
            <!-- Título -->
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight border-b-2 border-blue-500 w-11/12">
                {{ $audiovisual->titulo }}
            </h2>
        </div>

        <!-- Detalles del Audiovisual -->
        <div class="w-full md:w-2/3 p-4 space-y-2 bg-white rounded-lg shadow-md">
            <!-- Descripción y Características -->
            <p class="text-gray-600">{{ $audiovisual->descripcion }}</p>

            <!-- Detalles adicionales con mayor margen -->
            <div class="text-lg text-gray-500 space-y-2 mb-4">
                <div class="mb-3"><strong>Título Original:</strong> {{ $audiovisual->titulo_original }}</div>
                <div class="mb-3"><strong>Año:</strong> {{ $audiovisual->year }}</div>
                <div class="mb-3"><strong>Duración:</strong> {{ $audiovisual->duracion }} minutos</div>
                <div class="mb-3"><strong>País:</strong> {{ $audiovisual->pais }}</div>

                <!-- Mostrar información de las personas relacionadas -->

                <!-- Directores -->
                <div class="mb-3">
                    <strong>Director:</strong>
                    @foreach ($audiovisual->directores as $director)
                        <a href="{{ route('personas.show', $director) }}" class="text-blue-500 hover:underline">
                            {{ $director->nombre }}
                        </a>
                        @if (!$loop->last)
                            ,
                        @endif
                    @endforeach
                </div>

                <!-- Compositores -->
                <div class="mb-3">
                    <strong>Compositor:</strong>
                    @foreach ($audiovisual->compositores as $compositor)
                        <a href="{{ route('personas.show', $compositor) }}" class="text-blue-500 hover:underline">
                            {{ $compositor->nombre }}
                        </a>
                        @if (!$loop->last)
                            ,
                        @endif
                    @endforeach
                </div>

                <!-- Directores de fotografía -->
                <div class="mb-3">
                    <strong>Fotografía:</strong>
                    @foreach ($audiovisual->fotografias as $fotografia)
                        <a href="{{ route('personas.show', $fotografia) }}" class="text-blue-500 hover:underline">
                            {{ $fotografia->nombre }}
                        </a>
                        @if (!$loop->last)
                            ,
                        @endif
                    @endforeach
                </div>

                <!-- Guionistas -->
                <div class="mb-3">
                    <strong>Guionista:</strong>
                    @foreach ($audiovisual->guionistas as $guionista)
                        <a href="{{ route('personas.show', $guionista) }}" class="text-blue-500 hover:underline">
                            {{ $guionista->nombre }}
                        </a>
                        @if (!$loop->last)
                            ,
                        @endif
                    @endforeach
                </div>

                <!-- Reparto -->
                <div class="mb-3">
                    <strong>Reparto:</strong>
                    @foreach ($audiovisual->repartos as $reparto)
                        <a href="{{ route('personas.show', $reparto) }}" class="text-blue-500 hover:underline">
                            {{ $reparto->nombre }}
                        </a>
                        @if (!$loop->last)
                            ,
                        @endif
                    @endforeach
                </div>

                <!-- Géneros -->
                <div class="mb-3"><strong>Géneros:</strong>
                    @foreach ($audiovisual->generos as $genero)
                        {{ $genero->nombre }}@if (!$loop->last)
                            ,
                        @endif
                    @endforeach
                </div>

                <!-- Premios -->
                @if ($audiovisual->premios->count() > 0)
                    <div class="mb-3"><strong>Premios:</strong>
                        @foreach ($audiovisual->premios as $premio)
                            {{ $premio->nombre }} ({{ $premio->year }})@if (!$loop->last)
                                ,
                            @endif
                        @endforeach
                    </div>
                @endif

                <!-- Recomendación de edad -->
                <div class="mb-3">
                    @include('partials.recommendation')
                </div>

                <!-- Sinopsis -->
                <div class="mb-3"><strong>Sinopsis:</strong> {{ $audiovisual->sinopsis }}</div>
            </div>

            <!-- Formulario de Críticas -->
            @include('partials.comments-form')

            <!-- Trailer del Audiovisual -->
            @include('partials.trailers')
        </div>

        <!-- Imagen del Audiovisual -->
        <div class="w-full md:w-1/3 p-4 flex flex-col items-center justify-center">
            <img src="{{ asset($audiovisual->img) }}" alt="{{ $audiovisual->titulo }}"
                class="w-full h-auto object-cover md:w-48 mx-auto mb-6 rounded-lg shadow-md">

            <div class="mb-6 text-center w-full md:w-48 bg-gray-100 rounded-md p-8 border border-gray-300">

                <!-- Mostrar las estrellas (1 al 10) -->
                <div id="stars-container" class="flex items-center justify-center mb-2">
                    @for ($i = 1; $i <= 10; $i++)
                        @if ($notaMedia !== null && $i <= $notaMedia)
                            <span class="text-yellow-300 text-xl">&#9733;</span>
                        @else
                            <span class="text-gray-400 text-xl">&#9733;</span>
                        @endif
                    @endfor
                </div>

                <!-- Nota media de las votaciones -->
                <div class="space-y-4">
                    <p class="font-bold text-lg bg-white text-blue-500 border border-gray-300 rounded-md p-3.5 mb-4"
                        id="nota">
                        {{ $notaMedia ? number_format($notaMedia, 1) : 'No vista' }}
                    </p>
                </div>

                <div class="space-y-4 mb-4">
                    <!-- Número de votos -->
                    <div class="bg-white rounded-md p-4 border border-gray-300">
                        <!-- Link audiovisual críticas -->
                        <a href="{{ route('ver.criticas', $audiovisual) }}"
                            class="text-blue-500 hover:underline font-bold">
                            {{ $audiovisual->criticas->count() }} Críticas
                        </a>

                        <p class="text-blue-500 font-bold" id="votos">
                            {{ $notaMedia ? $numeroVotos . ' Votos' : '0 Votos' }}
                        </p>
                    </div>
                </div>

                <!-- Barras de votación -->
                <div class="flex flex-col items-center bg-white border border-gray-300 rounded-md p-1 space-y-0">

                    <!-- Espacio en blanco para numeración vertical -->
                    <div class="w-3 mb-1 text-xs text-gray-600">

                    </div>
                    <!-- Contenedor para barras de votación -->
                    <div class="flex-grow w-full space-y-0">
                        @for ($i = 10; $i >= 1; $i--)
                            <div class="flex items-center mb-0">
                                <!-- Número y barra de votación -->
                                <div class="w-3 text-right text-xs text-gray-600 mr-1">{{ $i }}</div>
                                <div class="flex-grow">
                                     <!-- Barra de votación -->
                                    <div class="h-2 bg-gray-200 w-full rounded overflow-hidden">
                                        @php
                                            $votosParaNota = $audiovisual->votaciones->where('voto', $i)->count();
                                            $totalVotos = $audiovisual->obtenerNumeroVotos();
                                            $porcentaje = $totalVotos > 0 ? ($votosParaNota / $totalVotos) * 100 : 0;
                                            $colorClass = 'bg-blue-500';
                                            // Asignar colores específicos según el valor de $i
                                            if ($i === 10) {
                                                $colorClass = 'bg-green-500';
                                            } elseif ($i >= 8) {
                                                $colorClass = 'bg-green-400';
                                            } elseif ($i >= 6) {
                                                $colorClass = 'bg-yellow-300';
                                            } elseif ($i === 5) {
                                                $colorClass = 'bg-orange-300';
                                            } elseif ($i >= 3) {
                                                $colorClass = 'bg-red-400';
                                            } elseif ($i >= 1) {
                                                $colorClass = 'bg-red-500';
                                            }
                                        @endphp

                                        <!-- Barra de progreso -->
                                        <div class="h-full {{ $colorClass }} rounded"
                                            style="width: {{ $porcentaje }}%">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endfor
                    </div>
                </div>
            </div>

            <!-- Formulario de Votación -->
            @include('partials.voting-form')

            <!-- Botón para agregar a mi lista de seguimiento -->
            @include('partials.follow-button')
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

    <!-- Script para votación del audiovisual de forma asíncrona -->
    <script src="{{ asset('js/vote.js') }}"></script>

    <!-- Script para seguimiento del audiovisual de forma asíncrona -->
    <script src="{{ asset('js/seguimiento.js') }}"></script>
</x-app-layout>
