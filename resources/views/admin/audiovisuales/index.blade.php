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
        <div class="overflow-x-auto max-w-screen-lg w-full mx-auto">
            <!-- Titulo -->
            <h1
                class="text-xl lg:text-3xl font-semibold mb-4 border border-gray-400 w-full pb-2 text-gray-700 bg-gray-100 p-3 rounded-lg text-center">
                Audiovisuales
            </h1>

            <div class="flex justify-center">
                <table class="text-sm text-left text-gray-500 rounded-lg overflow-hidden w-full">
                    <!-- Encabezados de la tabla -->
                    <thead class="text-xs text-white bg-gray-700 dark:bg-gray-800">
                        <tr>
                            <th scope="col"
                                class="py-3 px-6 text-center font-semibold w-1/5 hidden lg:table-cell text-base sm:text-lg">
                                Imagen
                            </th>
                            <th scope="col" class="py-3 px-6 text-center font-semibold w-1/5 text-base sm:text-lg">
                                Titulo
                            </th>
                            <th scope="col" class="py-3 px-6 text-center font-semibold w-1/5 text-base sm:text-lg">
                                Elenco
                            </th>
                            <th scope="col" class="py-3 px-6 text-center font-semibold w-2/5 text-base sm:text-lg">
                                Acciones
                            </th>
                        </tr>
                    </thead>

                    <!-- Filas de la tabla -->
                    <tbody>
                        @foreach ($audiovisuales as $audiovisual)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <!-- Imagen -->
                                <td class="py-4 px-6 text-center hidden lg:table-cell">
                                    <div class="flex-shrink-0 h-16 w-16 mx-auto">
                                        <a href="{{ route('audiovisual.show', ['audiovisual' => $audiovisual]) }}">
                                            <img class="h-full w-full rounded-full object-cover border-2 border-gray-300 hover:border-blue-500 transition duration-300"
                                                src="{{ asset($audiovisual->img) }}" alt="Imagen">
                                        </a>
                                    </div>
                                </td>

                                <!-- Título -->
                                <td class="py-4 px-6 text-center text-base">{{ $audiovisual->titulo }}</td>

                                <!-- Acciones Elenco-->
                                <td class="py-4 px-6 text-center text-base">
                                    <ul class="list-none p-0 m-0">
                                        <!-- Enlace para añadir al elenco -->
                                        <li>
                                            <a href="#"
                                                class="inline-block text-blue-500 hover:text-blue-600 focus:outline-none focus:shadow-outline-red active:text-blue-600 mx-auto font-semibold text-base"
                                                data-modal-target="ElencoModal{{ $audiovisual }}"
                                                data-modal-toggle="ElencoModal{{ $audiovisual }}">
                                                Añadir
                                            </a>
                                        </li>

                                        <!-- Enlace para eliminar del elenco -->
                                        <li>
                                            <a href="#"
                                                class="inline-block text-red-500 hover:text-red-600 focus:outline-none focus:shadow-outline-red active:text-red-600 mx-auto font-semibold text-base"
                                                data-modal-target="ElencoEliminar{{ $audiovisual->id }}"
                                                data-modal-toggle="ElencoEliminar{{ $audiovisual->id }}">
                                                Eliminar
                                            </a>
                                        </li>
                                    </ul>
                                </td>

                                <!-- Acciones Audiovisual -->
                                <td class="px-6 text-center">
                                    <div class="flex justify-center lg:justify-start space-x-2">
                                        <!-- Botón para editar -->
                                        <a href="#" class="inline-block">
                                            <button
                                                class="px-4 py-2 bg-blue-500 border border-blue-600 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:shadow-outline-red active:bg-blue-600 font-semibold text-xs sm:text-base"
                                                data-modal-target="EditarModal{{ $audiovisual }}"
                                                data-modal-toggle="EditarModal{{ $audiovisual }}">
                                                Editar
                                            </button>
                                        </a>

                                        <!-- Botón para borrar -->
                                        <button type="submit"
                                            class="px-4 py-2 bg-red-500 border border-red-600 text-white rounded-md hover:bg-red-600 focus:outline-none focus:shadow-outline-red active:bg-red-600 font-semibold text-xs sm:text-base"
                                            data-modal-target="popup-modal{{ $audiovisual }}"
                                            data-modal-toggle="popup-modal{{ $audiovisual }}">
                                            Borrar
                                        </button>
                                    </div>
                                </td>

                                <!-- Ventana modal para añadir elenco de un audiovisual -->
                                @include('admin.audiovisuales.elenco')

                                <!-- Ventana modal para eliminar elenco de un audiovisual -->
                                @include('admin.audiovisuales.elencoEliminar', [
                                    'audiovisualId' => $audiovisual->id,
                                ])

                                <!-- Ventana modal para editar un audiovisual -->
                                @include('admin.audiovisuales.edit')

                                <!-- Ventana modal para borrar un audiovisual -->
                                @include('admin.audiovisuales.delete')
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Botón para insertar nuevo audiovisual -->
            <div class="flex justify-center mt-4">
                <a href="#" class="inline-block">
                    <button
                    class="px-4 py-2 bg-green-500 border border-green-600 text-white rounded-md hover:bg-green-600 focus:outline-none focus:shadow-outline-red active:bg-green-600 mx-auto text-xs sm:text-base font-semibold"
                        data-modal-target="InsertarModal" data-modal-toggle="InsertarModal">
                        Insertar
                    </button>
                </a>
            </div>

            <!-- Paginación de la tabla de audiovisuales -->
            <div class="mt-4">
                {{ $audiovisuales }}
            </div>
        </div>

        <!-- Ventana modal para crear un audiovisual -->
        @include('admin.audiovisuales.create')
    </div>

</x-admin>
