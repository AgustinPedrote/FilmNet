<x-app-layout>
    <!-- Contenido de la Página -->
    <div class="flex flex-wrap items-start">
        <!-- Título del Audiovisual -->
        <div class="w-full p-4">
            <!-- Título -->
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight border-b-2 border-blue-500 w-11/12">
                {{ $audiovisual->titulo }}
            </h2>
        </div>

        <!-- Detalles del Audiovisual -->
        <div class="w-full md:w-2/3 p-4 space-y-2 mt-2 bg-white rounded-lg shadow-md">
            <!-- Descripción y Características -->
            <div class="mb-2">
                <p class="text-gray-600">{{ $audiovisual->descripcion }}</p>
            </div>

            <!-- Detalles adicionales con mayor margen -->
            <div class="text-lg text-gray-500 space-y-2 mb-4">
                <div class="mb-2"><strong>Título Original:</strong> {{ $audiovisual->titulo_original }}</div>
                <div class="mb-2"><strong>Año:</strong> {{ $audiovisual->year }}</div>
                <div class="mb-2"><strong>Duración:</strong> {{ $audiovisual->duracion }} minutos</div>
                <div class="mb-2"><strong>País:</strong> {{ $audiovisual->pais }}</div>

                <!-- Mostrar información de las personas relacionadas -->
                <div class="mb-2"><strong>Director:</strong>
                    @foreach ($audiovisual->directores as $director)
                        {{ $director->nombre }}@if (!$loop->last)
                            ,
                        @endif
                    @endforeach
                </div>

                <div class="mb-2"><strong>Compositor:</strong>
                    @foreach ($audiovisual->compositores as $compositor)
                        {{ $compositor->nombre }}@if (!$loop->last)
                            ,
                        @endif
                    @endforeach
                </div>

                <div class="mb-2"><strong>Fotografía:</strong>
                    @foreach ($audiovisual->fotografias as $fotografia)
                        {{ $fotografia->nombre }}@if (!$loop->last)
                            ,
                        @endif
                    @endforeach
                </div>

                <div class="mb-2"><strong>Guionista:</strong>
                    @foreach ($audiovisual->guionistas as $guionista)
                        {{ $guionista->nombre }}@if (!$loop->last)
                            ,
                        @endif
                    @endforeach
                </div>

                <!-- Reparto -->
                <div class="mb-2"><strong>Reparto:</strong>
                    @foreach ($audiovisual->repartos as $reparto)
                        {{ $reparto->nombre }}@if (!$loop->last)
                            ,
                        @endif
                    @endforeach
                </div>

                <!-- Géneros -->
                <div class="mb-2"><strong>Géneros:</strong>
                    @foreach ($audiovisual->generos as $genero)
                        {{ $genero->nombre }}@if (!$loop->last)
                            ,
                        @endif
                    @endforeach
                </div>

                <!-- Recomendación de edad -->
                <div class="mb-2">
                    @include('partials.recommendation')
                </div>

                <!-- Sinopsis -->
                <div class="mb-2"><strong>Sinopsis:</strong> {{ $audiovisual->sinopsis }}</div>
            </div>

            <!-- Formulario de Críticas -->
            @include('partials.comments-form')

            <!-- Trailer del Audiovisual -->
            @include('partials.trailers')
        </div>

        <!-- Imagen del Audiovisual -->
        <div class="w-full md:w-1/3 p-4 flex flex-col items-center justify-center">
            <img src="{{ $audiovisual->img }}" alt="{{ $audiovisual->titulo }}"
                class="w-full h-auto object-cover md:w-48 mx-auto my-auto rounded-lg shadow-md">

            <div class="mt-4 text-center w-full md:w-48 bg-gray-100 rounded-md p-10 border-gray-300">
                <!-- Nota media de las votaciones -->
                <div class="space-y-4">
                    <p
                        class="font-bold {{ $notaMedia ? 'text-3xl text-white bg-blue-500 border border-blue-700 rounded-md p-3' : 'text-gray-500' }} mb-4">
                        {{ $notaMedia ? number_format($notaMedia, 1) : 'Sin votaciones' }}
                    </p>
                </div>

                <div class="space-y-4">
                    <!-- Número de votos -->
                    <div class="bg-white rounded-md p-4 border border-gray-300">
                        <p class="text-blue-500 font-bold">{{ $notaMedia ? $numeroVotos . ' Votos' : '0 Votos' }}</p>
                    </div>

                    <!-- Link audiovisual críticas -->
                    <div class="bg-white rounded-md p-4 border border-gray-300">
                        <a href="{{ route('ver.criticas', $audiovisual) }}"
                            class="text-blue-500 hover:underline font-bold">
                            {{ $audiovisual->criticas->count() }} Críticas
                        </a>
                    </div>
                </div>
            </div>

            <!-- Formulario de Votación -->
            @include('partials.voting-form')

            <!-- Botón para agregar a la lista de seguimiento -->
            @include('partials.follow-button')
        </div>
    </div>
</x-app-layout>
