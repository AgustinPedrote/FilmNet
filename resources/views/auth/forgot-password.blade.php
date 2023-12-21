<x-guest-layout>
    <div class="bg-blue-500 py-8 px-6 rounded-lg w-full max-w-md mx-auto">
         <!-- Imagen -->
         <div class="flex items-center justify-center mb-6">
            <img src="{{ asset('logos/logo3.png') }}" alt="Logo" class="w-3/4 object-contain">
        </div>

        <div class="mb-4 text-base text-white">
            <span class="font-bold">{{ __('¿Olvidaste tu contraseña?') }}</span>
            {{ __('Ningún problema. Simplemente háganos saber su dirección de correo electrónico y le enviaremos un enlace para restablecer su contraseña que le permitirá elegir una nueva.') }}
        </div>


        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-input-label class="text-white" for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                    required autofocus />
                <x-input-error :messages="$errors->get('email')" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-primary-button>
                    {{ __('Restablecer contraseña') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>
