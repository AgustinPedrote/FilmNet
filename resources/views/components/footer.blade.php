<!-- component -->
<footer class="bg-blue-100 font-sans dark:bg-gray-900">
    <div class="container px-6 mx-auto flex items-center justify-between">

        <!-- Logo y nombre del sitio -->
        <div>
            <a href="{{ route('home.index') }}" class="flex items-center">
                <!-- Logo del sitio -->
                <img src="{{ asset('img/logo.png') }}" alt="logo" class="w-16 h-auto mr-2">
                <!-- Nombre del sitio -->
                <span class="text-xl font-bold text-gray-800 dark:text-white">FilmNet</span>
            </a>
        </div>

        <!-- Derechos de autor -->
        <p class="text-gray-600 dark:text-gray-400 text-center md:text-lg">© 2023 FilmNet. Todos los derechos reservados.
        </p>

        <!-- Iconos de redes sociales -->
        <div class="flex gap-4 cursor-pointer">
            <!-- Icono de Facebook -->
            <a href="https://www.facebook.com" target="_blank">
                <img src="https://www.svgrepo.com/show/303114/facebook-3-logo.svg" width="30" height="30"
                    alt="Facebook" />
            </a>
            <!-- Icono de Twitter -->
            <a href="https://www.twitter.com" target="_blank">
                <img src="https://www.svgrepo.com/show/303115/twitter-3-logo.svg" width="30" height="30"
                    alt="Twitter" />
            </a>
            <!-- Icono de Instagram -->
            <a href="https://www.instagram.com" target="_blank">
                <img src="https://www.svgrepo.com/show/303145/instagram-2-1-logo.svg" width="30" height="30"
                    alt="Instagram" />
            </a>
        </div>
    </div>
</footer>
