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
        <div class="w-full md:w-2/3 p-4 space-y-2 mt-2 bg-white rounded-lg shadow-md">
            <!-- Descripción y Características -->
            <div class="mb-2">
                <p class="text-gray-600">{{ $audiovisual->descripcion }}</p>
            </div>

            <!-- Detalles adicionales con mayor margen -->
            <div class="text-lg text-gray-500 space-y-2 mb-4">
                <div class="mb-2"><strong>Título Original:</strong> {{ $audiovisual->titulo_original }}</div>
                <div class="mb-2"><strong>Año:</strong> {{ $audiovisual->year }}</div>
                <div class="mb-2"><strong>Duración:</strong> {{ $audiovisual->duracion }} minutos</div>
                <div class="mb-2"><strong>País:</strong> {{ $audiovisual->pais }}</div>

                <!-- Mostrar información de las personas relacionadas -->
                <div class="mb-2"><strong>Director:</strong>
                    @foreach ($audiovisual->directores as $director)
                        {{ $director->nombre }}@if (!$loop->last)
                            ,
                        @endif
                    @endforeach
                </div>

                <div class="mb-2"><strong>Compositor:</strong>
                    @foreach ($audiovisual->compositores as $compositor)
                        {{ $compositor->nombre }}@if (!$loop->last)
                            ,
                        @endif
                    @endforeach
                </div>

                <div class="mb-2"><strong>Fotografía:</strong>
                    @foreach ($audiovisual->fotografias as $fotografia)
                        {{ $fotografia->nombre }}@if (!$loop->last)
                            ,
                        @endif
                    @endforeach
                </div>

                <div class="mb-2"><strong>Guionista:</strong>
                    @foreach ($audiovisual->guionistas as $guionista)
                        {{ $guionista->nombre }}@if (!$loop->last)
                            ,
                        @endif
                    @endforeach
                </div>

                <!-- Reparto -->
                <div class="mb-2"><strong>Reparto:</strong>
                    @foreach ($audiovisual->repartos as $reparto)
                        {{ $reparto->nombre }}@if (!$loop->last)
                            ,
                        @endif
                    @endforeach
                </div>

                <!-- Géneros -->
                <div class="mb-2"><strong>Géneros:</strong>
                    @foreach ($audiovisual->generos as $genero)
                        {{ $genero->nombre }}@if (!$loop->last)
                            ,
                        @endif
                    @endforeach
                </div>

                {{-- Sinopsis --}}
                <div class="mb-2"><strong>Sinopsis:</strong> {{ $audiovisual->sinopsis }}</div>
            </div>

            <!-- Formulario de Críticas -->
            <form method="POST" action="{{ route('criticas.store', $audiovisual) }}" id="criticaForm">
                @csrf

                <!-- Área de Texto para la Crítica -->
                <div class="mb-4">
                    <label for="critica" class="block text-lg font-bold text-gray-500">Tu Crítica:</label>

                    {{-- Código JS que comprueba antes de realizar una crítica si estas logueado y sino te redirige al login. --}}
                    <x-input-error :messages="session('error')" class="mt-2" />
                    <x-input-success :messages="session('success')" class="mt-2" />

                    <textarea name="critica" id="critica" rows="4"
                        class="form-input mt-1 block w-full focus:outline-none focus:shadow-outline-blue border border-gray-300 rounded-md px-4 py-2 resize-none"
                        placeholder="Escribe tu opinión para que el resto de los usuarios la pueda leer."></textarea>
                </div>

                <div class="flex justify-center">
                    <button type="submit" id="botoncritica"
                        class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:shadow-outline-blue active:bg-blue-800 mx-auto">
                        Enviar
                    </button>
                </div>
            </form>

            {{-- Código JS que comprueba antes de realizar una crítica si estas logueado y sino te redirige al login. --}}
            <script>
                document.getElementById('critica').addEventListener('click', function() {
                    // Verificar si el usuario está autenticado
                    @auth
                    // Usuario autenticado, no hacer nada
                @else
                    // Usuario no autenticado, redirigir al formulario de inicio de sesión
                    window.location.href = "{{ route('login') }}";
                @endauth
                });


                document.getElementById('criticaForm').addEventListener('submit', function(event) {
                    // Evitar que el formulario se envíe automáticamente
                    event.preventDefault();

                    // Verificar si el usuario está autenticado
                    @auth
                    // Usuario autenticado, enviar el formulario
                    this.submit();
                @else
                    // Usuario no autenticado, redirigir al formulario de inicio de sesión
                    window.location.href = "{{ route('login') }}";
                @endauth
                });
            </script>

            <!-- Trailer del Audiovisual -->
            <div class="mt-6">
                <h3 class="block text-lg font-bold text-gray-500">Trailer:</h3>
                @if ($audiovisual->trailer)
                    <iframe class="w-full" height="500" src="{{ $audiovisual->trailer }}"
                        title="YouTube video player" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        allowfullscreen></iframe>
                @else
                    <p class="text-lg text-red-500 space-y-1">No hay trailer disponible para este audiovisual.</p>
                @endif
            </div>
        </div>

        <!-- Imagen del Audiovisual -->
        <div class="w-full md:w-1/3 p-4 flex flex-col items-center justify-center">
            <img src="{{ $audiovisual->img }}" alt="{{ $audiovisual->titulo }}"
                class="w-full h-auto object-cover md:w-48 mx-auto my-auto rounded-lg shadow-md">

            <!-- Nota media de las votaciones -->
            <div class="mt-2 text-center">
                <p class="text-lg font-bold text-gray-800">Nota Media:</p>
                <p class="font-bold {{ $notaMedia ? 'text-3xl text-blue-500' : 'text-xl text-gray-500' }}">
                    {{ $notaMedia ? number_format($notaMedia, 1) : 'Sin votaciones' }}
                </p>
            </div>

            <!-- Número de votos -->
            <div class="mt-2 text-center">
                <p class="text-blue-500 font-bold"> {{ $notaMedia ? $numeroVotos . ' Votos'  : '' }} </p>
            </div>

            <!-- Link a críticas del audiovisual -->
            <div class="mt-2 text-center">
                <a href="{{ route('ver.criticas', $audiovisual) }}" class="text-blue-500 hover:underline">
                    {{ $audiovisual->criticas->count() }} Críticas
                </a>
            </div>

            <!-- Formulario de Votación -->
            <form method="POST" action="{{ route('votaciones.store', $audiovisual) }}"
                class="mt-4 text-center w-1/2 bg-gray-200 rounded-md p-2 border-gray-400">
                @csrf

                <!-- Desplegable para Votación -->
                <div class="mb-4">
                    <label for="voto" class="block text-lg font-bold text-gray-800">Tu voto</label>
                    <select name="voto" id="voto"
                        class="form-select mt-1 block w-full focus:outline-none focus:shadow-outline-blue border border-gray-300 rounded-md px-4 py-2">
                        <option value="{{ null }}">No vista</option>
                        @for ($i = 10; $i >= 1; $i--)
                            <option value="{{ $i }}"
                                {{ isset($votacion) && $votacion->voto == $i ? 'selected' : '' }}>
                                {{ $i }} -
                                @if ($i == 10)
                                    Excelente
                                @elseif($i == 9)
                                    Muy buena
                                @elseif($i == 8)
                                    Notable
                                @elseif($i == 7)
                                    Buena
                                @elseif($i == 6)
                                    Interesante
                                @elseif($i == 5)
                                    Pasable
                                @elseif($i == 4)
                                    Regular
                                @elseif($i == 3)
                                    Floja
                                @elseif($i == 2)
                                    Mala
                                @else
                                    Muy mala
                                @endif
                            </option>
                        @endfor
                    </select>
                </div>

                <!-- Botón para Enviar la Votación -->
                <div class="flex justify-center">
                    <button type="submit"
                        class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:shadow-outline-blue active:bg-blue-800 mx-auto">
                        Enviar
                    </button>
                </div>
            </form>
        </div>

    </div>
</x-app-layout>
