<x-app-layout>
    <h1 class="text-2xl font-bold mb-6 mt-16 ml-10 border-b-2 border-blue-500 w-11/12 pb-2 text-gray-800">
        Amigos
    </h1>

    <!-- Nuevo campo de búsqueda para Audiovisual al que pertenece el premio -->
    <div class="md:w-1/3 mx-auto mt-2 mb-6">
        <form action="{{ route('seguir.amigo') }}" method="POST">
            @csrf

            <x-input-label for="search_amigo" class="block mb-2 text-xl font-bold text-gray-900 dark:text-white mt-2" />

            <div class="flex items-center">
                <input id="search_amigo"
                    class="block w-full border-blue-500 focus:border-blue-600 focus:ring-blue-500 rounded-md shadow-sm"
                    type="text" name="search_amigo" placeholder="Buscar amigos..." />

                <!-- Campo oculto -->
                <input type="hidden" name="amigo" id="amigoId" class="amigo">

                <button type="button" onclick="buscarAmigo()"
                    class="px-4 py-2 ml-4 cursor-pointer bg-green-500 border border-green-600 hover:bg-green-600 text-white rounded-md font-semibold focus:outline-none focus:shadow-outline-green active:bg-green-600">
                    Buscar
                </button>

                <!-- Botón "Crear" -->
                <button type="submit"
                    class="ml-2 cursor-pointer bg-blue-500 border border-blue-600 hover:bg-blue-600 text-white rounded-md px-4 py-2 font-semibold focus:outline-none focus:shadow-outline-blue active:bg-blue-600">
                    Seguir
                </button>
            </div>

            <!-- Lista de resultados de la búsqueda -->
            <ul id="amigoResults"
                class="mt-2 space-y-2 cursor-pointer divide-y divide-gray-300 overflow-y-auto max-h-52">
            </ul>
        </form>
    </div>

    @if ($amigos->isEmpty())
        <div class="text-gray-500 text-lg text-center mt-8 h-screen">
            <p>No sigues a ningún amigo.</p>
        </div>
    @else
        <div class="mx-auto w-11/12 h-screen">
            <table class="min-w-full table-auto border border-gray-300 divide-y divide-gray-300">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border bg-gray-200 text-gray-700 font-bold uppercase">Nombre</th>
                        <th class="py-2 px-4 border bg-gray-200 text-gray-700 font-bold uppercase">País</th>
                        <th class="py-2 px-4 border bg-gray-200 text-gray-700 font-bold uppercase">Ciudad</th>
                        <th class="py-2 px-4 border bg-gray-200 text-gray-700 font-bold uppercase">Votaciones</th>
                        <th class="py-2 px-4 border bg-gray-200 text-gray-700 font-bold uppercase">Críticas</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($amigos as $amigo)
                        <tr>
                            <td class="py-2 px-4 border text-center">{{ $amigo->name }}</td>
                            <td class="py-2 px-4 border text-center">{{ $amigo->pais }}</td>
                            <td class="py-2 px-4 border text-center">{{ $amigo->ciudad }}</td>
                            <td class="py-2 px-4 border text-center">{{ $amigo->votaciones->count() }}</td>
                            <td class="py-2 px-4 border text-center">{{ $amigo->criticas->count() }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Botón para volver a la página anterior -->
        <div class="mt-6">
            <a href="#" onclick="goBack()" class="flex items-center ml-6">
                <span class="bottom-4 right-4 p-2 bg-blue-500 text-white rounded-full cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                        class="h-6 w-6">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                </span>
            </a>
        </div>
    @endif

    <script>
        function goBack() {
            window.history.back();
        }

        function buscarAmigo() {
            var searchQuery = document.getElementById("search_amigo").value.trim();
            var amigoResults = document.getElementById("amigoResults");

            if (searchQuery === "") {
                amigoResults.innerHTML = "";
                return;
            }

            axios.get("/busqueda/amigo", {
                    params: {
                        query: searchQuery,
                    },
                })
                .then(function(response) {
                    amigoResults.innerHTML = "";
                    var amigos = response.data.amigos;

                    if (Array.isArray(amigos) && amigos.length > 0) {
                        amigos.forEach(function(resultado) {
                            var li = document.createElement("li");
                            li.classList.add(
                                "hover:bg-blue-200",
                                "transition",
                                "duration-300",
                                "ease-in-out"
                            );
                            li.textContent = resultado.name;

                            li.addEventListener("click", function() {
                                document.getElementById("search_amigo").value = resultado.name;

                                // Cambia la línea para obtener el campo de entrada oculto correctamente
                                var amigoHiddenInput = document.getElementById("amigoId");
                                amigoHiddenInput.value = resultado.id;

                                amigoResults.innerHTML = "";
                            });

                            amigoResults.appendChild(li);
                        });
                    } else {
                        console.error("No se encontraron amigos.");
                        amigoResults.innerHTML = "<li>No se encontraron amigos.</li>";
                    }
                })
                .catch(function(error) {
                    console.error("Error al realizar la búsqueda:", error);
                    amigoResults.innerHTML = "<li>Error en la búsqueda.</li>";
                });
        }
    </script>
</x-app-layout>
