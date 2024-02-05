document.addEventListener("DOMContentLoaded", function () {
    // Esta función realiza la validación del registro de usuario.
    function validateForm() {
        // Elimina los mensajes de error existentes.
        document.querySelectorAll(".error-message").forEach(function (element) {
            element.remove();
        });

        // La variable indica si el formulario es válido o no.
        var isValid = true;

        // Nombre
        var name = document.getElementById("name").value;
        isValid =
            validateField(name, "name", "Por favor, ingrese su nombre.") &&
            isValid;

        // Año de nacimiento
        var nacimiento = document.getElementById("nacimiento").value;
        isValid = validateYear(nacimiento, "nacimiento") && isValid;

        // País
        var pais = document.getElementById("pais").value;
        isValid =
            validateField(pais, "pais", "Por favor, ingrese su país.") &&
            isValid;

        // Ciudad
        var ciudad = document.getElementById("ciudad").value;
        isValid =
            validateField(ciudad, "ciudad", "Por favor, ingrese su ciudad.") &&
            isValid;

        // Género
        var sexo = document.getElementById("sexo").value;
        isValid =
            validateField(sexo, "sexo", "Por favor, seleccione su género.") &&
            isValid;

        // Email
        var email = document.getElementById("email").value;
        isValid =
            validateEmail(
                email,
                "email",
                "Por favor, ingrese un correo electrónico válido."
            ) && isValid;

        return isValid;
    }

    // Esta función muestra un mensaje de error debajo del campo específico.
    function displayErrorMessage(field, errorMessage) {
        document
            .getElementById(field)
            .insertAdjacentHTML(
                "afterend",
                '<p class="text-base font-medium text-red-500 bg-red-200 border-red-500 rounded p-1 my-2 text-center error-message">' +
                    errorMessage +
                    "</p>"
            );
    }

    // Esta función valida nombre, género, ciudad y país.
    function validateField(value, field, errorMessage) {
        if (value === "") {
            displayErrorMessage(field, errorMessage);
            return false;
        }

        // Comprueba un mínimo y un máximo de caracteres alfabéticos y espacios en blanco
        if (value.length < 3 || value.length > 25) {
            displayErrorMessage(
                field,
                "Debe contener entre 3 y 25 caracteres alfabéticos."
            );
            return false;
        }

        // Comprueba un mínimo y un máximo de caracteres alfanuméricos, incluyendo caracteres especiales y espacios en blanco
        if (!/^[a-zA-ZáéíóúüñÁÉÍÓÚÜÑ\s]+$/.test(value)) {
            displayErrorMessage(
                field,
                "Debe contener solo caracteres alfabéticos y espacios en blanco."
            );
            return false;
        }

        return true;
    }

    // Esta función valida el campo de año de nacimiento
    function validateYear(year, field) {
        if (
            year === "" ||
            isNaN(year) ||
            year < 1900 ||
            year > new Date().getFullYear()
        ) {
            displayErrorMessage(
                field,
                "Por favor, ingrese un año de nacimiento válido."
            );
            return false;
        }
        return true;
    }

    // Esta función valida el email.
    function validateEmail(email, field, errorMessage) {
        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (email === "" || !emailRegex.test(email)) {
            displayErrorMessage(
                field,
                "Por favor, ingrese un correo electrónico válido."
            );
            return false;
        }
        return true;
    }

    // Manejar validación adicional del lado del cliente antes de que los datos se envíen al servidor.
    document
        .getElementById("send-verification")
        .addEventListener("submit", function (e) {
            if (!validateForm()) {
                e.preventDefault();
            }
        });

    document
        .getElementById("profile-update-form")
        .addEventListener("submit", function (e) {
            if (!validateForm()) {
                e.preventDefault();
            }
        });
});
