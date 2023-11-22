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
                    <p class="text-lg text-red-500 space-y-1 font-bold">No hay trailer disponible para este
                        audiovisual.</p>
                @endif
            </div>
        @else
            <p class="text-lg text-red-500 space-y-1 font-bold">No tienes la edad permitida para ver este
                trailer.</p>
        @endif
    </div>
@else
    <div class="p-6">
        <a href="{{ route('login') }}" class="text-blue-500 hover:underline font-bold text-lg">
            Ver trailer
        </a>
    </div>
@endauth
