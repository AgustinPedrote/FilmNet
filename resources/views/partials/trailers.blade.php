@auth
    <div class="p-6">
        @php
            $recomendacionId = $audiovisual->recomendacion_id;
            $descripcionEdad = $audiovisual->getDescripcionEdad();
            $edadUsuario = auth()->user()->edad;

            // Establecer la edad máxima permitida según la recomendación
            switch ($recomendacionId) {
                case 1:
                    // Todos los públicos (no hay restricción de edad)
                    $puedeVerTrailer = true;
                    break;
                case 2:
                    // Mayores de 13 años
                    $puedeVerTrailer = $edadUsuario >= 13;
                    break;
                case 3:
                    // Mayores de 18 años
                    $puedeVerTrailer = $edadUsuario >= 18;
                    break;
                default:
                    // Sin clasificación (tratar como "Todos los públicos")
                    $puedeVerTrailer = true;
            }
        @endphp

        @if ($puedeVerTrailer)
            <div class="mt-6">
                @if ($audiovisual->trailer)
                    <div class="bg-gray-900 rounded-md p-1 border-gray-300">
                        <iframe class="w-full" height="500" src="{{ $audiovisual->trailer }}" title="YouTube video player"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            allowfullscreen>
                        </iframe>
                    </div>
                @else
                    <p class="text-lg text-red-500 space-y-1 font-bold">
                        No hay trailer disponible para este audiovisual.
                    </p>
                @endif
            </div>
        @else
            <p class="text-lg text-red-500 space-y-1 font-bold">
                No tienes la edad permitida para ver este trailer.
            </p>
        @endif
    </div>
@else
    <div class="mt-6 p-6 flex items-center space-x-2">
        <a href="{{ route('login') }}" class="text-blue-500 hover:underline font-bold text-lg flex items-center">
            <span>Ver trailer</span>
            <svg xmlns="http://www.w3.org/2000/svg" height="18" width="20" viewBox="0 0 576 512"
                class="ml-2 text-blue-500 fill-current transform hover:animate-bounce">
                <path
                    d="M0 128C0 92.7 28.7 64 64 64H320c35.3 0 64 28.7 64 64V384c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V128zM559.1 99.8c10.4 5.6 16.9 16.4 16.9 28.2V384c0 11.8-6.5 22.6-16.9 28.2s-23 5-32.9-1.6l-96-64L416 337.1V320 192 174.9l14.2-9.5 96-64c9.8-6.5 22.4-7.2 32.9-1.6z" />
            </svg>
        </a>
    </div>
@endauth
