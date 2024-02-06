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
                Usuarios
            </h1>

            <!-- Tabla Usuarios -->
            <div class="overflow-x-auto">
                <table class="text-sm lg:text-xs text-left text-gray-500 rounded-lg overflow-hidden w-full">
                    <!-- Encabezados de la tabla -->
                    <thead class="text-xs text-white bg-gray-700 dark:bg-gray-800">
                        <tr>
                            <th scope="col"
                                class="py-2 lg:py-3 px-4 lg:px-6 text-center font-semibold text-base sm:text-lg w-1/6">
                                Nombre
                            </th>
                            <th scope="colgroup"
                                class="py-2 lg:py-3 px-4 lg:px-6 text-center font-semibold text-base sm:text-lg w-2/6 hidden lg:table-cell">
                                Datos Personales
                            </th>
                            <th scope="col"
                                class="py-2 lg:py-3 px-4 lg:px-6 text-center font-semibold text-base sm:text-lg w-1/6">
                                Rol
                            </th>
                            <th scope="col"
                                class="py-2 lg:py-3 px-4 lg:px-6 text-center font-semibold text-base sm:text-lg w-2/6">
                                Acciones
                            </th>
                        </tr>
                    </thead>

                    <!-- Mostrar usuarios en la tabla -->
                    <tbody>
                        @foreach ($users as $user)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <!-- Nombre -->
                                <td class="py-2 lg:py-4 px-4 lg:px-6 text-center text-base">
                                    <a href="{{ route('usuario.votaciones', ['usuario' => $user]) }}"
                                        class="hover:text-gray-800">
                                        {{ $user->name }}
                                    </a>
                                </td>

                                <!-- Datos Personales -->
                                <td class="py-2 lg:py-4 px-4 lg:px-6 text-base hidden lg:table-cell">
                                    <ul class="list-none p-0 m-0">
                                        <li><strong>Año de Nacimiento:</strong> {{ $user->nacimiento }}</li>
                                        <li><strong>Género:</strong> {{ $user->sexo }}</li>
                                        <li><strong>País:</strong> {{ $user->pais }}</li>
                                        <li><strong>Ciudad:</strong> {{ $user->ciudad }}</li>
                                        <li><strong>Email:</strong> {{ $user->email }}</li>
                                    </ul>
                                </td>

                                <!-- Rol -->
                                <td class="py-2 lg:py-4 px-4 lg:px-6 text-center text-base">
                                    <form id="updateRoleForm" action="{{ route('admin.users.update', $user->id) }}"
                                        method="post">
                                        @csrf
                                        @method('put')

                                        <select name="rol_id"
                                            class="w-full border-blue-500 focus:border-blue-600 focus:ring-blue-500 rounded-md shadow-sm"
                                            onchange="submitForm(this)">
                                            @foreach ($roles as $rol)
                                                <option value="{{ $rol->id }}"
                                                    {{ $rol->id == $user->rol->id ? 'selected' : '' }}>
                                                    {{ $rol->nombre }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </form>
                                </td>

                                <!-- Acciones -->
                                <td class="px-4 lg:px-6 py-2 lg:py-4 text-center space-x-2">
                                    <div class="flex justify-center space-x-2">
                                        <!-- Formulario para validar e invalidar al usuario -->
                                        <form action="{{ route('admin.users.validar', $user->id) }}" method="POST"
                                            class="flex items-center">
                                            @csrf
                                            @method('PUT')

                                            <!-- Input oculto con el ID del usuario -->
                                            <input type="hidden" name="id" value="{{ $user->id }}">

                                            <!-- Botón para validar o invalidar -->
                                            @if ($user->validado)
                                                <button type="submit"
                                                    class="w-20 h-8 lg:h-10 bg-orange-500 border border-orange-600 text-white rounded-md hover:bg-orange-600 focus:outline-none focus:shadow-outline-orange active:bg-orange-600 font-semibold text-xs lg:text-base">
                                                    Invalidar
                                                </button>
                                            @else
                                                <button type="submit"
                                                    class="w-20 h-8 lg:h-10 bg-green-500 border border-green-600 text-white rounded-md hover:bg-green-600 focus:outline-none focus:shadow-outline-red active:bg-green-600 font-semibold text-xs lg:text-base">
                                                    Validar
                                                </button>
                                            @endif
                                        </form>

                                        <!-- Enlace para ver críticas del usuario -->
                                        <a href="{{ route('admin.verCriticas', $user) }}" class="inline-block">
                                            <button
                                                class="px-3 lg:px-4 py-2 lg:py-2 bg-blue-500 border border-blue-600 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:shadow-outline-red active:bg-blue-600 mx-auto font-semibold text-xs lg:text-base">
                                                Críticas
                                            </button>
                                        </a>

                                        <!-- Botón para eliminar usuario -->
                                        <button type="submit"
                                            class="px-3 lg:px-4 py-2 lg:py-2 bg-red-500 border border-red-600 text-white rounded-md hover:bg-red-600 focus:outline-none focus:shadow-outline-red active:bg-red-600 font-semibold text-xs lg:text-base"
                                            data-modal-target="popup-modal{{ $user }}"
                                            data-modal-toggle="popup-modal{{ $user }}">
                                            Borrar
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <!-- Ventana modal para borrar un usuario -->
                            @include('admin.users.delete')
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Paginación de usuarios -->
            <div class="mt-4">
                {{ $users->links() }}
            </div>
        </div>
    </div>

    <!-- Script para funciones -->
    <script src="{{ asset('js/funciones.js') }}"></script>

</x-admin>
