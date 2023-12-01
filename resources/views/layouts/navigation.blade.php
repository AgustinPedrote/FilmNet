<!-- Barra de navegación principal -->
<nav x-data="{ open: false }" class="border-b border-gray-100 bg-blue-500 h-32 relative z-50">
    <!-- Contenedor principal -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Flex container para alinear elementos -->
        <div class="flex justify-between h-32 items-center">
            <!-- Contenedor para el logo y enlaces de navegación -->
            <div class="flex h-14">
                <!-- Logo con espacio a la derecha -->
                <div class="shrink-0 flex items-center mb-10 mr-4">
                    <a href="{{ route('home.index') }}">
                        <x-application-logo class="block fill-current text-gray-800" />
                    </a>
                </div>
                <!-- Enlaces de navegación -->
                <div class="flex space-x-4 sm:space-x-6 relative z-20">
                    <x-nav-link :href="route('home.index')" :active="request()->routeIs('home.index')">
                        {{ __('Inicio') }}
                    </x-nav-link>

                    <x-nav-link :href="route('peliculas.index')" :active="request()->routeIs('peliculas.index')">
                        {{ __('Peliculas') }}
                    </x-nav-link>

                    <x-nav-link :href="route('series.index')" :active="request()->routeIs('series.index')">
                        {{ __('Series') }}
                    </x-nav-link>

                    <x-nav-link :href="route('documentales.index')" :active="request()->routeIs('documentales.index')">
                        {{ __('Documentales') }}
                    </x-nav-link>
                </div>

                {{-- Buscador --}}
                <div class="w-72 items-center hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <input type="text" id="search-navbar"
                        class="h-10 block w-full p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500
                        focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Buscar...">
                </div>
            </div>

            <!-- Menú desplegable de configuración de usuario -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                @if (Route::has('login'))
                    @auth
                        <!-- Dropdown para el usuario autenticado -->
                        <x-dropdown align="right" width="48">
                            <!-- Botón del usuario -->
                            <x-slot name="trigger">
                                <button
                                    class="inline-flex items-center px-3 py-2 border border-transparent text-md leading-4 font-semibold rounded-md text-white bg-blue-500 hover:text-yellow-300 focus:outline-none transition ease-in-out duration-150">
                                    <div>{{ Auth::user()->name }}</div>
                                    <div class="ml-1">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </button>
                            </x-slot>

                            <!-- Contenido del menú desplegable -->
                            <x-slot name="content">
                                @if (Auth::user()->rol_id == 2)
                                <x-dropdown-link :href="route('admin.index')">
                                    {{ __('Panel administración') }}
                                </x-dropdown-link>
                                @endif
                                <x-dropdown-link :href="route('votaciones.index')">
                                    {{ __('Mis votaciones') }}
                                </x-dropdown-link>

                                <x-dropdown-link :href="route('users.criticas')">
                                    {{ __('Mis críticas') }}
                                </x-dropdown-link>

                                <x-dropdown-link :href="route('seguimientos.index')">
                                    {{ __('Mi lista') }}
                                </x-dropdown-link>

                                <x-dropdown-link :href="route('amigos.index')">
                                    {{ __('Amigos') }}
                                </x-dropdown-link>

                                <x-dropdown-link :href="route('profile.edit')">
                                    {{ __('Datos personales') }}
                                </x-dropdown-link>

                                <!-- Formulario para cerrar sesión -->
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf

                                    <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                                    this.closest('form').submit();">
                                        {{ __('Cerrar sesión') }}
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    @else
                        {{-- Iniciar sesión y Registrar --}}
                        <a href="{{ route('login') }}"
                            class="text-md font-semibold text-white hover:text-yellow-300 dark:text-gray-400 dark:hover:text-white">Iniciar
                            sesión</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                                class="text-md ml-4 font-semibold text-white hover:text-yellow-300 dark:text-gray-400 dark:hover:text-white">Registrarse</a>
                        @endif
                    @endauth
                @endif
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        {{-- <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div> --}}

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            @if (Route::has('login'))
                @auth
                    <div class="px-4">
                        <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                        <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                    </div>

                    <div class="mt-3 space-y-1">
                        <x-responsive-nav-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-responsive-nav-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-responsive-nav-link :href="route('logout')"
                                onclick="event.preventDefault();
                                        this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-responsive-nav-link>
                        </form>
                    </div>
                @else
                    <a href="{{ route('login') }}"
                        class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log
                        in</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                            class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                    @endif

                @endauth

            @endif
        </div>
    </div>
</nav>
