<!-- Botón para agregar a la lista de seguimiento -->
@auth
    @if (auth()->user()->usuariosSeguimientos->contains('id', $audiovisual->id))
        <form id="comprobarForm" action="{{ route('quitar.seguimiento', $audiovisual) }}" method="POST">
            @method('DELETE')
            @csrf

            <button type="submit"
                class="flex items-center px-4 py-2  bg-blue-500 border border-blue-600 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:shadow-outline-blue active:bg-blue-600 mx-auto mt-4 font-semibold">
                <svg id="starIcon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="20" height="20"
                    fill="yellow" class="mr-2">
                    <path d="M0 0h24v24H0z" fill="none" />
                    <path d="M12 2l2.4 7.2h7.6l-6 4.8 2.4 7.2L12 15.6 4 21.2l2.4-7.2-6-4.8h7.6z" />
                </svg>
                Añadir a mi lista
            </button>
        </form>
    @else
        <form id="comprobarForm" action="{{ route('insert.seguimiento', $audiovisual) }}" method="post">
            @csrf
            <button type="submit"
                class="flex items-center px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 border-blue-600 focus:outline-none focus:shadow-outline-blue active:bg-blue-800 mx-auto mt-4 font-semibold">
                <svg id="starIcon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="20" height="20"
                    fill="white" class="mr-2">
                    <path d="M0 0h24v24H0z" fill="none" />
                    <path d="M12 2l2.4 7.2h7.6l-6 4.8 2.4 7.2L12 15.6 4 21.2l2.4-7.2-6-4.8h7.6z" />
                </svg>
                Añadir a mi lista
            </button>
        </form>
    @endif
@else
    <div class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 border-blue-600 focus:outline-none focus:shadow-outline-blue active:bg-blue-800 mx-auto mt-4 font-semibold"
        id="starButton">
        <!-- Cambiado el botón por un enlace -->
        <a href="{{ route('login') }}" style="display: flex; align-items: center; text-decoration: none; color: white;">
            <svg id="starIcon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="20" height="20"
                fill="currentColor" class="mr-2">
                <path d="M0 0h24v24H0z" fill="none" />
                <path d="M12 2l2.4 7.2h7.6l-6 4.8 2.4 7.2L12 15.6 4 21.2l2.4-7.2-6-4.8h7.6z" />
            </svg>
            Añadir a mi lista
        </a>
    </div>
@endauth
