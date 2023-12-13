 <!-- Ventana modal para editar un premio -->
 <div id="EditarModal{{ $premio }}" tabindex="-1" aria-hidden="true"
     class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
     <div class="relative w-full max-w-2xl mx-auto">
         <!-- Modal content -->
         <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
             <!-- Modal header -->
             <div class="flex items-start justify-between p-1 border-b rounded-t dark:border-gray-600 bg-blue-500">
                 <button type="button"
                     class="text-white bg-transparent  hover:text-gray-100 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:text-white"
                     data-modal-hide="EditarModal{{ $premio }}">
                     <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                         viewBox="0 0 14 14">
                         <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                             d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                     </svg>
                     <span class="sr-only">Close modal</span>
                 </button>
             </div>

             <!-- Modal body -->
             <form action="{{ route('premios.update', $premio) }}" method="POST">
                 @method('put')
                 @csrf
                 <div class="p-6 space-y-6">
                     <div class="mb-6">
                         <x-input-label for="nombre" :value="__('Nombre')"
                             class="block mb-2 text-xl font-bold text-gray-900 dark:text-white" />
                         <x-text-input id="nombre" class="block mt-1 w-full text-md" type="text" name="nombre"
                             value="{{ $premio->nombre }}" required autofocus autocomplete="nombre" />
                         <x-input-error :messages="$errors->get('premio')" class="mt-2" />

                         <x-input-label for="year" :value="__('Año')"
                             class="block mb-2 text-xl font-bold text-gray-900 dark:text-white" />
                         <x-text-input id="year" class="block mt-1 w-full text-md" type="text" name="year"
                             value="{{ $premio->year }}" required autofocus autocomplete="year" />
                         <x-input-error :messages="$errors->get('premio')" class="mt-2" />

                         <x-input-label for="audiovisual" :value="__('Audiovisual')"
                             class="block mb-2 text-xl font-bold text-gray-900 dark:text-white" />
                         <x-text-input id="audiovisual" class="block mt-1 w-full text-md" type="text" name="audiovisual"
                             value="{{ $premio->audiovisual->titulo }}" required autofocus autocomplete="year" />
                         <x-input-error :messages="$errors->get('premio')" class="mt-2" />
                     </div>

                     @error('nombre')
                         <br>
                         <small>*{{ $message }}</small>
                         <br>
                     @enderror
                 </div>

                 <!-- Modal footer -->
                 <div
                     class="flex items-center justify-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                     <!-- Botón "Crear" -->
                     <button type="submit"
                         class="cursor-pointer bg-blue-500 border border-blue-600 hover:bg-blue-600 text-white rounded-md  px-4 py-2 font-semibold focus:outline-none focus:shadow-outline-blue active:bg-blue-600">
                         Guardar
                     </button>

                     <!-- Espacio entre botones -->
                     <div class="w-4"></div>

                     <!-- Botón "Cancelar" -->
                     <button data-modal-hide="EditarModal{{ $premio }}" type="button"
                         class="cursor-pointer bg-blue-500 border border-blue-600 hover:bg-blue-600 text-white rounded-md px-4 py-2 font-semibold focus:outline-none focus:shadow-outline-blue active:bg-blue-600">
                         Cancelar
                     </button>
                 </div>
             </form>
         </div>
     </div>
 </div>
