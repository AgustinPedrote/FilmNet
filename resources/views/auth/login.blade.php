<x-guest-layout>
    <form method="POST" action="{{ route('login') }}" class="bg-blue-500 py-8 px-6 rounded-lg w-full max-w-md mx-auto">
        @csrf

        <!-- Imagen -->
        <div class="flex items-center justify-center mb-6">
            <img src="{{ asset('img/logo3.png') }}" alt="Logo" class="w-3/4 object-contain">
        </div>

        <!-- Email -->
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

        <div class="mb-4">
            <x-input-label class="text-white text-lg" for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full text-lg" type="email" name="email"
                :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mb-4">
            <x-input-label class="text-white text-lg" for="password" :value="__('Contraseña')" />
            <x-text-input id="password" class="block mt-1 w-full text-lg" type="password" name="password" required
                autocomplete="current-password" />
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
</x-guest-layout>
