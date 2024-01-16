<x-guest-layout>
    <form method="POST" action="{{ route('login') }}" class="bg-blue-500 py-8 px-6 rounded-lg w-full max-w-md mx-auto">
        @csrf

        <!-- Imagen -->
        <div class="flex items-center justify-center mb-6">
            <img src="{{ asset('logos/logo3.png') }}" alt="Logo" class="w-3/4 object-contain">
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-2" :status="session('status')" />

        <!-- Mensajes de éxito y error -->
        <div class="relative z-10">
            @if (session('success'))
                <div>
                    <x-success :status="session('success')" />
                </div>
            @endif

            @if (session('error'))
                <div>
                    <x-error :status="session('error')" />
                </div>
            @endif
        </div>

        <!-- Email -->
        <div class="mb-4">
            <x-input-label class="text-white text-lg" for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full text-lg" type="email" name="email"
                :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mb-4 relative">
            <x-input-label class="text-white text-lg" for="password" :value="__('Contraseña')" />
            <div class="flex items-center">
                <x-text-input id="password" class="block mt-1 w-full text-lg bg-white text-black" type="password"
                    name="password" required autocomplete="current-password" />

                <div class="relative">
                    <button type="button" onclick="togglePasswordVisibility()"
                        class="absolute right-4 top-1/2 transform -translate-y-1/2 focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24" width="24" viewBox="0 0 576 512">
                            <path id="eye-icon"
                                d="M288 32c-80.8 0-145.5 36.8-192.6 80.6C48.6 156 17.3 208 2.5 243.7c-3.3 7.9-3.3 16.7 0 24.6C17.3 304 48.6 356 95.4 399.4C142.5 443.2 207.2 480 288 480s145.5-36.8 192.6-80.6c46.8-43.5 78.1-95.4 93-131.1c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C433.5 68.8 368.8 32 288 32zM144 256a144 144 0 1 1 288 0 144 144 0 1 1 -288 0zm144-64c0 35.3-28.7 64-64 64c-7.1 0-13.9-1.2-20.3-3.3c-5.5-1.8-11.9 1.6-11.7 7.4c.3 6.9 1.3 13.8 3.2 20.7c13.7 51.2 66.4 81.6 117.6 67.9s81.6-66.4 67.9-117.6c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3z" />
                        </svg>
                    </button>
                </div>
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember Me -->
            <div class="mb-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox"
                        class="rounded border-gray-300 text-yellow-300 shadow-sm focus:ring-blue-500" name="remember">
                    <span class="ml-2 text-base text-white">{{ __('Recuérdame') }}</span>
                </label>
            </div>

            <!-- Register -->
            <div class="mb-4">
                <p class="text-base text-white">
                    {{ __('¿No tienes una cuenta?') }}
                    <a class="underline hover:text-yellow-300" href="{{ route('register') }}">
                        {{ __('Regístrate aquí') }}
                    </a>
                </p>
            </div>

            <!-- Olvidaste contraseña -->
            <div class="flex items-center justify-end">
                @if (Route::has('password.request'))
                    <a class="underline text-base text-white hover:text-yellow-300 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        href="{{ route('password.request') }}">
                        {{ __('¿Olvidaste tu contraseña?') }}
                    </a>
                @endif

                <x-primary-button class="ml-2 text-lg">
                    {{ __('Acceso') }}
                </x-primary-button>
            </div>
    </form>

    <script>
        function togglePasswordVisibility() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eye-icon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.setAttribute('d',
                    'M38.8 5.1C28.4-3.1 13.3-1.2 5.1 9.2S-1.2 34.7 9.2 42.9l592 464c10.4 8.2 25.5 6.3 33.7-4.1s6.3-25.5-4.1-33.7L525.6 386.7c39.6-40.6 66.4-86.1 79.9-118.4c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C465.5 68.8 400.8 32 320 32c-68.2 0-125 26.3-169.3 60.8L38.8 5.1zM223.1 149.5C248.6 126.2 282.7 112 320 112c79.5 0 144 64.5 144 144c0 24.9-6.3 48.3-17.4 68.7L408 294.5c8.4-19.3 10.6-41.4 4.8-63.3c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3c0 10.2-2.4 19.8-6.6 28.3l-90.3-70.8zM373 389.9c-16.4 6.5-34.3 10.1-53 10.1c-79.5 0-144-64.5-144-144c0-6.9 .5-13.6 1.4-20.2L83.1 161.5C60.3 191.2 44 220.8 34.5 243.7c-3.3 7.9-3.3 16.7 0 24.6c14.9 35.7 46.2 87.7 93 131.1C174.5 443.2 239.2 480 320 480c47.8 0 89.9-12.9 126.2-32.5L373 389.9z'
                );
            } else {
                passwordInput.type = 'password';
                eyeIcon.setAttribute('d',
                    'M288 32c-80.8 0-145.5 36.8-192.6 80.6C48.6 156 17.3 208 2.5 243.7c-3.3 7.9-3.3 16.7 0 24.6C17.3 304 48.6 356 95.4 399.4C142.5 443.2 207.2 480 288 480s145.5-36.8 192.6-80.6c46.8-43.5 78.1-95.4 93-131.1c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C433.5 68.8 368.8 32 288 32zM144 256a144 144 0 1 1 288 0 144 144 0 1 1 -288 0zm144-64c0 35.3-28.7 64-64 64c-7.1 0-13.9-1.2-20.3-3.3c-5.5-1.8-11.9 1.6-11.7 7.4c.3 6.9 1.3 13.8 3.2 20.7c13.7 51.2 66.4 81.6 117.6 67.9s81.6-66.4 67.9-117.6c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3z'
                );
            }
        }
    </script>
</x-guest-layout>
