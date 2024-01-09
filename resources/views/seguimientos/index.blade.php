<x-app-layout>
    <h1 class="text-2xl font-bold mb-6 mt-4 ml-10 border-b-2 border-blue-500 w-11/12 pb-2 text-gray-800">
        Lista de seguimiento
    </h1>

    @if ($seguimientosPaginados->isEmpty())
        <div class="text-gray-500 text-lg text-center mt-8 h-screen">
            <p>No hay seguimientos disponibles.</p>
        </div>
    @else
        <div
            class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6 justify-center mx-auto">
            @foreach ($seguimientosPaginados as $seguimiento)
                <a href="{{ route('audiovisual.show', $seguimiento) }}"
                    class="group p-4 transition duration-300 ease-in-out transform hover:scale-105">
                    <div class="relative w-full h-64 overflow-hidden rounded-md shadow-md">
                        <img src="{{ $seguimiento->img }}" alt="{{ $seguimiento->titulo }}"
                            class="object-cover w-full h-full transition duration-300 ease-in-out transform scale-100 group-hover:scale-110" />
                    </div>

                    <div class="mt-3 text-center">
                        <div class="text-lg font-semibold text-gray-800">{{ $seguimiento->titulo }}</div>
                    </div>
                </a>
            @endforeach
        </div>

        <!-- Botón para volver a la página anterior -->
        <div class="mt-6">
            <a href="#" onclick="goBack()" class="flex items-center ml-6">
                <span class="bottom-4 right-4 p-2 bg-blue-500 text-white rounded-full cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                        class="h-6 w-6">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                </span>
            </a>
        </div>

        <script>
            function goBack() {
                window.history.back();
            }
        </script>

        <!-- paginación -->
        <div class="mx-6 mt-4 mb-10">
            {{ $seguimientosPaginados->appends(request()->query())->links() }}
        </div>
    @endif
</x-app-layout>
