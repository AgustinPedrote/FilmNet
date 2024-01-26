<footer class="bg-blue-100 font-sans dark:bg-gray-900">
    <div class="container px-6 mx-auto flex flex-col md:flex-row items-center justify-between">

        <!-- Logo y nombre del sitio -->
        <div class="mb-4 md:mb-0">
            <a href="{{ route('home.index') }}" class="flex items-center">
                <!-- Logo del sitio -->
                <img src="{{ asset('logos/logo.png') }}" alt="logo" class="w-16 h-auto mr-2">
                <!-- Nombre del sitio -->
                <span class="text-base text-gray-900 ">© 2023 FilmNet</span>
            </a>
        </div>

        <ul class="flex flex-wrap items-center mb-6 text-base text-gray-900 sm:mb-0">
            <li>
                <a href="{{ route('politica-de-privacidad') }}" class="mr-4 hover:underline md:mr-6">Política de
                    privacidad</a>
            </li>
            <li>
                <a href="{{ route('sobre-nosotros') }}" class="mr-4 hover:underline md:mr-6">Sobre Nosotros</a>
            </li>
        </ul>

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
