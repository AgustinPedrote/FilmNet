<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Configuración del documento -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Título de la página -->
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fuentes -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <!-- Enlace a la fuente 'figtree' con diferentes pesos -->
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    <!-- Inclusión de estilos y scripts con Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('logos/FN.png') }}" type="image/x-icon" />
</head>

<body class="font-sans antialiased">
    <!-- Contenedor principal del cuerpo de la página -->
    <div class="principal min-h-screen bg-gray-100">
        <!-- Inclusión de la barra de navegación desde un archivo de diseño -->
        @include('layouts.navigation')

        <!-- Encabezado de la página -->
        @if (isset($header))
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Contenido de la página -->
        <main>
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <!-- Contenedor para el contenido principal con estilos -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                            {{ $slot }}
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Flecha para volver arriba -->
    <div id="scroll-to-top"
        class="hidden fixed bottom-4 right-4 p-2 bg-blue-500 text-white rounded-full cursor-pointer">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
            class="h-6 w-6">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
        </svg>
    </div>

    <script src="{{ asset('js/up.js') }}"></script>
</body>

<!-- Inclusión del pie de página desde un componente -->
@include('components.footer')

</html>
