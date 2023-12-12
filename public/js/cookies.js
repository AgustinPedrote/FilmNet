document.addEventListener("DOMContentLoaded", function () {
    // Verificar si la cookie 'cookie_filmnet' existe
    var cookie_filmnet = getCookie("cookie_filmnet");
    // Contenedor de mensaje de privacidad
    var cookieNoticeContainer = document.querySelector(
        ".cookie-notice-container"
    );

    // Mostrar el aviso de cookies solo si la cookie no ha sido aceptada
    if (!cookie_filmnet && cookieNoticeContainer) {
        cookieNoticeContainer.classList.remove("hidden");
        cookieNoticeContainer.classList.add("block");

        // Botón de aceptar cookies
        var acceptButton = document.getElementById("cn-accept-cookie");

        if (acceptButton) {
            acceptButton.addEventListener("click", function () {
                // Lógica para aceptar cookies, cáduca a los 3 meses.
                var currentDate = new Date();
                var expirationDate = new Date(currentDate);
                expirationDate.setMonth(currentDate.getMonth() + 3);
                var formattedExpirationDate = expirationDate.toUTCString();
                document.cookie =
                    "cookie_filmnet=true; expires=" +
                    formattedExpirationDate +
                    "; path=/";

                // Ocultar el contenedor del aviso de cookies y el fondo oscuro
                cookieNoticeContainer.classList.add("hidden");
                document
                    .querySelector(".cookie-overlay")
                    .classList.add("hidden");
            });
        }

        var ElementInfo = document.getElementById("masInfo");

        // Verificar si 'masInfo' existe.
        if (ElementInfo) {
            ElementInfo.addEventListener("click", function () {
                var windowWidth = 950;
                var windowHeight = 750;
                var screenWidth = window.screen.width;
                var screenHeight = window.screen.height;
                var leftPosition = (screenWidth - windowWidth) / 2;
                var topPosition = (screenHeight - windowHeight) / 2;
                window.open(
                    "http://127.0.0.1:8000/privacidad_cookies",
                    "Política de Privacidad",
                    "width=" +
                        windowWidth +
                        ",height=" +
                        windowHeight +
                        ",left=" +
                        leftPosition +
                        ",top=" +
                        topPosition
                );
            });
        }
    }

    // función para crear la cookie
    function getCookie(name) {
        var value = "; " + document.cookie;
        var parts = value.split("; " + name + "=");
        if (parts.length == 2) return parts.pop().split(";").shift();
    }
});
