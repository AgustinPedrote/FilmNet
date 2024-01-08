<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" id="registrationForm"
        class="bg-blue-500 p-8 rounded-lg w-full mx-auto">
        @csrf

        <!-- Imagen -->
        <div class="flex items-center justify-center mb-2">
            <img src="{{ asset('logos/logo3.png') }}" alt="Logo" class="w-1/3 object-contain">
        </div>

        <!-- Dos columnas con los campos requerídos -->
        <div class="grid grid-cols-2 gap-4">
            <!-- Columna 1 -->
            <div>
                <!-- Nombre -->
                <x-input-label class="text-white text-lg" for="name" :value="__('Nombre')" />
                <x-text-input id="name" class="block mt-1 w-full text-md" type="text" name="name"
                    :value="old('name')" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />

                <!-- Año de nacimiento -->
                <x-input-label class="text-white mt-4" for="nacimiento" :value="__('Año de nacimiento')" />
                <x-text-input id="nacimiento" class="block mt-1 w-full text-md" type="number" name="nacimiento"
                    :value="old('nacimiento')" required min="1900" max="9999" />
                <x-input-error :messages="$errors->get('nacimiento')" class="mt-2" />

                <!-- Email Address -->
                <x-input-label class="text-white mt-4" for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full text-md" type="email" name="email"
                    :value="old('email')" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />

                <!-- Género -->
                <x-input-label class="text-white mt-4" for="sexo" :value="__('Género')" />
                <select id="sexo" name="sexo"
                    class="block mt-1 w-full text-md border-blue-500 focus:border-blue-600 focus:ring-blue-500 rounded-md shadow-sm">
                    <option value="" disabled selected>Selecciona tu género</option>
                    <option value="hombre" {{ old('sexo') == 'hombre' ? 'selected' : '' }}>Hombre</option>
                    <option value="mujer" {{ old('sexo') == 'mujer' ? 'selected' : '' }}>Mujer</option>
                </select>
                <x-input-error :messages="$errors->get('sexo')" class="mt-2" id="sexo-error" />
            </div>

            <!-- Columna 2 -->
            <div>
                <!-- País -->
                <x-input-label class="text-white" for="pais" :value="__('País')" />
                <x-text-input id="pais" class="block mt-1 w-full text-md" type="text" name="pais"
                    :value="old('pais')" required autofocus autocomplete="pais" />
                <x-input-error :messages="$errors->get('pais')" class="mt-2" />

                <!-- Ciudad -->
                <x-input-label class="text-white mt-4" for="ciudad" :value="__('Ciudad')" />
                <x-text-input id="ciudad" class="block mt-1 w-full text-md" type="text" name="ciudad"
                    :value="old('ciudad')" required autofocus autocomplete="ciudad" />
                <x-input-error :messages="$errors->get('ciudad')" class="mt-2" />

                <!-- Contraseña -->
                <x-input-label class="text-white mt-4" for="password" :value="__('Contraseña')" />
                <x-text-input id="password" class="block mt-1 w-full text-md" type="password" name="password" required
                    autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />

                <!-- Confirmar contraseña -->
                <x-input-label class="text-white mt-4" for="password_confirmation" :value="__('Confirmar contraseña')" />
                <x-text-input id="password_confirmation" class="block mt-1 w-full text-md" type="password"
                    name="password_confirmation" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-base text-white hover:text-yellow-300 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                href="{{ route('login') }}">
                {{ __('¿Ya registrado?') }}
            </a>

            <x-primary-button class="ml-4 text-lg" id="registerButton">
                {{ __('Registro') }}
            </x-primary-button>
        </div>
    </form>

    <!-- Validación del formulario de registro con JS -->
    <script src="{{ asset('js/validation_register.js') }}"></script>
</x-guest-layout>
