 <!-- Menú lateral -->
 <aside class="bg-gray-800 text-white w-64 p-4">
     <h1 class="text-2xl font-semibold mb-4">Panel de Administración</h1>
     <ul>
         <li class="mb-2"><a href="{{ route('admin.index') }}" class="block p-2 rounded hover:bg-gray-700 text-lg">Inicio</a></li>
         <li class="mb-2"><a href="{{ route('users.index') }}" class="block p-2 rounded hover:bg-gray-700 text-lg">Usuarios</a></li>
         <li class="mb-2"><a href="{{ route('admin.audiovisuales.index') }}" class="block p-2 rounded hover:bg-gray-700 text-lg">Audiovisuales</a></li>
         <li class="mb-2"><a href="{{ route('personas.index') }}" class="block p-2 rounded hover:bg-gray-700 text-lg">Personas</a></li>
         <li class="mb-2"><a href="{{ route('generos.index') }}" class="block p-2 rounded hover:bg-gray-700 text-lg">Géneros</a></li>
         <li class="mb-2"><a href="{{ route('companies.index') }}" class="block p-2 rounded hover:bg-gray-700 text-lg">Compañías</a></li>
         <li class="mb-2"><a href="{{ route('premios.index') }}" class="block p-2 rounded hover:bg-gray-700 text-lg">Premios</a></li>
         <li class="mb-2"><a href="{{ route('home.index') }}" class="block p-2 rounded hover:bg-gray-700 text-lg">Salir</a></li>
     </ul>
 </aside>
