<section>
    <header>
        <h1 class="text-lg font-medium text-gray-900">
            {{ __('Datos Personales') }}
        </h1>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}" novalidate>
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" id="profile-update-form" class="mt-6 space-y-6" novalidate>
        @csrf
        @method('patch')

        <!-- Nombre -->
        <div>
            <x-input-label for="name" :value="__('Nombre')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)"
                required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <!-- Año de nacimiento -->
        <div>
            <x-input-label for="nacimiento" :value="__('Año de nacimiento')" />
            <x-text-input id="nacimiento" name="nacimiento" type="number" class="mt-1 block w-full" :value="old('nacimiento', $user->nacimiento)"
                required autofocus autocomplete="nacimiento" />
            <x-input-error class="mt-2" :messages="$errors->get('nacimiento')" />
        </div>

        <!-- País -->
        <div>
            <x-input-label for="pais" :value="__('País')" />
            <x-text-input id="pais" name="pais" type="text" class="mt-1 block w-full" :value="old('pais', $user->pais)"
                required autofocus autocomplete="pais" />
            <x-input-error class="mt-2" :messages="$errors->get('pais')" />
        </div>

        <!-- Ciudad -->
        <div>
            <x-input-label for="ciudad" :value="__('Ciudad')" />
            <x-text-input id="ciudad" name="ciudad" type="text" class="mt-1 block w-full" :value="old('ciudad', $user->ciudad)"
                required autofocus autocomplete="ciudad" />
            <x-input-error class="mt-2" :messages="$errors->get('ciudad')" />
        </div>

        <!-- Género -->
        <div>
            <x-input-label for="sexo" :value="__('Género')" />
            <select id="sexo" name="sexo"
                class="mt-1 block w-full border-blue-500 focus:border-blue-600 focus:ring-blue-500 rounded-md shadow-sm">
                <option value="" disabled>Selecciona tu género</option>
                <option value="hombre" {{ old('sexo', $user->sexo) == 'hombre' ? 'selected' : '' }}>Hombre</option>
                <option value="mujer" {{ old('sexo', $user->sexo) == 'mujer' ? 'selected' : '' }}>Mujer</option>
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('sexo')" />
        </div>

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)"
                required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification"
                            class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

         <!-- Botón de guardar -->
        <div class="flex items-center gap-4">
            <button id="profile-update-button"
                class='inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150'>
                {{ __('Guardar') }}
            </button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600">{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>

<!-- Validación del formulario del perfil con JS -->
<script src="{{ asset('js/validation_profile.js') }}"></script>
