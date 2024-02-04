<!-- Barra de navegación principal -->
<nav x-data="{ open: false }" class="border-b border-gray-100 bg-blue-500 h-32 relative z-30">
    <!-- Contenedor principal -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Flex container para alinear elementos -->
        <div class="flex justify-between h-32 items-center">
            <!-- Contenedor para el logo y enlaces de navegación -->
            <div class="flex h-14">
                <!-- Logo con espacio a la derecha -->
                <div class="shrink-0 flex items-center mb-10 mr-8">
                    <x-application-logo class="block fill-current text-gray-800" />
                </div>

                <!-- Enlaces de navegación -->
                <div class="hidden lg:flex space-x-4 sm:space-x-6 relative z-20">
                    <x-nav-link :href="route('home.index')" :active="request()->routeIs('home.index')" class="text-xl">
                        {{ __('Inicio') }}
                    </x-nav-link>

                    <x-nav-link :href="route('peliculas.index')" :active="request()->routeIs('peliculas.index')" class="text-xl">
                        {{ __('Peliculas') }}
                    </x-nav-link>

                    <x-nav-link :href="route('series.index')" :active="request()->routeIs('series.index')" class="text-xl">
                        {{ __('Series') }}
                    </x-nav-link>

                    <x-nav-link :href="route('documentales.index')" :active="request()->routeIs('documentales.index')" class="text-xl">
                        {{ __('Documentales') }}
                    </x-nav-link>
                </div>

            </div>

            <!-- Menú desplegable de configuración de usuario -->
            <div class="hidden lg:flex lg:items-center lg:ml-6">
                @if (Route::has('login'))
                    @auth
                        <!-- Dropdown para el usuario autenticado -->
                        <x-dropdown align="right" width="48">
                            <!-- Botón del usuario -->
                            <x-slot name="trigger">
                                <button
                                    class="inline-flex items-center px-3 py-2 border border-transparent text-md leading-4 font-semibold rounded-md text-white bg-blue-500 hover:text-yellow-300 focus:outline-none transition ease-in-out duration-150">
                                    <div class="text-base">{{ Auth::user()->name }}</div>
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
                                        {{ __('Panel de administración') }}
                                    </x-dropdown-link>
                                @endif
                                <x-dropdown-link :href="route('votaciones.index')">
                                    {{ __('Mis votaciones') }}
                                </x-dropdown-link>

                                <x-dropdown-link :href="route('users.criticas')">
                                    {{ __('Mis críticas') }}
                                </x-dropdown-link>

                                <x-dropdown-link :href="route('seguimientos.index')">
                                    {{ __('Quiero ver') }}
                                </x-dropdown-link>

                                <x-dropdown-link :href="route('amigos.usuariosSeguidos')">
                                    {{ __('Seguidos') }}
                                </x-dropdown-link>

                                <x-dropdown-link :href="route('amigos.usuariosSeguidores')">
                                    {{ __('Seguidores') }}
                                </x-dropdown-link>

                                <x-dropdown-link :href="route('profile.edit')">
                                    {{ __('Perfil') }}
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
                            class="text-base font-semibold text-white hover:text-yellow-300 dark:text-gray-400 dark:hover:text-white">
                            Iniciar sesión
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                                class="text-base ml-4 font-semibold text-white hover:text-yellow-300 dark:text-gray-400 dark:hover:text-white">
                                Registrarse
                            </a>
                        @endif
                    @endauth
                @endif
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center lg:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-yellow-300 hover:text-yellow-300 hover:bg-blue-600 focus:outline-none focus:bg-blue-600 focus:text-yellow-300 transition duration-150 ease-in-out">
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
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden lg:hidden">
        <!-- Responsive Settings Options -->
        <div class="bg-gray-500 rounded-lg shadow-lg p-6">
            @auth
                <!-- Mostrar información del usuario autenticado y opción de cerrar sesión -->
                <div class="flex items-center justify-between mb-4">
                    <div class="text-lg font-semibold text-yellow-300 hover:text-yellow-400">
                        {{ Auth::user()->name }}
                    </div>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-white hover:text-yellow-400 focus:outline-none">
                            Cerrar sesión
                        </button>
                    </form>
                </div>

                <!-- Enlaces de navegación -->
                <div class="flex items-center mb-2">
                    <x-responsive-nav-link :href="route('home.index')" class="mr-2">
                        Inicio
                    </x-responsive-nav-link>

                    <x-responsive-nav-link :href="route('peliculas.index')" class="mr-2">
                        Peliculas
                    </x-responsive-nav-link>

                    <x-responsive-nav-link :href="route('series.index')" class="mr-2">
                        Series
                    </x-responsive-nav-link>

                    <x-responsive-nav-link :href="route('documentales.index')">
                        Documentales
                    </x-responsive-nav-link>
                </div>

                <!-- Enlace al perfil del usuario autenticado -->
                <x-responsive-nav-link :href="route('admin.index')">
                    Panel de administración
                </x-responsive-nav-link>
                <!-- Enlace al perfil del usuario autenticado -->
                <x-responsive-nav-link :href="route('votaciones.index')">
                    Mis votaciones
                </x-responsive-nav-link>
                <!-- Enlace al perfil del usuario autenticado -->
                <x-responsive-nav-link :href="route('users.criticas')">
                    Mis críticas
                </x-responsive-nav-link>
                <!-- Enlace al perfil del usuario autenticado -->
                <x-responsive-nav-link :href="route('seguimientos.index')">
                    Quiero ver
                </x-responsive-nav-link>
                <!-- Enlace al perfil del usuario autenticado -->
                <x-responsive-nav-link :href="route('amigos.usuariosSeguidos')">
                    Seguidos
                </x-responsive-nav-link>
                <!-- Enlace al perfil del usuario autenticado -->
                <x-responsive-nav-link :href="route('amigos.usuariosSeguidores')">
                    seguidores
                </x-responsive-nav-link>
                <!-- Enlace al perfil del usuario autenticado -->
                <x-responsive-nav-link :href="route('profile.edit')">
                    Perfil
                </x-responsive-nav-link>
            @else
                <!-- Mostrar enlaces de inicio de sesión y registro si el usuario no está autenticado -->
                <div class="flex items-center justify-between mb-4">
                    <div class="text-base text-gray-200 hover:text-yellow-400">
                        <a href="{{ route('login') }}">
                            Iniciar sesión
                        </a>
                    </div>

                    @if (Route::has('register'))
                        <div class="text-base text-gray-200 hover:text-yellow-400">
                            <a href="{{ route('register') }}">
                                Registrarse
                            </a>
                        </div>
                    @endif
                </div>

                <!-- Enlaces de navegación -->
                <div class="flex items-center mb-2">
                    <x-responsive-nav-link :href="route('home.index')" class="mr-2">
                        Inicio
                    </x-responsive-nav-link>

                    <x-responsive-nav-link :href="route('peliculas.index')" class="mr-2">
                        Peliculas
                    </x-responsive-nav-link>

                    <x-responsive-nav-link :href="route('series.index')" class="mr-2">
                        Series
                    </x-responsive-nav-link>

                    <x-responsive-nav-link :href="route('documentales.index')">
                        Documentales
                    </x-responsive-nav-link>
                </div>
            @endauth
        </div>

    </div>
</nav>
