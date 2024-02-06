<!-- Verifica si la cookie 'cookie_filmnet' existe -->
<?php
 $cookie_filmnet = $_COOKIE['cookie_filmnet'] ?? null;
 if (!$cookie_filmnet) :
 ?>

<!-- Fondo oscuro -->
<div class="cookie-overlay bg-black opacity-50 fixed inset-0 z-40"></div>

<!-- Mensaje de privacidad y cookies -->
<div
    class="cookie-notice-container fixed bottom-10 left-1/2 transform -translate-x-1/2 w-full max-w-2xl mx-auto opacity-95 transition-opacity duration-500 ease-in-out z-50 bg-gray-800 text-white p-8 rounded-lg shadow-lg">
    <!-- Imagen -->
    <div class="flex items-center justify-center mb-4">
        <img src="{{ asset('logos/logo3.png') }}" alt="Logo" class="w-full h-auto max-h-28 object-contain">
    </div>

    <!-- Párrafo explicativo sobre privacidad y cookies -->
    <h1 class="text-lg md:text-xl font-semibold mb-2 text-center">Su privacidad es importante para nosotros</h1>

    <p class="mb-4 text-sm md:text-base leading-relaxed">
        Nosotros y nuestros socios almacenamos o accedemos a información
        en un dispositivo, tales como cookies, y procesamos datos personales, tales como identificadores únicos e
        información estándar enviada por un dispositivo, para anuncios y contenido personalizados, medición de
        anuncios y del contenido e información sobre el público, así como para desarrollar y mejorar productos. Con
        su permiso, nosotros y nuestros socios podemos utilizar datos de localización geográfica precisa e
        identificación mediante las características de dispositivos. Puede hacer clic para otorgarnos su
        consentimiento a nosotros y a nuestros 747 socios para que llevemos a cabo el procesamiento previamente
        descrito. De forma alternativa, puede acceder a información más detallada y cambiar sus preferencias antes
        de otorgar o negar su consentimiento. Tenga en cuenta que algún procesamiento de sus datos personales puede
        no requerir de su consentimiento, pero usted tiene el derecho de rechazar tal procesamiento. Sus
        preferencias se aplicarán solo a este sitio web. Puede cambiar sus preferencias en cualquier momento
        entrando de nuevo en este sitio web o visitando nuestra política de privacidad.
    </p>

    <a id="masInfo" class="text-blue-300 underline cursor-pointer font-semibold mr-4">Más información</a>

    <div class="flex justify-center">
        <button id="cn-accept-cookie" data-cookie-set="accept"
            class="bg-yellow-400 hover:bg-yellow-300 text-gray-900 font-bold rounded px-4 py-2 transition duration-200 ease-in-out"
            aria-label="Aceptar">
            Aceptar
        </button>
    </div>
</div>

<?php endif; ?>

 <!-- Creación y validación de cookies con JS -->
 <script src="{{ asset('js/cookies.js') }}"></script>

