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
</head>

<body class="font-sans bg-gray-100">

    <div class="flex h-screen">

        <!-- Menú lateral -->
        <aside class="bg-gray-800 text-white w-64 p-4">
            <h1 class="text-2xl font-semibold mb-4">Panel de Administración</h1>
            <ul>
                <li class="mb-2"><a href="#" class="block p-2 rounded hover:bg-gray-700">Inicio</a></li>
                <li class="mb-2"><a href="#" class="block p-2 rounded hover:bg-gray-700">Usuarios</a></li>
                <li class="mb-2"><a href="#" class="block p-2 rounded hover:bg-gray-700">Configuración</a></li>
            </ul>
        </aside>

        <!-- Contenido principal -->
        <main>
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <!-- Contenedor para el contenido principal con estilos -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                            <!-- Debugging: Imprimir el contenido de $slot -->
                            @dump($slot)
                        </div>
                    </div>
                </div>
            </div>
        </main>

    </div>

</body>

</html>
