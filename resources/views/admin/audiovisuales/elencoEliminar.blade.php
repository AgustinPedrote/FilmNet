 <!-- Ventana modal para editar un audiovisual -->
 <div id="ElencoEliminar{{ $audiovisualId }}" tabindex="-1" aria-hidden="true"
     class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
     <div class="relative w-full max-w-7xl mx-auto">
         <!-- Modal content -->
         <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">

             <!-- Modal header -->
             <div class="flex items-start justify-between p-1 border-b rounded-t dark:border-gray-600 bg-gray-700">
                 <!-- Botón para cerrar el modal -->
                 <button type="button"
                     class="text-white bg-transparent  hover:text-gray-100 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:text-white"
                     data-modal-hide="ElencoEliminar{{ $audiovisualId }}">
                     <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                         viewBox="0 0 14 14">
                         <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                             d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                     </svg>
                     <span class="sr-only">Close modal</span>
                 </button>
             </div>

             <!-- Modal Content -->
             <div class="p-8 space-y-5">
                 <div class="grid grid-cols-1 md:grid-cols-2 md:gap-8">
                     <!-- COLUMNA 1 -->
                     <div>

                         <!-- Titulo del audiovisual -->
                         <div class="mb-2 md:mb-5 p-2">
                             <div>
                                 <a href="{{ route('audiovisual.show', ['audiovisual' => $audiovisual]) }}"
                                     class="text-gray-700 hover:text-gray-900 block text-xl md:text-2xl font-bold dark:text-white mt-3 mb-3 border-b-2 border-blue-500">
                                     {{ $audiovisual->titulo }}
                                 </a>

                                 <div class="flex items-center justify-between text-gray-600 dark:text-gray-400 text-sm md:text-base"">
                                     <span>
                                         Tipo: {{ $audiovisual->tipo->nombre }}
                                     </span>

                                     <!-- Enlace para eliminar todo el elenco y equipo -->
                                     <a href="#" onclick="confirmarEliminarTodo('{{ $audiovisualId }}')"
                                         class="text-red-600 hover:text-red-700 font-semibold focus:outline-none active:text-red-700">
                                         (Eliminar todo)
                                     </a>
                                 </div>
                             </div>
                         </div>

                         <!-- Botón para eliminar directores -->
                         <div class="mb-1 md:mb-4 p-1 md:p-2 border border-gray-300 rounded shadow-md" style="min-height: 100px;">
                             <x-input-label for="eliminar_director" :value="__('Eliminar Director:')"
                                 class="block text-lg md:text-xl font-bold text-gray-900 dark:text-white mt-2 mb-2" />

                             @if ($audiovisual->directores->isNotEmpty())
                                 <ul class="flex flex-wrap">
                                     @foreach ($audiovisual->directores as $director)
                                         <li class="mr-2 mb-2">
                                             <!-- Formulario para eliminar director -->
                                             <form action="javascript:void(0)"
                                                 onsubmit="eliminarRelacion('{{ $audiovisual->id }}', 'directores', '{{ $director->id }}', this.parentElement); return false;">
                                                 @csrf
                                                 @method('DELETE')

                                                 <!-- Botón de eliminar con nombre del director y ícono -->
                                                 <button type="submit"
                                                     class="text-red-500 hover:text-red-600 focus:outline-none flex items-center bg-red-100 dark:bg-red-800 rounded p-1">
                                                     <span class="mr-2 text-sm md:text-base">{{ $director->nombre }}</span>
                                                     <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                         viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                         <path stroke-linecap="round" stroke-linejoin="round"
                                                             stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                     </svg>
                                                 </button>
                                             </form>
                                         </li>
                                     @endforeach
                                 </ul>
                             @else
                                 <p class="text-gray-600 mt-3 mb-3">Ningún director asignado</p>
                             @endif
                         </div>

                         <!-- Botón para eliminar compositores -->
                         <div class="mb-1 md:mb-4 p-1 md:p-2 border border-gray-300 rounded shadow-md" style="min-height: 100px;">
                             <x-input-label for="search_compositor" :value="__('Eliminar Compositor:')"
                                 class="block text-lg md:text-xl font-bold text-gray-900 dark:text-white mt-2 mb-2" />

                             @if ($audiovisual->compositores->isNotEmpty())
                                 <ul class="flex flex-wrap">
                                     @foreach ($audiovisual->compositores as $compositor)
                                         <li class="mr-2 mb-2">
                                             <!-- Formulario para eliminar compositores -->
                                             <form action="javascript:void(0)"
                                                 onsubmit="eliminarRelacion('{{ $audiovisual->id }}', 'compositores', '{{ $compositor->id }}', this.parentElement); return false;">
                                                 @csrf
                                                 @method('DELETE')

                                                 <!-- Botón de eliminar con nombre del compositor y ícono -->
                                                 <button type="submit"
                                                     class="text-red-500 hover:text-red-600 focus:outline-none flex items-center bg-red-100 dark:bg-red-800 rounded p-1">
                                                     <span class="mr-2 text-sm md:text-base">{{ $compositor->nombre }}</span>
                                                     <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                         viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                         <path stroke-linecap="round" stroke-linejoin="round"
                                                             stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                     </svg>
                                                 </button>
                                             </form>
                                         </li>
                                     @endforeach
                                 </ul>
                             @else
                                 <p class="text-gray-600 mt-3 mb-3">Ningún compositor asignado</p>
                             @endif
                         </div>

                         <!-- Botón para eliminar directores de fotografía -->
                         <div class="mb-1 md:mb-4 p-1 md:p-2 border border-gray-300 rounded shadow-md" style="min-height: 100px;">
                             <x-input-label for="search_fotografia" :value="__('Eliminar Fotografía:')"
                                 class="block text-lg md:text-xl font-bold text-gray-900 dark:text-white mt-2 mb-2" />

                             @if ($audiovisual->fotografias->isNotEmpty())
                                 <ul class="flex flex-wrap">
                                     @foreach ($audiovisual->fotografias as $fotografia)
                                         <li class="mr-2 mb-2">
                                             <!-- Formulario para eliminar directores de fotografía -->
                                             <form action="javascript:void(0)"
                                                 onsubmit="eliminarRelacion('{{ $audiovisual->id }}', 'fotografias', '{{ $fotografia->id }}', this.parentElement); return false;">
                                                 @csrf
                                                 @method('DELETE')

                                                 <!-- Botón de eliminar con nombre del director de fotografía y ícono -->
                                                 <button type="submit"
                                                     class="text-red-500 hover:text-red-600 focus:outline-none flex items-center bg-red-100 dark:bg-red-800 rounded p-1">
                                                     <span class="mr-2 text-sm md:text-base">{{ $fotografia->nombre }}</span>
                                                     <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                         viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                         <path stroke-linecap="round" stroke-linejoin="round"
                                                             stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                     </svg>
                                                 </button>
                                             </form>
                                         </li>
                                     @endforeach
                                 </ul>
                             @else
                                 <p class="text-gray-600 mt-3 mb-3">Ningún director de fotografía asignado</p>
                             @endif
                         </div>

                     </div>

                     <!-- COLUMNA 2 -->
                     <div>

                         <!-- Botón para eliminar guionistas -->
                         <div class="mb-1 md:mb-4 p-1 md:p-2 border border-gray-300 rounded shadow-md" style="min-height: 100px;">
                             <x-input-label for="search_guionista" :value="__('Eliminar Guionista:')"
                                 class="block text-lg md:text-xl font-bold text-gray-900 dark:text-white mt-2 mb-2" />

                             @if ($audiovisual->guionistas->isNotEmpty())
                                 <ul class="flex flex-wrap">
                                     @foreach ($audiovisual->guionistas as $guionista)
                                         <li class="mr-2 mb-2">
                                             <!-- Formulario para eliminar guionistas -->
                                             <form action="javascript:void(0)"
                                                 onsubmit="eliminarRelacion('{{ $audiovisual->id }}', 'guionistas', '{{ $guionista->id }}', this.parentElement); return false;">
                                                 @csrf
                                                 @method('DELETE')

                                                 <!-- Botón de eliminar con nombre del guionista y ícono -->
                                                 <button type="submit"
                                                     class="text-red-500 hover:text-red-600 focus:outline-none flex items-center bg-red-100 dark:bg-red-800 rounded p-1">
                                                     <span class="mr-2 text-sm md:text-base">{{ $guionista->nombre }}</span>
                                                     <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                         viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                         <path stroke-linecap="round" stroke-linejoin="round"
                                                             stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                     </svg>
                                                 </button>
                                             </form>
                                         </li>
                                     @endforeach
                                 </ul>
                             @else
                                 <p class="text-gray-600 mt-3 mb-3">Ningún guionista asignado</p>
                             @endif
                         </div>

                         <!-- Botón para eliminar reparto -->
                         <div class="mb-1 md:mb-4 p-1 md:p-2 border border-gray-300 rounded shadow-md" style="min-height: 100px;">
                             <x-input-label for="search_reparto" :value="__('Eliminar Reparto:')"
                                 class="block text-lg md:text-xl font-bold text-gray-900 dark:text-white mt-2 mb-2" />

                             @if ($audiovisual->repartos->isNotEmpty())
                                 <ul class="flex flex-wrap">
                                     @foreach ($audiovisual->repartos as $reparto)
                                         <li class="mr-2 mb-2">
                                             <!-- Formulario para eliminar reparto -->
                                             <form action="javascript:void(0)"
                                                 onsubmit="eliminarRelacion('{{ $audiovisual->id }}', 'repartos', '{{ $reparto->id }}', this.parentElement); return false;">
                                                 @csrf
                                                 @method('DELETE')

                                                 <!-- Botón de eliminar con nombre del reparto y ícono -->
                                                 <button type="submit"
                                                     class="text-red-500 hover:text-red-600 focus:outline-none flex items-center bg-red-100 dark:bg-red-800 rounded p-1">
                                                     <span class="mr-2 text-sm md:text-base">{{ $reparto->nombre }}</span>
                                                     <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                         viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                         <path stroke-linecap="round" stroke-linejoin="round"
                                                             stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                     </svg>
                                                 </button>
                                             </form>
                                         </li>
                                     @endforeach
                                 </ul>
                             @else
                                 <p class="text-gray-600 mt-3 mb-3">Ningún actor/actriz asignado</p>
                             @endif
                         </div>

                         <!-- Botón para eliminar compañías -->
                         <div class="mb-1 md:mb-4 p-1 md:p-2 border border-gray-300 rounded shadow-md" style="min-height: 100px;">
                             <x-input-label for="eliminar_compania" :value="__('Eliminar Compañía:')"
                                 class="block text-lg md:text-xl font-bold text-gray-900 dark:text-white mt-2 mb-2" />

                             @if ($audiovisual->companies->isNotEmpty())
                                 <ul class="flex flex-wrap">
                                     @foreach ($audiovisual->companies as $company)
                                         <li class="mr-2 mb-2">
                                             <!-- Formulario para eliminar compañías -->
                                             <form action="javascript:void(0)"
                                                 onsubmit="eliminarRelacion('{{ $audiovisual->id }}', 'companies', '{{ $company->id }}', this.parentElement); return false;">
                                                 @csrf
                                                 @method('DELETE')

                                                 <!-- Botón de eliminar con nombre de la compañía y ícono -->
                                                 <button type="submit"
                                                     class="text-red-500 hover:text-red-600 focus:outline-none flex items-center bg-red-100 dark:bg-red-800 rounded p-1">
                                                     <span class="mr-2 text-sm md:text-base">{{ $company->nombre }}</span>
                                                     <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                         viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                         <path stroke-linecap="round" stroke-linejoin="round"
                                                             stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                     </svg>
                                                 </button>
                                             </form>
                                         </li>
                                     @endforeach
                                 </ul>
                             @else
                                 <p class="text-gray-600 mt-3 mb-3">Ninguna compañía asignada</p>
                             @endif
                         </div>

                         <!-- Botón para eliminar géneros -->
                         <div class="md:mb-4 p-1 md:p-2 border border-gray-300 rounded shadow-md" style="min-height: 100px;">
                             <x-input-label for="eliminar_genero" :value="__('Eliminar Género:')"
                                 class="block text-lg md:text-xl font-bold text-gray-900 dark:text-white mt-2 mb-2" />

                             @if ($audiovisual->generos->isNotEmpty())
                                 <ul class="flex flex-wrap">
                                     @foreach ($audiovisual->generos as $genero)
                                         <li class="mr-2 mb-2">
                                             <!-- Formulario para eliminar géneros -->
                                             <form action="javascript:void(0)"
                                                 onsubmit="eliminarRelacion('{{ $audiovisual->id }}', 'generos', '{{ $genero->id }}', this.parentElement); return false;">
                                                 @csrf
                                                 @method('DELETE')

                                                 <!-- Botón de eliminar con nombre del género y ícono -->
                                                 <button type="submit"
                                                     class="text-red-500 hover:text-red-600 focus:outline-none flex items-center bg-red-100 dark:bg-red-800 rounded p-1">
                                                     <span class="mr-2 text-sm md:text-base">{{ $genero->nombre }}</span>
                                                     <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                         viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                         <path stroke-linecap="round" stroke-linejoin="round"
                                                             stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                     </svg>
                                                 </button>
                                             </form>
                                         </li>
                                     @endforeach
                                 </ul>
                             @else
                                 <p class="text-gray-600 mt-3 mb-3">Ningún género asignado</p>
                             @endif
                         </div>

                     </div>
                 </div>
             </div>

             <!-- Modal footer -->
             <div
                 class="flex items-center justify-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">

                 <!-- Botón "Aceptar" -->
                 <button onclick="aceptarEliminarTodoElenco('{{ $audiovisualId }}')"
                     class="cursor-pointer bg-blue-500 border border-blue-600 hover:bg-blue-600 text-white rounded-md  px-4 py-2 font-semibold focus:outline-none focus:shadow-outline-blue active:bg-blue-600 text-xs md:text-base">
                     Aceptar
                 </button>

                 <!-- Espacio entre botones -->
                 <div class="w-4"></div>

                 <!-- Botón "Cancelar" -->
                 <button data-modal-hide="ElencoEliminar{{ $audiovisualId }}" type="button"
                     class="cursor-pointer bg-red-500 border border-red-600 hover:bg-red-600 text-white rounded-md px-4 py-2 font-semibold focus:outline-none focus:shadow-outline-red active:bg-red-600 text-xs md:text-base">
                     Cancelar
                 </button>
             </div>
         </div>
     </div>
 </div>

 <!-- Script para eliminar elenco -->
 <script src="{{ asset('js/elencoEliminar.js') }}"></script>
