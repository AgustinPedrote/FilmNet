@foreach ($items as $item)
    <a href="{{ route('audiovisual.show', $item) }}"
        class="group p-4 transition duration-300 ease-in-out transform hover:scale-105">

        <div class="relative w-full h-64 overflow-hidden rounded-md shadow-md">
            <img src="{{ asset($item->img) }}" alt="{{ $item->titulo }}"
                class="object-cover w-full h-full transition duration-300 ease-in-out transform scale-100 group-hover:scale-110" />
        </div>

        <div class="mt-3 text-center">
            <div class="text-lg font-semibold text-gray-800">{{ $item->titulo }}</div>
        </div>
    </a>
@endforeach
