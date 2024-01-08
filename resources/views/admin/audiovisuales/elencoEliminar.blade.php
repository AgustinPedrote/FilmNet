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
                         <!-- Titulo del audiovisual -->
                         <div class="mb-11">
                             <div>
                                 <a href="{{ route('audiovisual.show', ['audiovisual' => $audiovisual]) }}"
                                     class="text-blue-500 hover:text-blue-600 block text-2xl font-bold dark:text-white mt-2">
                                     {{ $audiovisual->titulo }}
                                 </a>
                             </div>
                         </div>

                         <!-- Botón para eliminar directores -->
                         <div class="mb-6">
                             <x-input-label for="eliminar_director" :value="__('Eliminar Director:')"
                                 class="block text-xl font-bold text-gray-900 dark:text-white mt-2" />

                             @if ($audiovisual->directores->isNotEmpty())
                                 <ul class="flex flex-wrap">
                                     @foreach ($audiovisual->directores as $director)
                                         <li class="mr-2 mb-2">
                                             <form
                                                 action="{{ route('audiovisuales.eliminarDirector', ['audiovisual' => $audiovisual->id, 'director' => $director->id]) }}"
                                                 method="post">
                                                 @csrf
                                                 @method('DELETE')
                                                 <button type="submit"
                                                     class="text-red-500 hover:text-red-600 focus:outline-none flex items-center bg-red-100 dark:bg-red-800 rounded p-2">
                                                     <span class="mr-2">{{ $director->nombre }}</span>
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
                                 <p class="text-gray-600">Ningún director asignado</p>
                             @endif
                         </div>

                         <!-- Botón para eliminar compositores -->
                         <div class="mb-6">
                             <x-input-label for="search_compositor" :value="__('Compositor:')"
                                 class="block text-xl font-bold text-gray-900 dark:text-white mt-2" />

                             @if ($audiovisual->compositores->isNotEmpty())
                                 <ul class="flex flex-wrap">
                                     @foreach ($audiovisual->compositores as $compositor)
                                         <li class="mr-2 mb-2">
                                             <form
                                                 action="{{ route('audiovisuales.eliminarCompositor', ['audiovisual' => $audiovisual->id, 'compositor' => $compositor->id]) }}"
                                                 method="post">
                                                 @csrf
                                                 @method('DELETE')
                                                 <button type="submit"
                                                     class="text-red-500 hover:text-red-600 focus:outline-none flex items-center bg-red-100 dark:bg-red-800 rounded p-2">
                                                     <span class="mr-2">{{ $compositor->nombre }}</span>
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
                                 <p class="text-gray-600">Ningún compositor asignado</p>
                             @endif
                         </div>

                         <!-- Botón para eliminar directores de fotografía -->
                         <div class="mb-6">
                             <x-input-label for="search_fotografia" :value="__('Fotografía:')"
                                 class="block text-xl font-bold text-gray-900 dark:text-white mt-2" />

                             @if ($audiovisual->fotografias->isNotEmpty())
                                 <ul class="flex flex-wrap">
                                     @foreach ($audiovisual->fotografias as $fotografia)
                                         <li class="mr-2 mb-2">
                                             <form
                                                 action="{{ route('audiovisuales.eliminarFotografia', ['audiovisual' => $audiovisual->id, 'fotografia' => $fotografia->id]) }}"
                                                 method="post">
                                                 @csrf
                                                 @method('DELETE')
                                                 <button type="submit"
                                                     class="text-red-500 hover:text-red-600 focus:outline-none flex items-center bg-red-100 dark:bg-red-800 rounded p-2">
                                                     <span class="mr-2">{{ $fotografia->nombre }}</span>
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
                                 <p class="text-gray-600">Ningún director de fotografía asignado</p>
                             @endif
                         </div>
                     </div>

                     <!-- Columna 2 -->
                     <div>
                         <!-- Botón para eliminar guionistas -->
                         <div class="mb-6">
                             <x-input-label for="search_guionista" :value="__('Guionista:')"
                                 class="block text-xl font-bold text-gray-900 dark:text-white mt-2" />

                             @if ($audiovisual->guionistas->isNotEmpty())
                                 <ul class="flex flex-wrap">
                                     @foreach ($audiovisual->guionistas as $guionista)
                                         <li class="mr-2 mb-2">
                                             <form
                                                 action="{{ route('audiovisuales.eliminarGuionista', ['audiovisual' => $audiovisual->id, 'guionista' => $guionista->id]) }}"
                                                 method="post">
                                                 @csrf
                                                 @method('DELETE')
                                                 <button type="submit"
                                                     class="text-red-500 hover:text-red-600 focus:outline-none flex items-center bg-red-100 dark:bg-red-800 rounded p-2">
                                                     <span class="mr-2">{{ $guionista->nombre }}</span>
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
                                 <p class="text-gray-600">Ningún guionista asignado</p>
                             @endif
                         </div>

                         <!-- Botón para eliminar actores y actrices -->
                         <div class="mb-6">
                             <x-input-label for="search_reparto" :value="__('Reparto:')"
                                 class="block text-xl font-bold text-gray-900 dark:text-white mt-2" />

                             @if ($audiovisual->repartos->isNotEmpty())
                                 <ul class="flex flex-wrap">
                                     @foreach ($audiovisual->repartos as $reparto)
                                         <li class="mr-2 mb-2">
                                             <form
                                                 action="{{ route('audiovisuales.eliminarReparto', ['audiovisual' => $audiovisual->id, 'reparto' => $reparto->id]) }}"
                                                 method="post">
                                                 @csrf
                                                 @method('DELETE')
                                                 <button type="submit"
                                                     class="text-red-500 hover:text-red-600 focus:outline-none flex items-center bg-red-100 dark:bg-red-800 rounded p-2">
                                                     <span class="mr-2">{{ $reparto->nombre }}</span>
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
                                 <p class="text-gray-600">Ningún actor/actriz asignado</p>
                             @endif
                         </div>

                         <!-- Botón para eliminar compañías -->
                         <div class="mb-6">
                             <x-input-label for="eliminar_compania" :value="__('Eliminar Compañía:')"
                                 class="block text-xl font-bold text-gray-900 dark:text-white mt-2" />

                             @if ($audiovisual->companies->isNotEmpty())
                                 <ul class="flex flex-wrap">
                                     @foreach ($audiovisual->companies as $company)
                                         <li class="mr-2 mb-2">
                                             <form
                                                 action="{{ route('audiovisuales.eliminarCompania', ['audiovisual' => $audiovisual->id, 'company' => $company->id]) }}"
                                                 method="post">
                                                 @csrf
                                                 @method('DELETE')
                                                 <button type="submit"
                                                     class="text-red-500 hover:text-red-600 focus:outline-none flex items-center bg-red-100 dark:bg-red-800 rounded p-2">
                                                     <span class="mr-2">{{ $company->nombre }}</span>
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
                                 <p class="text-gray-600">Ninguna compañía asignada</p>
                             @endif
                         </div>

                         <!-- Botón para eliminar géneros -->
                         <div class="mb-6">
                             <x-input-label for="eliminar_genero" :value="__('Eliminar Género:')"
                                 class="block text-xl font-bold text-gray-900 dark:text-white mt-2" />

                             @if ($audiovisual->generos->isNotEmpty())
                                 <ul class="flex flex-wrap">
                                     @foreach ($audiovisual->generos as $genero)
                                         <li class="mr-2 mb-2">
                                             <form
                                                 action="{{ route('audiovisuales.eliminarGenero', ['audiovisual' => $audiovisual->id, 'genero' => $genero->id]) }}"
                                                 method="post">
                                                 @csrf
                                                 @method('DELETE')
                                                 <button type="submit"
                                                     class="text-red-500 hover:text-red-600 focus:outline-none flex items-center bg-red-100 dark:bg-red-800 rounded p-2">
                                                     <span class="mr-2">{{ $genero->nombre }}</span>
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
                                 <p class="text-gray-600">Ningún género asignado</p>
                             @endif
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>
