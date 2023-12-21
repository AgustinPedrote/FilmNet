<!-- Ventana modal para editar un premio -->
<div id="InsertarModal{{ $tipos }}{{ $recomendaciones }}" tabindex="-1" aria-hidden="true"
    class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-7xl mx-auto">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-start justify-between p-1 border-b rounded-t dark:border-gray-600 bg-blue-500">
                <button type="button"
                    class="text-white bg-transparent  hover:text-gray-100 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:text-white"
                    data-modal-hide="InsertarModal{{ $tipos }}{{ $recomendaciones }}">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Cerrar modal</span>
                </button>
            </div>

            <!-- Modal body -->
            <form id="formularioEdit" action="{{ route('audiovisuales.store') }}" method="POST"
                class="max-w-7xl w-full" enctype="multipart/form-data">
                @csrf

                <div class="p-8 space-y-5">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                        <!-- Columna 1 -->
                        <div>
                            <!-- Titulo -->
                            <x-input-label for="titulo" :value="__('Titulo')"
                                class="block mb-2 mt-2 text-base font-bold text-gray-900 dark:text-white" />
                            <x-text-input id="titulo" class="block mt-1 w-full text-md" type="text" name="titulo"
                                required autofocus autocomplete="titulo" />
                            <x-input-error :messages="$errors->get('titulo')" class="mt-2" />

                            <!-- Titulo original -->
                            <x-input-label for="titulo_original" :value="__('Titulo orignal')"
                                class="block mb-2 text-base font-bold text-gray-900 dark:text-white mt-2" />
                            <x-text-input id="titulo_original" class="block mt-1 w-full text-md" type="text"
                                name="titulo_original" required autofocus autocomplete="titulo_original" />
                            <x-input-error :messages="$errors->get('titulo_original')" class="mt-2" />

                            <!-- Año -->
                            <x-input-label for="year" :value="__('Año')"
                                class="block mb-2 text-base font-bold text-gray-900 dark:text-white mt-2" />
                            <x-text-input id="year" class="block mt-1 w-full text-md" type="text" name="year"
                                required autofocus autocomplete="year" />
                            <x-input-error :messages="$errors->get('year')" class="mt-2" />

                            <!-- Duración -->
                            <x-input-label for="duracion" :value="__('Duración')"
                                class="block mb-2 text-base font-bold text-gray-900 dark:text-white mt-2" />
                            <x-text-input id="duracion" class="block mt-1 w-full text-md" type="text"
                                name="duracion" required autofocus autocomplete="duracion" />
                            <x-input-error :messages="$errors->get('duracion')" class="mt-2" />

                            <!-- País -->
                            <x-input-label for="pais" :value="__('País')"
                                class="block mb-2 text-base font-bold text-gray-900 dark:text-white mt-2" />
                            <x-text-input id="pais" class="block mt-1 w-full text-md" type="text" name="pais"
                                required autofocus autocomplete="pais" />
                            <x-input-error :messages="$errors->get('pais')" class="mt-2" />

                            <!-- Trailer -->
                            <x-input-label for="trailer" :value="__('Trailer')"
                                class="block mb-2 text-base font-bold text-gray-900 dark:text-white mt-2" />
                            <x-text-input id="trailer" class="block mt-1 w-full text-md" type="text" name="trailer"
                                required autofocus autocomplete="trailer" />
                            <x-input-error :messages="$errors->get('trailer')" class="mt-2" />
                        </div>

                        <!-- Columna 2 -->
                        <div>
                            <!-- Tipos -->
                            <x-input-label for="tipo_id" :value="__('Tipo')"
                                class="block mb-2 text-base font-bold text-gray-900 dark:text-white mt-2" />
                            <select name="tipo_id"
                                class="w-full border-blue-500 focus:border-blue-600 focus:ring-blue-500 rounded-md shadow-sm">
                                <option value="0" disabled selected>Selecciona un tipo</option>
                                @foreach ($tipos as $tipo)
                                    <option value="{{ $tipo->id }}">
                                        {{ $tipo->nombre }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('tipo_id')" class="mt-2" />

                            <!-- Recomendación de edad -->
                            <x-input-label for="recomendacion_id" :value="__('Recomendación edad')"
                                class="block mb-2 text-base font-bold text-gray-900 dark:text-white mt-2" />
                            <select name="recomendacion_id"
                                class="w-full border-blue-500 focus:border-blue-600 focus:ring-blue-500 rounded-md shadow-sm">
                                <option value="0" disabled selected>Selecciona una recomendación</option>
                                @foreach ($recomendaciones as $recomendacion)
                                    <option value="{{ $recomendacion->id }}">
                                        + {{ $recomendacion->edad }} años
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('recomendacion_id')" class="mt-2" />

                            <!-- Imagen -->
                            <x-input-label for="imagen" :value="__('Imagen')"
                                class="block mb-2 text-base font-bold text-gray-900 dark:text-white mt-2" />
                            <input type="file" id="imagen" name="imagen" accept="image/*">
                            <br>
                            <x-input-error :messages="$errors->get('imagen')" class="mt-2" />

                            <!-- Sinopsis  -->
                            <x-input-label for="sinopsis" :value="__('Sinopsis')"
                                class="block text-base font-bold text-gray-900 dark:text-white mb-2 mt-2" />
                            <textarea id="sinopsis"
                                class="block w-full h-48 border-blue-500 focus:border-blue-600 focus:ring-blue-500 rounded-md shadow-sm"
                                name="sinopsis" required autofocus autocomplete="sinopsis"></textarea>
                            <x-input-error :messages="$errors->get('sinopsis')" class="mt-2" />
                        </div>
                    </div>
                </div>


                <!-- Modal footer -->
                <div
                    class="flex items-center justify-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                    <!-- Botón "Guardar" -->
                    <button type="submit"
                        class="cursor-pointer bg-blue-500 border border-blue-600 hover:bg-blue-600 text-white rounded-md px-4 py-2 font-semibold focus:outline-none focus:shadow-outline-blue active:bg-blue-600">
                        Guardar
                    </button>

                    <!-- Espacio entre botones -->
                    <div class="w-4"></div>

                    <!-- Botón "Cancelar" -->
                    <button data-modal-hide="InsertarModal{{ $tipos }}{{ $recomendaciones }}" type="button"
                        class="cursor-pointer bg-blue-500 border border-blue-600 hover:bg-blue-600 text-white rounded-md px-4 py-2 font-semibold focus:outline-none focus:shadow-outline-blue active:bg-blue-600">
                        Cancelar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
