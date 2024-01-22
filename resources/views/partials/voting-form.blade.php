@auth
    <!-- Formulario de Votación -->
    <form class="mb-6 text-center w-full md:w-48 bg-gray-100 rounded-md p-2 border border-gray-300">
        @csrf

        <!-- Desplegable para Votación -->
        <div class="mb-4">
            <label for="voto" class="block text-lg font-bold text-gray-800">
                Tu voto
            </label>

            <!-- Activación script 'saveVote' -->
            <select name="voto" id="voto"
                class="form-select mt-2 block w-full focus:outline-none focus:shadow-outline-blue border border-gray-300 rounded-md px-4 py-2"
                onchange="saveVote(event, {{ $audiovisual }})">
                <option value="{{ null }}">No vista</option>
                @for ($i = 10; $i >= 1; $i--)
                    <option value="{{ $i }}" {{ isset($votacion) && $votacion->voto == $i ? 'selected' : '' }}>
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
    </form>
@else
    <div class="mb-4 text-center w-full md:w-48 bg-gray-100 rounded-md p-10 border-gray-300">
        <label for="voto" class="block text-lg font-bold text-gray-800">
            Tu voto
        </label>

        <div class="bg-white rounded-md p-2 border border-gray-300 mt-2">
            <a class="text-blue-500 hover:underline font-bold"
                href="{{ route('login') }}">{{ $audiovisual->obtenerTipo() }}</a>
        </div>
    </div>
@endauth
