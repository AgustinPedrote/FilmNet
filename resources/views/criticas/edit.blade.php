 <!-- Ventana modal para editar un critica -->
 <div id="EditarModal{{ $critica }}" tabindex="-1" aria-hidden="true"
     class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
     <div class="relative w-full max-w-2xl mx-auto">
         <!-- Modal content -->
         <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
             <!-- Modal header -->
             <div class="flex items-start justify-between p-1 border-b rounded-t dark:border-gray-600 bg-blue-500">
                 <button type="button"
                     class="text-white bg-transparent  hover:text-gray-100 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:text-white"
                     data-modal-hide="EditarModal{{ $critica }}">
                     <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                         viewBox="0 0 14 14">
                         <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                             d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                     </svg>
                     <span class="sr-only">Close modal</span>
                 </button>
             </div>

             <!-- Modal body -->
             <form
                 action="{{ route('criticas.update', ['usuario_id' => $critica->user_id, 'audiovisual_id' => $critica->audiovisual_id]) }}"
                 method="POST"> @method('put')
                 @csrf
                 <div class="p-6 space-y-6">
                     <div class="mb-6">

                         <x-input-label for="critica" :value="__('Crítica')"
                             class="block mb-2 text-xl font-bold text-gray-900 dark:text-white" />

                         <textarea id="critica" class="block mt-1 w-full h-60 border-gray-300 rounded-md text-lg" name="critica" required
                             autofocus autocomplete="critica">{{ $critica->critica }}</textarea>


                         <x-input-error :messages="$errors->get('critica')" class="mt-2" />
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
                     <button data-modal-hide="EditarModal{{ $critica }}" type="button"
                         class="cursor-pointer bg-red-500 border border-red-600 hover:bg-red-600 text-white rounded-md px-4 py-2 font-semibold focus:outline-none focus:shadow-outline-red active:bg-red-600">
                         Cancelar
                     </button>
                 </div>
             </form>
         </div>
     </div>
 </div>
