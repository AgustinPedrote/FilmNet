 <!-- Ventana modal para editar un audiovisual -->
 <div id="ElencoModal{{ $audiovisual }}" tabindex="-1" aria-hidden="true"
     class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
     <div class="relative w-full max-w-7xl mx-auto">
         <!-- Modal content -->
         <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
             <!-- Modal header -->
             <div class="flex items-start justify-between p-1 border-b rounded-t dark:border-gray-600 bg-blue-500">
                 <button type="button"
                     class="text-white bg-transparent  hover:text-gray-100 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:text-white"
                     data-modal-hide="ElencoModal{{ $audiovisual }}">
                     <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                         viewBox="0 0 14 14">
                         <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                             d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                     </svg>
                     <span class="sr-only">Close modal</span>
                 </button>
             </div>

             <!-- Modal body -->
             <form id="formularioEdit" action="{{ route('audiovisuales.update', $audiovisual) }}" method="POST"
                 class="max-w-7xl w-full" enctype="multipart/form-data">
                 @method('put')
                 @csrf

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
                                 <div class="flex items-center">
                                     <input {{-- id="search_director_{{ $audiovisual->id }}" --}}
                                         class="block w-full border-blue-500 focus:border-blue-600 focus:ring-blue-500 rounded-md shadow-sm"
                                         type="text" name="search_director" placeholder="Buscar director..." />
                                     <button type="button" {{-- onclick="buscarDirector('{{ $audiovisual->id }}')" --}}
                                         class="px-4 py-2 ml-4 cursor-pointer bg-green-500 border border-green-600 hover:bg-green-600 text-white rounded-md font-semibold focus:outline-none focus:shadow-outline-green active:bg-green-600">
                                         Buscar
                                     </button>
                                 </div>

                                 <!-- Lista de resultados de la búsqueda -->
                                 <ul {{-- id="audiovisualResults_{{ $audiovisual->id }}" --}}
                                     class="mt-2 space-y-2 cursor-pointer divide-y divide-gray-300 overflow-y-auto max-h-52">
                                 </ul>
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
                                 <div class="flex items-center">
                                     <input {{-- id="search_compositor_{{ $premio->id }}" --}} {{-- value="{{ $premio->audiovisual->titulo }}" --}}
                                         class="block w-full border-blue-500 focus:border-blue-600 focus:ring-blue-500 rounded-md shadow-sm"
                                         type="text" name="search_compositor" placeholder="Buscar compositor..." />
                                     <button type="button" {{-- onclick="buscarAudiovisual('{{ $premio->id }}')" --}}
                                         class="px-4 py-2 ml-4 cursor-pointer bg-green-500 border border-green-600 hover:bg-green-600 text-white rounded-md font-semibold focus:outline-none focus:shadow-outline-green active:bg-green-600">
                                         Buscar
                                     </button>
                                 </div>

                                 <!-- Lista de resultados de la búsqueda -->
                                 <ul {{-- id="audiovisualResults_{{ $premio->id }}" --}}
                                     class="mt-2 space-y-2 cursor-pointer divide-y divide-gray-300 overflow-y-auto max-h-52">
                                 </ul>
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

                                 <div class="flex items-center">
                                     <input
                                         class="block w-full border-blue-500 focus:border-blue-600 focus:ring-blue-500 rounded-md shadow-sm"
                                         type="text" name="search_fotografia" placeholder="Buscar fotografía..." />
                                     <button type="button"
                                         class="px-4 py-2 ml-4 cursor-pointer bg-green-500 border border-green-600 hover:bg-green-600 text-white rounded-md font-semibold focus:outline-none focus:shadow-outline-green active:bg-green-600">
                                         Buscar
                                     </button>
                                 </div>

                                 <!-- Lista de resultados de la búsqueda -->
                                 <ul {{-- id="audiovisualResults_{{ $premio->id }}" --}}
                                     class="mt-2 space-y-2 cursor-pointer divide-y divide-gray-300 overflow-y-auto max-h-52">
                                 </ul>
                             </div>
                         </div>

                         <!-- Columna 2 -->
                         <div>
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
                                 <div class="flex items-center">
                                     <input {{-- id="search_audiovisual_{{ $premio->id }}" --}} {{-- value="{{ $premio->audiovisual->titulo }}" --}}
                                         class="block w-full border-blue-500 focus:border-blue-600 focus:ring-blue-500 rounded-md shadow-sm"
                                         type="text" name="search_guionista" placeholder="Buscar guionista..." />
                                     <button type="button" {{-- onclick="buscarAudiovisual('{{ $premio->id }}')" --}}
                                         class="px-4 py-2 ml-4 cursor-pointer bg-green-500 border border-green-600 hover:bg-green-600 text-white rounded-md font-semibold focus:outline-none focus:shadow-outline-green active:bg-green-600">
                                         Buscar
                                     </button>
                                 </div>

                                 <!-- Lista de resultados de la búsqueda -->
                                 <ul {{-- id="audiovisualResults_{{ $premio->id }}" --}}
                                     class="mt-2 space-y-2 cursor-pointer divide-y divide-gray-300 overflow-y-auto max-h-52">
                                 </ul>
                             </div>

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

                                 <div class="flex items-center">
                                     <input {{-- id="search_audiovisual_{{ $premio->id }}" --}} {{-- value="{{ $premio->audiovisual->titulo }}" --}}
                                         class="block w-full border-blue-500 focus:border-blue-600 focus:ring-blue-500 rounded-md shadow-sm"
                                         type="text" name="search_reparto" placeholder="Buscar reparto..." />
                                     <button type="button" {{-- onclick="buscarAudiovisual('{{ $premio->id }}')" --}}
                                         class="px-4 py-2 ml-4 cursor-pointer bg-green-500 border border-green-600 hover:bg-green-600 text-white rounded-md font-semibold focus:outline-none focus:shadow-outline-green active:bg-green-600">
                                         Buscar
                                     </button>
                                 </div>

                                 <!-- Lista de resultados de la búsqueda -->
                                 <ul {{-- id="audiovisualResults_{{ $premio->id }}" --}}
                                     class="mt-2 space-y-2 cursor-pointer divide-y divide-gray-300 overflow-y-auto max-h-52">
                                 </ul>
                             </div>

                             <!-- Nuevo campo de búsqueda para Género -->
                             <div class="mb-6">

                                 <x-input-label for="search_genero" :value="__('Género:')"
                                     class="block text-xl font-bold text-gray-900 dark:text-white mt-2" />
                                 @if ($audiovisual->generos->isNotEmpty())
                                     <label for="nombre"
                                         class="block text-base font-medium text-gray-600">{{ implode(', ', $audiovisual->generos->pluck('nombre')->toArray()) }}</label>
                                 @else
                                     <label for="nombre" class="block text-base font-medium text-gray-600">
                                         Ningún género asignado
                                     </label>
                                 @endif
                                 <div class="flex items-center">
                                     <input {{-- id="search_audiovisual_{{ $premio->id }}" --}} {{-- value="{{ $premio->audiovisual->titulo }}" --}}
                                         class="block w-full border-blue-500 focus:border-blue-600 focus:ring-blue-500 rounded-md shadow-sm"
                                         type="text" name="search_genero" placeholder="Buscar género..." />
                                     <button type="button" {{-- onclick="buscarAudiovisual('{{ $premio->id }}')" --}}
                                         class="px-4 py-2 ml-4 cursor-pointer bg-green-500 border border-green-600 hover:bg-green-600 text-white rounded-md font-semibold focus:outline-none focus:shadow-outline-green active:bg-green-600">
                                         Buscar
                                     </button>
                                 </div>

                                 <!-- Lista de resultados de la búsqueda -->
                                 <ul {{-- id="audiovisualResults_{{ $premio->id }}" --}}
                                     class="mt-2 space-y-2 cursor-pointer divide-y divide-gray-300 overflow-y-auto max-h-52">
                                 </ul>
                             </div>
                         </div>
                     </div>
                 </div>


                 <!-- Modal footer -->
                 <div
                     class="flex items-center justify-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                     <!-- Botón "Crear" -->
                     {{-- <input type="hidden" name="audiovisual_" class="audiovisual_{{ $audiovisual->id }}"> --}}
                     <button type="submit"
                         class="cursor-pointer bg-blue-500 border border-blue-600 hover:bg-blue-600 text-white rounded-md  px-4 py-2 font-semibold focus:outline-none focus:shadow-outline-blue active:bg-blue-600">
                         Guardar
                     </button>

                     <!-- Espacio entre botones -->
                     <div class="w-4"></div>

                     <!-- Botón "Cancelar" -->
                     <button data-modal-hide="ElencoModal{{ $audiovisual }}" type="button"
                         class="cursor-pointer bg-red-500 border border-red-600 hover:bg-red-600 text-white rounded-md px-4 py-2 font-semibold focus:outline-none focus:shadow-outline-red active:bg-red-600">
                         Cancelar
                     </button>
                 </div>
             </form>
         </div>
     </div>
 </div>
