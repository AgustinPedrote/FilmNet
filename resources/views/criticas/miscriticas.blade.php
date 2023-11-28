<x-app-layout>
    <h1 class="text-2xl font-bold my-6 ml-10 border-b-2 border-blue-500 w-11/12 pb-2 text-gray-800">
        Mis críticas
    </h1>

    @if(session('success'))
        <div class="font-medium text-base text-green-500 bg-green-200 border-green-500 rounded p-1 my-2 text-center">
            {{ session('success') }}
        </div>
    @endif

    @forelse ($criticas as $critica)
        <div class="flex justify-center mb-4">
            <div class="bg-blue-500 p-4 max-w-4xl rounded-md shadow-md">

                <!-- Primera fila (fila de arriba) -->
                <div class="flex items-center justify-between mb-4 bg-gray-100 p-4 rounded-md">
                    <!-- Columna 1: Imagen -->
                    <div class="relative w-1/5 h-auto overflow-hidden rounded-md shadow-md">
                        <img src="{{ $critica->audiovisual->img }}" alt="{{ $critica->audiovisual->titulo }}"
                            class="object-cover w-full h-full rounded-md transition duration-300 ease-in-out transform scale-100 group-hover:scale-110" />
                    </div>

                    <!-- Columna 2: Detalles del usuario y fecha -->
                    <div class="w-full flex flex-col ml-4">
                        <!-- Título en la parte superior -->
                        <div class="text-2xl font-bold mb-2">{{ $critica->audiovisual->titulo }}</div>
                        <!-- Fecha de la crítica -->
                        <div class="flex flex-col">
                            <div class="font-medium mb-2 text-lg">Fecha de la crítica</div>
                            <div class="text-lg">{{ $critica->created_at->format('d/m/Y') }}</div>
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
                                data-modal-toggle="popup-modal{{ $critica }}">Borrar</button>
                        </div>
                    </div>
                </div>

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
