<p align="center">
<img src="/public/logos/logo4.png" width="400">
</p>

<p align="center">
  <b> Agustín Pedrote Bejarano | Curso 2023/24 </b>
</p>

# Descripción general del proyecto

El proyecto en cuestión constituye un portal web especializado en el ámbito cinematográfico, diseñado para proporcionar a los usuarios un acceso eficiente a información detallada sobre diversas producciones audiovisuales. Además, facilita la posibilidad de que los usuarios registren y compartan sus valoraciones y críticas sobre dichas obras. Este entorno virtual ofrece una plataforma intuitiva y funcional, destinada a satisfacer las necesidades de una comunidad apasionada por el cine, alentando así la interacción y el intercambio de opiniones entre sus miembros.

La finalidad de este proyecto es crear un espacio en línea en el que los amantes del séptimo arte puedan explorar, evaluar y discutir de manera constructiva acerca de las creaciones cinematográficas contemporáneas y clásicas.

## Funcionalidad principal de la aplicación

La funcionalidad principal de la aplicación se centra en la gestión integral de una base de datos exhaustiva que abarca la ficha técnica y artística de películas, documentales y series de televisión. Cada obra es evaluada a través de una puntuación determinada por el promedio de las valoraciones emitidas por los usuarios, quienes también tienen la posibilidad de expresar sus críticas.

Adicionalmente, los usuarios disponen de un conjunto de herramientas para gestionar su actividad en la plataforma. Pueden visualizar sus propias valoraciones, críticas, así como las medias correspondientes. Asimismo, cuentan con la capacidad de agregar títulos a una lista personalizada denominada "Titulos que quiero ver", así como eliminarlos de la misma según sus preferencias.

## Objetivos generales

-   Objetivo: Crear una plataforma web dedicada a la consulta y valoración de producciones audiovisuales.

-   Casos de uso:

    -   Para el Invitado: - Registrar una cuenta. - Visualizar fichas de producciones. - Realizar búsquedas específicas.

    -   Para el Usuario: - Iniciar sesión en la plataforma. - Cerrar sesión de su cuenta. - Añadir votaciones a producciones. - Publicar críticas. - Consultar sus propias valoraciones y medias. - Agregar titulos a la lista personal "Titulos que quiero ver". - Establecer conexiones con otros usuarios como amigos (Opcional). - Visualizar los cines próximos mediante el uso de la funcionalidad de geolocalización (Opcional).

    -   Para el Administrador: - Iniciar sesión con privilegios administrativos. - Cerrar sesión de su cuenta administrativa. - Crear y publicar fichas de producciones. - Eliminar críticas. - Bloquear cuentas de usuario en casos pertinentes. - Desbloquear cuentas de usuario, cuando sea necesario. - Otorgar permisos de administrador a otros usuarios.

# Elemento de innovación

-   Implementación del framework web Laravel 10.
-   Integración opcional para la visualización de cines cercanos en un mapa.

# Instrucciones de instalación

-   Requisitos:

    - PHP 8.2.7

    - Composer version 2.5.1

    - Node v18.19.0

    - npm 9.2.0

    - psql (PostgreSQL) 15.5

-   Instalación:

    - Clonamos el repositorio de GitHub.

    - Creamos la base de datos para el proyecto.

    - Copiamos el contenido del archivo .env.example en otro archivo llamado .env y cambiamos las variables.
      
    - Abrimos un terminal en el directorio del proyecto e introducimos los siguientes comandos:

       * composer install

       * npm install

       * php artisan key:generate

       * php artisan migrate

       * php artisan db:seed

       * npm run dev

       * php artisan serve

    - Acceder a la ruta http://localhost:8000/

