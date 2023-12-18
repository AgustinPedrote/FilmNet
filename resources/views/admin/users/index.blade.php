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
            <h1
                class="text-3xl font-semibold mb-4 border border-gray-400 w-full pb-2 text-gray-700 bg-gray-100 p-3 rounded-lg text-center">
                Usuarios
            </h1>

            <div class="flex justify-center">
                <table class="text-sm text-left text-gray-500 rounded-lg overflow-hidden w-full">
                    <thead class="text-xs text-white bg-gray-700 dark:bg-gray-800">
                        <tr>
                            <th scope="col" class="py-3 px-6 text-center font-semibold text-lg">Nombre</th>
                            <th scope="colgroup" class="py-3 px-6 text-center font-semibold text-lg">Datos Personales
                            </th>
                            <th scope="col" class="py-3 px-6 text-center font-semibold text-lg">Rol</th>
                            <th scope="col" class="py-3 px-6 text-center font-semibold text-lg">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <td class="py-4 px-6 text-center text-base w-1/6">{{ $user->name }}</td>
                                <td class="py-4 px-6 text-base w-2/6">
                                    <ul class="list-none p-0 m-0">
                                        <li><strong>Año de Nacimiento:</strong> {{ $user->nacimiento }}</li>
                                        <li><strong>Género:</strong> {{ $user->sexo }}</li>
                                        <li><strong>País:</strong> {{ $user->pais }}</li>
                                        <li><strong>Ciudad:</strong> {{ $user->ciudad }}</li>
                                        <li><strong>Email:</strong> {{ $user->email }}</li>
                                    </ul>
                                </td>

                                <td class="py-4 px-6 text-center text-base w-1/6">
                                    <form id="updateRoleForm" action="{{ route('admin.users.update', $user->id) }}"
                                        method="post">
                                        @csrf
                                        @method('put')

                                        <select name="rol_id" class="w-full" onchange="submitForm(this)">
                                            <option value="1" {{ $user->rol->id == 1 ? 'selected' : '' }}>
                                                Usuario
                                            </option>
                                            <option value="2" {{ $user->rol->id == 2 ? 'selected' : '' }}>
                                                Admin
                                            </option>
                                        </select>
                                    </form>

                                    <script>
                                        function submitForm(select) {
                                            select.form.submit();
                                        }
                                    </script>
                                </td>

                                <td class="px-6 text-center space-x-2 w-2/6">
                                    <div class="flex justify-center space-x-2">
                                        <a href="{{ route('admin.verCriticas', $user) }}" class="inline-block">
                                            <button
                                                class="px-4 py-2 bg-blue-500 border border-blue-600 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:shadow-outline-red active:bg-blue-600 mx-auto font-semibold text-base">
                                                Críticas
                                            </button>
                                        </a>

                                        <form action="{{ route('admin.users.validar', $user->id) }}" method="POST"
                                            class="flex items-center">
                                            @csrf
                                            @method('PUT')

                                            <input type="hidden" name="id" value="{{ $user->id }}">

                                            @if ($user->validado)
                                                <button type="submit"
                                                    class="w-20 h-10 bg-red-500 border border-red-600 text-white rounded-md hover:bg-red-600 focus:outline-none focus:shadow-outline-red active:bg-red-600 font-semibold text-base">
                                                    Invalidar
                                                </button>
                                            @else
                                                <button type="submit"
                                                    class="w-20 h-10 bg-green-500 border border-green-600 text-white rounded-md hover:bg-green-600 focus:outline-none focus:shadow-outline-red active:bg-green-600 font-semibold text-base">
                                                    Validar
                                                </button>
                                            @endif
                                        </form>

                                        <button type="submit"
                                            class="px-4 py-2 bg-red-500 border border-red-600 text-white rounded-md hover:bg-red-600 focus:outline-none focus:shadow-outline-red active:bg-red-600 font-semibold text-base"
                                            data-modal-target="popup-modal{{ $user }}"
                                            data-modal-toggle="popup-modal{{ $user }}">
                                            Borrar
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <!-- Ventana modal para borrar una premio -->
                            @include('admin.users.delete')
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $users->links() }}
            </div>
        </div>
    </div>
</x-admin>
