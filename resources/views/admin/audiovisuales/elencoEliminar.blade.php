 <!-- Ventana modal para editar un audiovisual -->
 <div id="ElencoEliminar{{ $audiovisualId }}" tabindex="-1" aria-hidden="true"
     class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
     <div class="relative w-full max-w-7xl mx-auto">
         <!-- Modal content -->
         <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
             <!-- Modal header -->
             <div class="flex items-start justify-between p-1 border-b rounded-t dark:border-gray-600 bg-blue-500">
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

             <div class="p-8 space-y-5">
                 <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                     <!-- Columna 1 -->
                     <div>
                         <!-- Nuevo campo de búsqueda para Director -->
                         <div class="mb-6">

                             <x-input-label for="search_director" :value="__('Director:')"
                                 class="block text-xl font-bold text-gray-900 dark:text-white mt-2" />
                             @if ($audiovisual->directores->isNotEmpty())
                                 <label for="nombre"
                                     class="block text-base font-medium text-gray-600">{{ implode(', ', $audiovisual->directores->pluck('nombre')->toArray()) }}</label>
                             @else
                                 <label for="nombre" class="block text-base font-medium text-gray-600">
                                     Ningún director asignado
                                 </label>
                             @endif

                         </div>

                         <!-- Nuevo campo de búsqueda para Compositor -->
                         <div class="mb-6">

                             <x-input-label for="search_compositor" :value="__('Compositor:')"
                                 class="block text-xl font-bold text-gray-900 dark:text-white mt-2" />
                             @if ($audiovisual->compositores->isNotEmpty())
                                 <label for="nombre"
                                     class="block text-base font-medium text-gray-600">{{ implode(', ', $audiovisual->compositores->pluck('nombre')->toArray()) }}</label>
                             @else
                                 <label for="nombre" class="block text-base font-medium text-gray-600">
                                     Ningún compositor asignado
                                 </label>
                             @endif

                         </div>

                         <!-- Nuevo campo de búsqueda para Fotografía -->
                         <div class="mb-6">
                             <x-input-label for="search_fotografia" :value="__('Fotografía:')"
                                 class="block text-xl font-bold text-gray-900 dark:text-white mt-2" />

                             @if ($audiovisual->fotografias->isNotEmpty())
                                 <label for="nombre"
                                     class="block text-base font-medium text-gray-600">{{ implode(', ', $audiovisual->fotografias->pluck('nombre')->toArray()) }}</label>
                             @else
                                 <label for="nombre" class="block text-base font-medium text-gray-600">
                                     Ningún director de fotografía asignado
                                 </label>
                             @endif


                         </div>

                         <!-- Nuevo campo de búsqueda para Guionista -->
                         <div class="mb-6">

                             <x-input-label for="search_guionista" :value="__('Guionista:')"
                                 class="block text-xl font-bold text-gray-900 dark:text-white mt-2" />
                             @if ($audiovisual->guionistas->isNotEmpty())
                                 <label for="nombre"
                                     class="block text-base font-medium text-gray-600">{{ implode(', ', $audiovisual->guionistas->pluck('nombre')->toArray()) }}</label>
                             @else
                                 <label for="nombre" class="block text-base font-medium text-gray-600">
                                     Ningún guionista asignado
                                 </label>
                             @endif

                         </div>
                     </div>

                     <!-- Columna 2 -->
                     <div>
                         <!-- Nuevo campo de búsqueda para Reparto -->
                         <div class="mb-6">

                             <x-input-label for="search_reparto" :value="__('Reparto:')"
                                 class="block text-xl font-bold text-gray-900 dark:text-white mt-2" />
                             @if ($audiovisual->repartos->isNotEmpty())
                                 <label for="nombre"
                                     class="block text-base font-medium text-gray-600">{{ implode(', ', $audiovisual->repartos->pluck('nombre')->toArray()) }}</label>
                             @else
                                 <label for="nombre" class="block text-base font-medium text-gray-600">
                                     Ningún actor/actriz asignado
                                 </label>
                             @endif


                         </div>

                         <!-- Nuevo campo de búsqueda para Compañía -->
                         <div class="mb-6">

                             <x-input-label for="search_company" :value="__('Compañía:')"
                                 class="block text-xl font-bold text-gray-900 dark:text-white mt-2" />
                             @if ($audiovisual->companies->isNotEmpty())
                                 <label for="nombre"
                                     class="block text-base font-medium text-gray-600">{{ implode(', ', $audiovisual->companies->pluck('nombre')->toArray()) }}</label>
                             @else
                                 <label for="nombre" class="block text-base font-medium text-gray-600">
                                     Ninguna compañía asignada
                                 </label>
                             @endif


                         </div>

                         <!-- Agrega el botón para eliminar géneros en el modal -->
                         <div class="mb-6">
                             <x-input-label for="eliminar_genero" :value="__('Eliminar Género:')"
                                 class="block text-xl font-bold text-gray-900 dark:text-white mt-2" />

                             @if ($audiovisual->generos->isNotEmpty())
                                 <ul>
                                     @foreach ($audiovisual->generos as $genero)
                                         <li>
                                             <form
                                                 action="{{ route('audiovisuales.eliminarGenero', ['audiovisual' => $audiovisual->id, 'genero' => $genero->id]) }}"
                                                 method="post">
                                                 @csrf
                                                 @method('DELETE')
                                                 <button type="submit"
                                                     class="text-red-500 hover:text-red-600 focus:outline-none">
                                                     {{ $genero->nombre }}
                                                 </button>
                                             </form>
                                         </li>
                                     @endforeach
                                 </ul>
                             @else
                                 <label for="nombre" class="block text-base font-medium text-gray-600">
                                     Ningún género asignado
                                 </label>
                             @endif
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>
