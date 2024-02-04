<x-admin>

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

    <div class="min-h-screen flex justify-center items-center">
        <div class="overflow-x-auto max-w-screen-md w-full mx-auto">
            <!-- Titulo -->
            <h1
                class="text-xl lg:text-3xl font-semibold mb-4 border border-gray-400 w-full pb-2 text-gray-700 bg-gray-100 p-3 rounded-lg text-center">
                Personas
            </h1>

            <div class="flex justify-center">
                <table class="text-sm text-left text-gray-500 rounded-lg overflow-hidden w-full">
                    <!-- Encabezados de la tabla -->
                    <thead class="text-xs text-white bg-gray-700 dark:bg-gray-800">
                        <tr>
                            <th scope="col" class="py-3 px-6 text-center font-semibold text-base sm:text-lg w-1/2">
                                Nombre
                            </th>
                            <th scope="col" class="py-3 px-6 text-center font-semibold text-base sm:text-lg w-1/2">
                                Acciones
                            </th>
                        </tr>
                    </thead>

                    <!-- Filas de la tabla -->
                    <tbody>
                        @foreach ($personas as $persona)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <!-- Nombre Personas -->
                                <td class="py-4 px-6 text-center text-base">
                                    <a href="{{ route('personas.show', $persona) }}" class="hover:text-gray-800">
                                        {{ $persona->nombre }}
                                    </a>
                                </td>

                                <!-- Acciones Personas -->
                                <td class="px-6 text-center">
                                    <div class="flex justify-center lg:justify-start space-x-2">
                                        <!-- Botón para editar -->
                                        <a href="#" class="inline-block">
                                            <button
                                                class="px-4 py-2 bg-blue-500 border border-blue-600 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:shadow-outline-red active:bg-blue-600 font-semibold text-xs sm:text-base"
                                                data-modal-target="EditarModal{{ $persona }}"
                                                data-modal-toggle="EditarModal{{ $persona }}">
                                                Editar
                                            </button>
                                        </a>

                                        <!-- Botón para borrar -->
                                        <button type="submit"
                                            class="px-4 py-2 bg-red-500 border border-red-600 text-white rounded-md hover:bg-red-600 focus:outline-none focus:shadow-outline-red active:bg-red-600 font-semibold text-xs sm:text-base"
                                            data-modal-target="popup-modal{{ $persona }}"
                                            data-modal-toggle="popup-modal{{ $persona }}">
                                            Borrar
                                        </button>
                                    </div>
                                </td>

                                <!-- Ventana modal para editar una persona -->
                                @include('admin.personas.edit')

                                <!-- Ventana modal para borrar una persona -->
                                @include('admin.personas.delete')
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="flex justify-center mt-4">
                <!-- Botón Editar -->
                <a href="#" class="inline-block">
                    <button
                        class="px-4 py-2 bg-green-500 border border-green-600 text-white rounded-md hover:bg-green-600 focus:outline-none focus:shadow-outline-red active:bg-green-600 mx-auto text-xs sm:text-base font-semibold"
                        data-modal-target="InsertarModal" data-modal-toggle="InsertarModal">
                        Insertar
                    </button>
                </a>

                <!-- Ventana modal para insertar una persona -->
                @include('admin.personas.create')
            </div>

            <!-- Paginación -->
            <div class="mt-4">
                {{ $personas->links() }}
            </div>
        </div>
    </div>

</x-admin>
