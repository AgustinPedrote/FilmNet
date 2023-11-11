<footer class="bg-blue-100 dark:bg-gray-900">
    <div class="container px-6 mx-auto flex items-center justify-between">

        <!-- Logo -->
        <div>
            <a href="{{ route('home.index') }}">
                <img src="{{ asset('img/logo.png') }}" alt="logo" class="w-60 h-auto">
            </a>
        </div>

        <!-- Derechos de autor -->
        <p class="font-sans p-4 text-center text-sm md:text-lg col-span-3">&copy; 2023 FilmNet. Todos los derechos reservados.</p>

        <!-- Enlaces a redes sociales -->
        <div class="flex gap-4 cursor-pointer">
            <a href="https://www.facebook.com" target="_blank">
                <img src="https://www.svgrepo.com/show/303114/facebook-3-logo.svg" width="30" height="30" alt="fb" />
            </a>
            <a href="https://www.twitter.com" target="_blank">
                <img src="https://www.svgrepo.com/show/303115/twitter-3-logo.svg" width="30" height="30" alt="tw" />
            </a>
            <a href="https://www.instagram.com" target="_blank">
                <img src="https://www.svgrepo.com/show/303145/instagram-2-1-logo.svg" width="30" height="30" alt="inst" />
            </a>
        </div>
    </div>
</footer>

