<x-app-layout>
    <h1 class="text-2xl font-bold my-6 ml-10 border-b-2 border-blue-500 w-11/12 pb-2 text-gray-800">
        Mis críticas
    </h1>

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

        <!-- Ventana modal para editar un critica -->
        @include('criticas.edit')

    @empty
        <p class="text-lg text-center font-semibold">No hay críticas disponibles.</p>
    @endforelse

    @foreach ($criticas as $critica)
        {{-- Ventana modal para borrar al critica --}}
        <div id="popup-modal{{ $critica }}" tabindex="-1"
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 md:inset-0 h-modal md:h-full">
            <div class="relative p-4 w-full max-w-md h-full md:h-auto">
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700 ">

                    <button type="button"
                        class="absolute top-3 right-2.5 text-black bg-transparent  hover:text-gray-500 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white"
                        data-modal-toggle="popup-modal{{ $critica }}">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="sr-only">Cerrar ventana</span>
                    </button>

                    <div class="p-6 text-center">
                        <svg aria-hidden="true" class="mx-auto mb-4 w-14 h-14 text-gray-400 dark:text-gray-200"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>

                        <h3 class="mb-5 text-lg font-normal text-black  dark:text-gray-900">
                            ¿Seguro que deseas borrar estacrítica?
                        </h3>

                        <form
                            action="{{ route('criticas.destroy', ['usuario_id' => $critica->user_id, 'audiovisual_id' => $critica->audiovisual_id]) }}"
                            method="POST" class="inline">
                            @method('DELETE')
                            @csrf

                            <button data-modal-toggle="popup-modal{{ $critica }}" type="submit"
                                class="px-4 py-2 bg-red-500 border border-red-600 text-white rounded-md hover:bg-red-600 focus:outline-none focus:shadow-outline-red active:bg-red-600 mx-auto font-semibold">
                                Sí, seguro
                            </button>

                            <button data-modal-toggle="popup-modal{{ $critica }}" type="button"
                                class="px-4 py-2 bg-white border border-gray-600 text-gray-900 rounded-md hover:bg-gray-400 focus:outline-none focus:shadow-outline-red active:bg-gray-400 mx-auto font-semibold">No,
                                cancelar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</x-app-layout>
