<!DOCTYPE html>
<html lang="en">

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

<body class="font-sans bg-gray-200">

    <div class="flex h-screen">

        @include('components.navAdmin')

        <!-- Contenido principal -->
        <main class="w-full">
            {{ $slot }}
        </main>
    </div>

</body>

</html>
