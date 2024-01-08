<x-app-layout>
    <!-- Título de Novedades -->
    <h1 class="text-3xl font-extrabold text-center">
        <span class="relative inline-block rounded-lg overflow-hidden">
            <span class="absolute inset-0 bg-gradient-to-r from-blue-500 to-blue-500 border border-blue-600"></span>
            <span class="relative text-white z-10 p-4">Novedades</span>
        </span>
    </h1>

    <h1 class="text-2xl font-bold mb-6 mt-12 ml-10 border-b-2 border-blue-500 w-11/12 pb-2 text-gray-800">
        Documentales
    </h1>

    <div
        class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6 justify-center mx-auto">
        @foreach ($documentales as $documental)
            <a href="{{ route('audiovisual.show', $documental) }}"
                class="group p-4 transition duration-300 ease-in-out transform hover:scale-105">
                <div class="relative w-full h-64 overflow-hidden rounded-md shadow-md">
                    <img src="{{ $documental->img }}" alt="{{ $documental->titulo }}"
                        class="object-cover w-full h-full transition duration-300 ease-in-out transform scale-100 group-hover:scale-110" />
                </div>

                <div class="mt-3 text-center">
                    <div class="text-lg font-semibold text-gray-800">{{ $documental->titulo }}</div>
                </div>
            </a>
        @endforeach
    </div>

    <div class="mt-6 mb-10">
        {{ $documentales->links() }}
    </div>
</x-app-layout>
