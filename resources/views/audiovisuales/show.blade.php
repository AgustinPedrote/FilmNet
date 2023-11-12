<x-app-layout>
    <!-- Contenido de la Página -->
    <div class="flex flex-wrap items-start">
        <!-- Título del Audiovisual -->
        <div class="w-full p-4">
            <!-- Título -->
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight border-b-2 border-blue-500 w-11/12">
                {{ $audiovisual->titulo }}
            </h2>
        </div>

        <!-- Detalles del Audiovisual -->
        <div class="w-full md:w-2/3 p-4 space-y-2">
            <!-- Descripción y Características -->
            <div class="mb-2">
                <p class="text-gray-600">{{ $audiovisual->descripcion }}</p>
            </div>

            <!-- Detalles adicionales -->
            <div class="text-lg text-gray-500">
                <div><strong>Título Original:</strong> {{ $audiovisual->titulo_original }}</div>
                <div><strong>Año:</strong> {{ $audiovisual->year }}</div>
                <div><strong>Duración:</strong> {{ $audiovisual->duracion }} minutos</div>
                <div><strong>País:</strong> {{ $audiovisual->pais }}</div>

                <!-- Mostrar información de las personas relacionadas -->
                <div><strong>Director:</strong>
                    @foreach ($audiovisual->directores as $director)
                        {{ $director->nombre }}@if (!$loop->last)
                            ,
                        @endif
                    @endforeach
                </div>

                <div><strong>Compositor:</strong>
                    @foreach ($audiovisual->compositores as $compositor)
                        {{ $compositor->nombre }}@if (!$loop->last)
                            ,
                        @endif
                    @endforeach
                </div>

                <div><strong>Fotografía:</strong>
                    @foreach ($audiovisual->fotografias as $fotografia)
                        {{ $fotografia->nombre }}@if (!$loop->last)
                            ,
                        @endif
                    @endforeach
                </div>

                <div><strong>Guionista:</strong>
                    @foreach ($audiovisual->guionistas as $guionista)
                        {{ $guionista->nombre }}@if (!$loop->last)
                            ,
                        @endif
                    @endforeach
                </div>

                <!-- Reparto -->
                <div><strong>Reparto:</strong>
                    @foreach ($audiovisual->repartos as $reparto)
                        {{ $reparto->nombre }}@if (!$loop->last)
                            ,
                        @endif
                    @endforeach
                </div>

                <!-- Géneros -->
                <div><strong>Géneros:</strong>
                    @foreach ($audiovisual->generos as $genero)
                        {{ $genero->nombre }}@if (!$loop->last)
                            ,
                        @endif
                    @endforeach
                </div>

                {{-- Sinopsis --}}
                <div class="mt-4"><strong>Sinopsis:</strong> {{ $audiovisual->sinopsis }}</div>
            </div>

            <!-- Formulario de Críticas -->
            <div class="mt-6 p-6 bg-white rounded-lg shadow-md">
                <form action="{{-- {{ route('guardar_critica', ['audiovisual_id' => $audiovisual->id]) }} --}}" method="post">
                    @csrf
                    <!-- Área de Texto para la Crítica -->
                    <div class="mb-4">
                        <label for="critica" class="block text-lg font-bold text-gray-500">Tu Crítica:</label>
                        <textarea name="critica" id="critica" rows="4"
                            class="form-input mt-1 block w-full focus:outline-none focus:shadow-outline-blue border border-gray-300 rounded-md px-4 py-2 resize-none"
                            placeholder="Escribe tu opinión para que el resto de los usuarios la pueda leer."></textarea>
                    </div>
                    <!-- Botón para Enviar la Crítica -->
                    <div class="flex justify-center">
                        <button type="submit"
                            class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:shadow-outline-blue active:bg-blue-800 mx-auto">
                            Enviar Crítica
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Imagen del Audiovisual -->
        <div class="w-full md:w-1/3 p-4 flex items-center justify-center">
            <img src="{{ $audiovisual->img }}" alt="{{ $audiovisual->titulo }}"
                class="w-full h-auto object-cover md:w-48 mx-auto my-auto rounded-lg shadow-md">
            <!-- Imagen con bordes redondeados y sombreada -->
        </div>

    </div>
</x-app-layout>
