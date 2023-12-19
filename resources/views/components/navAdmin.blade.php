<!-- Menú lateral -->
<aside class="bg-gray-800 text-white w-64 p-4">
    <h1 class="text-2xl font-semibold mb-4">Panel de Administración</h1>

    <ul>
        <li class="mb-2">
            <a href="{{ route('admin.index') }}"
                class="block p-2 rounded hover:bg-gray-700 text-lg {{ request()->routeIs('admin.index') ? 'bg-gray-700' : '' }}">
                Inicio
            </a>
        </li>
        <li class="mb-2">
            <a href="{{ route('users.index') }}"
                class="block p-2 rounded hover:bg-gray-700 text-lg {{ request()->routeIs('users.index') ? 'bg-gray-700' : '' }}">
                Usuarios
            </a>
        </li>
        <li class="mb-2">
            <a href="{{ route('admin.audiovisuales.index') }}"
                class="block p-2 rounded hover:bg-gray-700 text-lg {{ request()->routeIs('admin.audiovisuales.index') ? 'bg-gray-700' : '' }}">
                Audiovisuales
            </a>
        </li>
        <li class="mb-2">
            <a href="{{ route('personas.index') }}"
                class="block p-2 rounded hover:bg-gray-700 text-lg {{ request()->routeIs('personas.index') ? 'bg-gray-700' : '' }}">
                Personas
            </a>
        </li>
        <li class="mb-2">
            <a href="{{ route('generos.index') }}"
                class="block p-2 rounded hover:bg-gray-700 text-lg {{ request()->routeIs('generos.index') ? 'bg-gray-700' : '' }}">
                Géneros
            </a>
        </li>
        <li class="mb-2">
            <a href="{{ route('companies.index') }}"
                class="block p-2 rounded hover:bg-gray-700 text-lg {{ request()->routeIs('companies.index') ? 'bg-gray-700' : '' }}">
                Compañías
            </a>
        </li>
        <li class="mb-2">
            <a href="{{ route('premios.index') }}"
                class="block p-2 rounded hover:bg-gray-700 text-lg {{ request()->routeIs('premios.index') ? 'bg-gray-700' : '' }}">
                Premios
            </a>
        </li>
        <li class="mb-2">
            <a href="{{ route('home.index') }}"
                class="block p-2 rounded hover:bg-gray-700 text-lg {{ request()->routeIs('home.index') ? 'bg-gray-700' : '' }}">
                Salir
            </a>
        </li>
    </ul>
</aside>
