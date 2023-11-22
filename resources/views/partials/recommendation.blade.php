{{-- Recomendación de edad --}}
<strong>Recomendación de edad:</strong>

@php
    $recomendacionId = $audiovisual->recomendacion_id;
    $descripcionEdad = $audiovisual->getDescripcionEdad();
@endphp

@switch($recomendacionId)
    @case(1)
        <span class="inline-block bg-green-500 text-white rounded-full px-2 w-4 h-4"></span>
        <span>{{ $descripcionEdad }}</span>
    @break

    @case(2)
        <span class="inline-block bg-orange-500 text-white rounded-full px-2 w-4 h-4"></span>
        <span>{{ $descripcionEdad }}</span>
    @break

    @case(3)
        <span class="inline-block bg-red-500 text-white rounded-full px-2 w-4 h-4"></span>
        <span>{{ $descripcionEdad }}</span>
    @break

    @default
        <span>{{ $descripcionEdad }}</span>
@endswitch
