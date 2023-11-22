{{-- Formulario de crítica --}}
<form method="POST" action="{{ route('criticas.store', $audiovisual) }}" id="criticaForm">
    @csrf

    <!-- Área de Texto para la Crítica -->
    <div class="mb-4">
        <label for="critica" class="block text-lg font-bold text-gray-500">Tu Crítica:</label>

        {{-- Alarmas cuando hacemos una crítica. --}}
        <x-input-error :messages="session('error')" class="mt-2" />
        <x-input-success :messages="session('success')" class="mt-2" />

        <textarea name="critica" id="critica" rows="4"
            class="form-input mt-1 block w-full focus:outline-none focus:shadow-outline-blue border border-gray-300 rounded-md px-4 py-2 resize-none"
            placeholder="Escribe tu opinión para que el resto de los usuarios la pueda leer."></textarea>
    </div>

    <div class="flex justify-center">
        <button type="submit" id="botoncritica"
            class="px-4 py-2 bg-blue-500 border border-blue-600 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:shadow-outline-blue active:bg-blue-600 mx-auto">
            Enviar
        </button>
    </div>
</form>

{{-- Código JS que comprueba antes de realizar una crítica si estas logueado y sino te redirige al login. --}}
<script>
    //Text-area
    document.getElementById('critica').addEventListener('click', function() {
        // Verificar si el usuario está autenticado
        @auth
        // Usuario autenticado, no hacer nada
    @else
        // Usuario no autenticado, redirigir al formulario de inicio de sesión
        window.location.href = "{{ route('login') }}";
    @endauth
    });

    //Botón formulario
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
