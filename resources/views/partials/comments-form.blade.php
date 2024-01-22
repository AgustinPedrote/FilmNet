{{-- Formulario de crítica --}}
<form method="POST" action="{{ route('criticas.store', $audiovisual) }}" id="criticaForm">
    @csrf

    <!-- Contenedor principal -->
    <div class="mb-3 flex items-start">
        <label for="critica" class="block text-lg font-bold text-gray-500">Tu Crítica:</label>

        <!-- Mensaje de error -->
        <div id="error" class="text-red-500 ml-3 font-semibold text-lg">
            <!-- Contenido del mensaje de error -->
        </div>
    </div>

    <!-- Área de Texto para la Crítica -->
    <div class="mb-3">
        <textarea name="critica" id="critica" rows="4"
            class="form-input mt-1 block w-full focus:outline-none focus:shadow-outline-blue border border-gray-300 rounded-md px-4 py-2 resize-none h-44 text-lg"
            placeholder="Escribe tu opinión para que el resto de los usuarios la pueda leer."></textarea>
    </div>

    <div class="flex justify-center">
        <button type="submit" id="botoncritica"
            class="px-4 py-2 bg-blue-500 border border-blue-600 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:shadow-outline-blue active:bg-blue-600 mx-auto font-semibold">
            Enviar
        </button>
    </div>
</form>


{{-- Código JS que comprueba antes de realizar una crítica si estás logueado, verifica contenido malsonante y sino te redirige al login. --}}
<script>
    document.getElementById('criticaForm').addEventListener('submit', function(event) {
        // Evitar que el formulario se envíe automáticamente
        event.preventDefault();

        // Verificar si el usuario está autenticado
        @auth
        // Obtener el contenido de la crítica
        var critica = document.getElementById('critica').value.toLowerCase();

        // Lista de palabras malsonantes
        var palabrasMalsonantes = ['horrible', 'basura', 'asquerosa'];

        // Verificar si la crítica contiene palabras malsonantes
        var contenidoMalsonante = palabrasMalsonantes.some(function(palabra) {
            return critica.includes(palabra);
        });

        // Mostrar mensaje de error  si contenidoMalsonante es true (tiene palabras malsonantes)
        if (contenidoMalsonante) {
            // Mensaje de error por contenido malsonante
            document.getElementById('error').innerText =
                "No se puede publicar la crítica debido a contenido malsonante.";
        } else {
            // Usuario autenticado y crítica válida, enviar el formulario
            this.submit();
        }
    @else
        // Usuario no autenticado, redirigir al formulario de inicio de sesión
        window.location.href = "{{ route('login') }}";
    @endauth
    });
</script>
