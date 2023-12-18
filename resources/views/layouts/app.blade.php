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
    <link rel="icon" href="{{ asset('img/FN.png') }}" type="image/x-icon"/>
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
</body>

<!-- Inclusión del pie de página desde un componente -->
@include('components.footer')

</html>
