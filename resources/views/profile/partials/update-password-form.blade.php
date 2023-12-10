 <section>
     <header>
         <h2 class="text-lg font-medium text-gray-900">
             {{ __('Actualizar contraseña') }}
         </h2>

         <p class="mt-1 text-sm text-gray-600">
             {{ __('Asegúrese de que su cuenta utilice una contraseña larga y aleatoria para mantenerse segura.') }}
         </p>
     </header>

     <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6" id="updatePasswordForm">
         @csrf
         @method('put')

         <!-- Contraseña actual -->
         <div>
             <x-input-label for="current_password" :value="__('Contraseña actual')" />
             <x-text-input id="current_password" name="current_password" type="password" class="mt-1 block w-full"
                 autocomplete="current-password" />
             <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
         </div>

         <!-- Nueva contraseña -->
         <div>
             <x-input-label for="password" :value="__('Nueva contraseña')" />
             <x-text-input id="password" name="password" type="password" class="mt-1 block w-full"
                 autocomplete="new-password" />
             <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
         </div>

         <!-- Confirmar contraseña -->
         <div>
             <x-input-label for="password_confirmation" :value="__('Confirmar contraseña')" />
             <x-text-input id="password_confirmation" name="password_confirmation" type="password"
                 class="mt-1 block w-full" autocomplete="new-password" />
             <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
         </div>

         <!-- Botón de guardar -->
         <div class="flex items-center gap-4">
             <x-primary-button id="saveButton">{{ __('Guardar') }}</x-primary-button>

             @if (session('status') === 'password-updated')
                 <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                     class="text-sm text-gray-600">
                     {{ __('Saved.') }}
                 </p>
             @endif
         </div>
     </form>

     <!-- Agregar la referencia al archivo de script de validación de contraseña -->
     <script src="{{ asset('js/validation_password.js') }}"></script>
 </section>
