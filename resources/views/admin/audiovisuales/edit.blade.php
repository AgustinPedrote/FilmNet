<!-- Ventana modal para editar un audiovisual -->
<div id="EditarModal{{ $audiovisual }}" tabindex="-1" aria-hidden="true"
    class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-7xl mx-auto">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-start justify-between p-1 border-b rounded-t dark:border-gray-600 bg-gray-700">
                <button type="button"
                    class="text-white bg-transparent hover:text-gray-100 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:text-white"
                    data-modal-hide="EditarModal{{ $audiovisual }}">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>

            <!-- Modal body -->
            <form id="formularioEdit" action="{{ route('audiovisuales.update', $audiovisual) }}" method="POST"
                class="max-w-7xl w-full" enctype="multipart/form-data">
                @method('put')
                @csrf

                <div class="p-2 space-y-2">
                    <div class="grid grid-cols-1 md:grid-cols-2 md:gap-8">

                        <!-- Columna 1 -->
                        <div>
                            <!-- Titulo -->
                            <div class="mb-1 md:mb-4 p-1 md:p-2 border border-gray-300 rounded shadow-md">
                                <x-input-label for="titulo" :value="__('Titulo')"
                                    class="block md:mb-2 md:mt-2 text-sm md:text-base font-bold text-gray-900 dark:text-white" />
                                <x-text-input id="titulo" class="block md:mt-1 w-full text-sm md:text-md"
                                    type="text" name="titulo" required autofocus autocomplete="titulo"
                                    value="{{ $audiovisual->titulo }}" />
                                <x-input-error :messages="$errors->get('titulo')" class="mt-1 md:mt-3" />
                            </div>

                            <!-- Titulo original -->
                            <div class="mb-1 md:mb-4 p-1 md:p-2 border border-gray-300 rounded shadow-md">
                                <x-input-label for="titulo_original" :value="__('Titulo orignal')"
                                    class="block md:mb-2 md:mt-2 text-sm md:text-base font-bold text-gray-900 dark:text-white" />
                                <x-text-input id="titulo_original" class="block md:mt-1 w-full text-sm md:text-md"
                                    type="text" name="titulo_original" required autofocus
                                    autocomplete="titulo_original" value="{{ $audiovisual->titulo_original }}" />
                                <x-input-error :messages="$errors->get('titulo_original')" class="mt-1 md:mt-3" />
                            </div>

                            <!-- Año -->
                            <div class="mb-1 md:mb-4 p-1 md:p-2 border border-gray-300 rounded shadow-md">
                                <x-input-label for="year" :value="__('Año')"
                                    class="block md:mb-2 md:mt-2 text-sm md:text-base font-bold text-gray-900 dark:text-white" />
                                <x-text-input id="year" class="block md:mt-1 w-full text-sm md:text-md"
                                    type="text" name="year" required autofocus autocomplete="year"
                                    value="{{ $audiovisual->year }}" />
                                <x-input-error :messages="$errors->get('year')" class="mt-1 md:mt-3" />
                            </div>

                            <!-- Duración -->
                            <div class="mb-1 md:mb-4 p-1 md:p-2 border border-gray-300 rounded shadow-md">
                                <x-input-label for="duracion" :value="__('Duración')"
                                    class="block md:mb-2 md:mt-2 text-sm md:text-base font-bold text-gray-900 dark:text-white" />
                                <x-text-input id="duracion" class="block md:mt-1 w-full text-sm md:text-md"
                                    type="text" name="duracion" required autofocus autocomplete="duracion"
                                    value="{{ $audiovisual->duracion }}" />
                                <x-input-error :messages="$errors->get('duracion')" class="mt-1 md:mt-3" />
                            </div>

                            <!-- País -->
                            <div class="mb-1 md:mb-4 p-1 md:p-2 border border-gray-300 rounded shadow-md">
                                <x-input-label for="pais" :value="__('País')"
                                    class="block md:mb-2 md:mt-2 text-sm md:text-base font-bold text-gray-900 dark:text-white" />
                                <x-text-input id="pais" class="block md:mt-1 w-full text-sm md:text-md"
                                    type="text" name="pais" required autofocus autocomplete="pais"
                                    value="{{ $audiovisual->pais }}" />
                                <x-input-error :messages="$errors->get('pais')" class="mt-1 md:mt-3" />
                            </div>

                            <!-- Trailer -->
                            <div class="mb-1 md:mb-4 p-1 md:p-2 border border-gray-300 rounded shadow-md">
                                <x-input-label for="trailer" :value="__('Trailer')"
                                    class="block md:mb-2 md:mt-2 text-sm md:text-base font-bold text-gray-900 dark:text-white" />
                                <x-text-input id="trailer" class="block md:mt-1 w-full text-sm md:text-md"
                                    type="text" name="trailer" autofocus autocomplete="trailer"
                                    value="{{ $audiovisual->trailer }}" />
                                <x-input-error :messages="$errors->get('trailer')" class="mt-1 md:mt-3" />
                            </div>
                        </div>

                        <!-- Columna 2 -->
                        <div>
                            <!-- Tipos -->
                            <div class="mb-1 md:mb-4 p-1 md:p-2 border border-gray-300 rounded shadow-md">
                                <x-input-label for="tipo_id" :value="__('Tipo')"
                                    class="block md:mb-2 md:mt-2 text-sm md:text-base font-bold text-gray-900 dark:text-white" />
                                <select name="tipo_id"
                                    class="w-full border-blue-500 focus:border-blue-600 focus:ring-blue-500 rounded-md shadow-sm text-sm md:text-base">
                                    <option value="0" disabled>Selecciona un tipo</option>
                                    @foreach ($tipos as $tipo)
                                        <option value="{{ $tipo->id }}"
                                            {{ $tipo->id == $audiovisual->tipo_id ? 'selected' : '' }}>
                                            {{ $tipo->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('tipo_id')" class="mt-1 md:mt-3" />
                            </div>

                            <!-- Recomendación de edad -->
                            <div class="mb-1 md:mb-4 p-1 md:p-2 border border-gray-300 rounded shadow-md">
                                <x-input-label for="recomendacion_id" :value="__('Recomendación edad')"
                                    class="block md:mb-2 md:mt-2 text-sm md:text-base font-bold text-gray-900 dark:text-white" />
                                <select name="recomendacion_id"
                                    class="w-full border-blue-500 focus:border-blue-600 focus:ring-blue-500 rounded-md shadow-sm text-sm md:text-base">
                                    <option value="0" disabled>Selecciona una recomendación</option>
                                    @foreach ($recomendaciones as $recomendacion)
                                        <option value="{{ $recomendacion->id }}"
                                            {{ $recomendacion->id == $audiovisual->recomendacion_id ? 'selected' : '' }}>
                                            @if ($recomendacion->id == 1)
                                                Todos los públicos
                                            @else
                                                + {{ $recomendacion->edad }} años
                                            @endif
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('recomendacion_id')" class="mt-1 md:mt-2" />
                            </div>

                            <!-- Imagen -->
                            <div class="mb-1 md:mb-4 p-1 md:p-2 border border-gray-300 rounded shadow-md">
                                <x-input-label for="imagen" :value="__('Imagen')"
                                    class="block md:mb-2 md:mt-2 text-sm md:text-base font-bold text-gray-900 dark:text-white" />
                                <input type="file" id="imagen" name="imagen" accept="image/*"
                                    class="block w-full text-sm md:text-md border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <x-input-error :messages="$errors->get('imagen')" class="mt-1 md:mt-2" />
                            </div>

                            <!-- Sinopsis  -->
                            <div class="mb-1 md:mb-4 p-1 md:p-2 border border-gray-300 rounded shadow-md">
                                <x-input-label for="sinopsis" :value="__('Sinopsis')"
                                    class="block md:mb-2 md:mt-2 text-sm md:text-base font-bold text-gray-900 dark:text-white" />
                                <textarea id="sinopsis"
                                    class="block w-full h-20 md:h-64 text-sm md:text-base border-blue-500 focus:border-blue-600 focus:ring-blue-500 rounded-md shadow-sm"
                                    name="sinopsis" required autofocus autocomplete="sinopsis">{{ old('sinopsis', $audiovisual->sinopsis) }}</textarea>
                                <x-input-error :messages="$errors->get('sinopsis')" class="mt-1 md:mt-2" />
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Modal footer -->
                <div
                    class="flex items-center justify-center p-4 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                    <!-- Botón "Crear" -->
                    <button type="submit"
                        class="cursor-pointer bg-blue-500 border border-blue-600 hover:bg-blue-600 text-white rounded-md  px-4 py-2 font-semibold focus:outline-none focus:shadow-outline-blue active:bg-blue-600 text-xs md:text-base">
                        Guardar
                    </button>

                    <!-- Espacio entre botones -->
                    <div class="w-4"></div>

                    <!-- Botón "Cancelar" -->
                    <button data-modal-hide="EditarModal{{ $audiovisual }}" type="button"
                        class="cursor-pointer bg-red-500 border border-red-600 hover:bg-red-600 text-white rounded-md px-4 py-2 font-semibold focus:outline-none focus:shadow-outline-red active:bg-red-600 text-xs md:text-base">
                        Cancelar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
