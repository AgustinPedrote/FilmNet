<!-- Ventana modal para editar un premio -->
<div id="InsertarModal" tabindex="-1" aria-hidden="true"
    class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-2xl mx-auto">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-start justify-between p-1 border-b rounded-t dark:border-gray-600 bg-blue-500">
                <button type="button"
                    class="text-white bg-transparent  hover:text-gray-100 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:text-white"
                    data-modal-hide="InsertarModal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>

            <!-- Modal body -->
            <form id="formularioEdit" action="{{ route('premios.store') }}" method="POST">
                @csrf
                <div class="p-6 space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="mb-6">
                            <x-input-label for="titulo" :value="__('Titulo')"
                                class="block mb-2 text-base font-bold text-gray-900 dark:text-white" />
                            <x-text-input id="titulo" class="block mt-1 w-full text-md" type="text" name="titulo"
                                required autofocus autocomplete="titulo" />
                            <x-input-error :messages="$errors->get('titulo')" class="mt-2" />

                            <x-input-label for="titulo_original" :value="__('Titulo orignal')"
                                class="block mb-2 text-base font-bold text-gray-900 dark:text-white mt-2" />
                            <x-text-input id="titulo_original" class="block mt-1 w-full text-md" type="text"
                                name="titulo_original" required autofocus autocomplete="titulo_original" />
                            <x-input-error :messages="$errors->get('titulo_original')" class="mt-2" />

                            <x-input-label for="year" :value="__('Año')"
                                class="block mb-2 text-base font-bold text-gray-900 dark:text-white mt-2" />
                            <x-text-input id="year" class="block mt-1 w-full text-md" type="text" name="year"
                                required autofocus autocomplete="year" />
                            <x-input-error :messages="$errors->get('year')" class="mt-2" />

                            <x-input-label for="duracion" :value="__('Duración')"
                                class="block mb-2 text-base font-bold text-gray-900 dark:text-white mt-2" />
                            <x-text-input id="duracion" class="block mt-1 w-full text-md" type="text"
                                name="duracion" required autofocus autocomplete="duracion" />
                            <x-input-error :messages="$errors->get('duracion')" class="mt-2" />

                            <x-input-label for="pais" :value="__('País')"
                                class="block mb-2 text-base font-bold text-gray-900 dark:text-white mt-2" />
                            <x-text-input id="pais" class="block mt-1 w-full text-md" type="text" name="pais"
                                required autofocus autocomplete="pais" />
                            <x-input-error :messages="$errors->get('pais')" class="mt-2" />
                        </div>

                        <div class="mb-6">
                            <x-input-label for="sinopsis" :value="__('Sinopsis')"
                                class="block mb-2 text-base font-bold text-gray-900 dark:text-white mt-2" />
                            <x-text-input id="sinopsis" class="block mt-1 w-full text-md" type="text"
                                name="sinopsis" required autofocus autocomplete="sinopsis" />
                            <x-input-error :messages="$errors->get('sinopsis')" class="mt-2" />

                            <x-input-label for="img" :value="__('Imagen')"
                                class="block mb-2 text-base font-bold text-gray-900 dark:text-white mt-2" />
                            <x-text-input id="img" class="block mt-1 w-full text-md" type="text" name="img"
                                required autofocus autocomplete="img" />
                            <x-input-error :messages="$errors->get('img')" class="mt-2" />

                            <x-input-label for="trailer" :value="__('Trailer')"
                                class="block mb-2 text-base font-bold text-gray-900 dark:text-white mt-2" />
                            <x-text-input id="trailer" class="block mt-1 w-full text-md" type="text" name="trailer"
                                required autofocus autocomplete="trailer" />
                            <x-input-error :messages="$errors->get('trailer')" class="mt-2" />

                            <x-input-label for="tipo_id" :value="__('Tipo')"
                                class="block mb-2 text-base font-bold text-gray-900 dark:text-white mt-2" />
                            <x-text-input id="tipo_id" class="block mt-1 w-full text-md" type="text" name="tipo_id"
                                required autofocus autocomplete="tipo_id" />
                            <x-input-error :messages="$errors->get('tipo_id')" class="mt-2" />

                            <x-input-label for="recomendacion_id" :value="__('Recomendación')"
                                class="block mb-2 text-base font-bold text-gray-900 dark:text-white mt-2" />
                            <x-text-input id="recomendacion_id" class="block mt-1 w-full text-md" type="text"
                                name="recomendacion_id" required autofocus autocomplete="recomendacion_id" />
                            <x-input-error :messages="$errors->get('recomendacion_id')" class="mt-2" />

                            @error('nombre')
                                <br>
                                <small>*{{ $message }}</small>
                                <br>
                            @enderror
                        </div>
                    </div>

                    @error('nombre')
                        <br>
                        <small>*{{ $message }}</small>
                        <br>
                    @enderror
                </div>

                <!-- Modal footer -->
                <div
                    class="flex items-center justify-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                    <!-- Botón "Crear" -->
                    <input type="hidden" name="audiovisual_" class="audiovisual">
                    <button type="submit"
                        class="cursor-pointer bg-blue-500 border border-blue-600 hover:bg-blue-600 text-white rounded-md  px-4 py-2 font-semibold focus:outline-none focus:shadow-outline-blue active:bg-blue-600">
                        Guardar
                    </button>

                    <!-- Espacio entre botones -->
                    <div class="w-4"></div>

                    <!-- Botón "Cancelar" -->
                    <button data-modal-hide="InsertarModal" type="button"
                        class="cursor-pointer bg-blue-500 border border-blue-600 hover:bg-blue-600 text-white rounded-md px-4 py-2 font-semibold focus:outline-none focus:shadow-outline-blue active:bg-blue-600">
                        Cancelar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function buscarAudiovisual2(modalId) {
        console.log("entra");
        var searchQuery = document.getElementById('search_audiovisual').value.trim();
        console.log(searchQuery);
        var audiovisualResults = document.getElementById('audiovisualResults');
        var audiovisual = document.querySelector('.audiovisual');
        var audiovisualInput = document.getElementById('search_audiovisual');

        // Verificar si la búsqueda está en blanco
        if (searchQuery === '') {
            // Limpiar la lista de resultados si la búsqueda está vacía
            document.getElementById('audiovisualResults').innerHTML = '';
            audiovisualResults.classList.remove('border', 'border-gray-300');
            return;
        }

        // Realizar la búsqueda con AJAX
        axios.get('/busqueda/audiovisual', {
                params: {
                    query: searchQuery
                }
            })
            .then(function(response) {
                // Limpiar la lista de resultados
                audiovisualResults.innerHTML = '';

                if (response.data) {
                    audiovisualResults.classList.add('border', 'border-gray-500', 'rounded-lg', 'p-2');
                }

                // Mostrar los resultados
                response.data.forEach(function(resultado) {
                    var li = document.createElement('li');
                    li.classList.add('hover:bg-blue-200', 'transition', 'duration-300', 'ease-in-out');
                    li.textContent = resultado
                        .titulo; // Asegúrate de adaptar esto según la estructura de tus resultados

                    // Agregar un evento de clic para seleccionar el resultado
                    li.addEventListener('click', function() {
                        audiovisual.value = resultado.id;
                        audiovisualInput.value = resultado.titulo;

                        // Cerrar la lista de resultados
                        audiovisualResults.innerHTML = '';
                        audiovisualResults.classList.remove('border', 'border-gray-300');
                    });

                    audiovisualResults.appendChild(li);
                });
            })
            .catch(function(error) {
                console.error('Error al realizar la búsqueda:', error);
            });
    }
</script>
