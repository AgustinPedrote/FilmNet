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
                Premios
            </h1>

            <div class="flex justify-center">
                <table class="text-sm text-left text-gray-500 rounded-lg overflow-hidden w-full">
                    <thead class="text-xs text-white bg-gray-700 dark:bg-gray-800">
                        <tr>
                            <th scope="col" class="py-3 px-6 text-center font-semibold text-lg">Nombre</th>
                            <th scope="col" class="py-3 px-6 text-center font-semibold text-lg">Año</th>
                            <th scope="col" class="py-3 px-6 text-center font-semibold text-lg">Audiovisual</th>
                            <th scope="col" class="py-3 px-6 text-center font-semibold text-lg">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($premios as $premio)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <td class="py-4 px-6 text-center text-base w-1/4">{{ $premio->nombre }}</td>
                                <td class="py-4 px-6 text-center text-base w-1/4">{{ $premio->year }}</td>
                                <td class="py-4 px-6 text-center text-base w-1/4">{{ $premio->audiovisual->titulo }}</td>
                                <td class="px-6 text-center space-x-2 w-1/4">
                                    <a href="#" class="inline-block">
                                        <button
                                            class="px-4 py-2 bg-blue-500 border border-blue-600 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:shadow-outline-red active:bg-blue-600 mx-auto font-semibold text-base"
                                            data-modal-target="EditarModal{{ $premio }}"
                                            data-modal-toggle="EditarModal{{ $premio }}">
                                            Editar
                                        </button>
                                    </a>

                                    <button type="submit"
                                        class="px-4 py-2 bg-red-500 border border-red-600 text-white rounded-md hover:bg-red-600 focus:outline-none focus:shadow-outline-red active:bg-red-600 mx-auto font-semibold text-base"
                                        data-modal-target="popup-modal{{ $premio }}"
                                        data-modal-toggle="popup-modal{{ $premio }}">
                                        Borrar
                                    </button>
                                    </form>
                                </td>
                            </tr>

                            <!-- Ventana modal para editar una premio -->
                            @include('admin.premios.edit')

                            <!-- Ventana modal para borrar una premio -->
                            @include('admin.premios.delete')
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="flex justify-center mt-4">
                <a href="#" class="inline-block">
                    <button
                        class="px-4 py-2 bg-green-500 border border-green-600 text-white rounded-md hover:bg-green-600 focus:outline-none focus:shadow-outline-red active:bg-green-600 mx-auto text-base font-semibold"
                        data-modal-target="InsertarModal" data-modal-toggle="InsertarModal">
                        Insertar
                    </button>
                </a>

                <!-- Ventana modal para insertar una premio -->
                @include('admin.premios.create')
            </div>

            <div class="mt-4">
                {{ $premios->links() }}
            </div>
        </div>
    </div>
    </main>
</x-admin>
