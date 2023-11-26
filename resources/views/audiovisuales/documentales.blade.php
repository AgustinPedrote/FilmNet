<x-app-layout>
    <h1 class="text-2xl font-bold my-6 ml-10 border-b-2 border-blue-500 w-11/12 pb-2 text-gray-800">
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

    <div class="mt-4 mb-10">
        {{ $documentales->links() }}
    </div>
</x-app-layout>
