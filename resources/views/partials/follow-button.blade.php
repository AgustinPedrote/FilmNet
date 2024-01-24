@auth
    <form id="toggleSeguimientoForm" action="{{ route('toggle.seguimiento') }}" method="post">
        @csrf
        <input type="hidden" name="audiovisual_id" value="{{ $audiovisual->id }}">
        <button type="button"
            class="toggleSeguimientoBtn flex items-center px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600 border-green-600 focus:outline-none focus:shadow-outline-green active:bg-green-800 mx-auto font-semibold"
            onclick="toggleSeguimiento()">
            <svg id="starIcon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="20" height="20"
                fill="{{ auth()->user()->usuariosSeguimientos->contains('id', $audiovisual->id)? 'yellow': 'white' }}"
                class="mr-2">
                <path d="M0 0h24v24H0z" fill="none" />
                <path d="M12 2l2.4 7.2h7.6l-6 4.8 2.4 7.2L12 15.6 4 21.2l2.4-7.2-6-4.8h7.6z" />
            </svg>
            <span>Quiero ver</span>
        </button>
    </form>
@else
    <!-- Botón de redirección para usuarios no autenticados -->
    <div class="px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600 border-green-600 focus:outline-none focus:shadow-outline-green active:bg-green-800 mx-auto font-semibold"
        id="starButton">
        <a href="{{ route('login') }}" style="display: flex; align-items: center; text-decoration: none; color: white;">
            <svg id="starIcon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="20" height="20"
                fill="currentColor" class="mr-2">
                <path d="M0 0h24v24H0z" fill="none" />
                <path d="M12 2l2.4 7.2h7.6l-6 4.8 2.4 7.2L12 15.6 4 21.2l2.4-7.2-6-4.8h7.6z" />
            </svg>
            <span>Quiero ver</span>
        </a>
    </div>
@endauth

