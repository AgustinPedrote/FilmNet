{{-- Ventana modal para borrar al user --}}
<div id="popup-modal{{ $user }}" tabindex="-1"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 md:inset-0 h-modal md:h-full">
    <div class="relative p-4 w-full max-w-md h-full md:h-auto">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700 ">

            <button type="button"
                class="absolute top-3 right-2.5 text-black bg-transparent  hover:text-gray-500 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white"
                data-modal-toggle="popup-modal{{ $user }}">
                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                        clip-rule="evenodd"></path>
                </svg>
                <span class="sr-only">Cerrar ventana</span>
            </button>

            <div class="p-6 text-center">
                <svg aria-hidden="true" class="mx-auto mb-4 w-14 h-14 text-gray-400 dark:text-gray-200" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>

                <h3 class="mb-5 text-lg font-normal text-black  dark:text-gray-900">
                    ¿Seguro que deseas borrar este usuario?
                </h3>

                <form
                    action="{{ route('users.destroy', $user) }}"
                    method="POST" class="inline">
                    @method('DELETE')
                    @csrf

                    <button data-modal-toggle="popup-modal{{ $user }}" type="submit"
                        class="px-4 py-2 bg-red-500 border border-red-600 text-white rounded-md hover:bg-red-600 focus:outline-none focus:shadow-outline-red active:bg-red-600 mx-auto font-semibold">
                        Sí, seguro
                    </button>

                    <button data-modal-toggle="popup-modal{{ $user }}" type="button"
                        class="px-4 py-2 bg-white border border-gray-600 text-gray-900 rounded-md hover:bg-gray-400 focus:outline-none focus:shadow-outline-red active:bg-gray-400 mx-auto font-semibold">
                        No, cancelar
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
