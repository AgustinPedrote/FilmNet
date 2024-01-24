<!-- Vista parcial que se renderiza en el home -->
@foreach ($items as $item)
    <!-- Enlace a la página de detalles del audiovisual -->
    <a href="{{ route('audiovisual.show', $item) }}"
        class="group p-4 transition duration-300 ease-in-out transform hover:scale-105">

        <!-- Contenedor para la imagen del audiovisual -->
        <div class="relative w-full h-64 overflow-hidden rounded-md shadow-md">
            <!-- Imagen del audiovisual con efecto de escala al hacer hover -->
            <img src="{{ asset($item->img) }}" alt="{{ $item->titulo }}"
                class="object-cover w-full h-full transition duration-300 ease-in-out transform scale-100 group-hover:scale-110" />
        </div>

        <!-- Contenedor para el título del audiovisual -->
        <div class="mt-3 text-center">
            <!-- Título del audiovisual -->
            <div class="text-lg font-semibold text-gray-800">{{ $item->titulo }}</div>
        </div>
    </a>
@endforeach
