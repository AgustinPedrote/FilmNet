<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Nombre -->
        <div>
            <x-input-label for="name" :value="__('Nombre')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
                autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Año de nacimiento -->
        <div class="mt-4">
            <x-input-label for="nacimiento" :value="__('Año de nacimiento')" />
            <x-text-input id="nacimiento" class="block mt-1 w-full" type="number" name="nacimiento" :value="old('nacimiento')" required min="1900" max="9999" />
            <x-input-error :messages="$errors->get('nacimiento')" class="mt-2" />
        </div>

        <!-- Sexo -->
        <div class="mt-4">
            <x-input-label for="sexo" :value="__('Sexo')" />
            <select id="sexo" name="sexo" class="block mt-1 w-full" required>
                <option value="hombre" {{ old('sexo') == 'hombre' ? 'selected' : '' }}>Hombre</option>
                <option value="mujer" {{ old('sexo') == 'mujer' ? 'selected' : '' }}>Mujer</option>
            </select>
            <x-input-error :messages="$errors->get('sexo')" class="mt-2" />
        </div>

        <!-- País -->
        <div class="mt-4">
            <x-input-label for="pais" :value="__('País')" />
            <x-text-input id="pais" class="block mt-1 w-full" type="text" name="pais" :value="old('pais')"
                required autofocus autocomplete="pais" />
            <x-input-error :messages="$errors->get('pais')" class="mt-2" />
        </div>

        <!-- Ciudad -->
        <div class="mt-4">
            <x-input-label for="ciudad" :value="__('Ciudad')" />
            <x-text-input id="ciudad" class="block mt-1 w-full" type="text" name="ciudad" :value="old('ciudad')"
                required autofocus autocomplete="ciudad" />
            <x-input-error :messages="$errors->get('ciudad')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Contraseña -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Contraseña')" />

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirmar contraseña -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirmar contraseña')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                href="{{ route('login') }}">
                {{ __('¿Ya registrado?') }}
            </a>

            <x-primary-button class="ml-4">
                {{ __('Registro') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
