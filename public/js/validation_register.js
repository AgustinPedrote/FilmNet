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

        // Género
        var sexo = document.getElementById("sexo").value;
        isValid =
            validateField(sexo, "sexo", "Por favor, seleccione su género.") &&
            isValid;

        // Ciudad
        var ciudad = document.getElementById("ciudad").value;
        isValid =
            validateField(ciudad, "ciudad", "Por favor, ingrese su ciudad.") &&
            isValid;

        // País
        var pais = document.getElementById("pais").value;
        isValid =
            validateField(pais, "pais", "Por favor, ingrese su país.") &&
            isValid;

        // Contraseña
        var password = document.getElementById("password").value;
        isValid = validatePassword(password, "password") && isValid;

        // Confirmar contraseña
        var passwordConfirmation = document.getElementById(
            "password_confirmation"
        ).value;
        isValid =
            validatePasswordConfirmation(passwordConfirmation, password) &&
            isValid;

        // Año de nacimiento
        var nacimiento = document.getElementById("nacimiento").value;
        isValid = validateYear(nacimiento, "nacimiento") && isValid;

        // Email
        var email = document.getElementById("email").value;
        isValid = validateEmail(email, "email") && isValid;

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

        // Comprueba un mínimo y un máximo de caracteres alfabéticos
        if (value.length < 3 || value.length > 25) {
            displayErrorMessage(
                field,
                "Debe contener entre 3 y 25 caracteres alfabéticos."
            );
            return false;
        }

        // Comprueba un mínimo y un máximo de caracteres alfanuméricos, incluyendo caracteres especiales
        if (!/^[a-zA-ZáéíóúüñÁÉÍÓÚÜÑ]+$/.test(value)) {
            displayErrorMessage(
                field,
                "Debe contener solo caracteres alfabéticos, incluyendo caracteres especiales como la ñ o los acentos."
            );
            return false;
        }

        return true;
    }

    // Esta función valida la contraseña.
    function validatePassword(password, field) {
        // Verifica la longitud de la contraseña.
        if (password.length < 8) {
            displayErrorMessage(
                field,
                "La contraseña debe tener almenos 8 caracteres."
            );
            return false;
        }

        // Verifica la presencia de al menos un número.
        if (!/\d/.test(password)) {
            displayErrorMessage(
                field,
                "La contraseña debe contener al menos un número."
            );
            return false;
        }

        // Verifica la presencia de al menos una letra mayúscula.
        if (!/[a-zA-Z]/.test(password)) {
            displayErrorMessage(
                field,
                "La contraseña debe contener al menos una letra."
            );
            return false;
        }

        // Si cumple con todos los requisitos, la contraseña es válida.
        return true;
    }

    // Esta función valida la coincidencia de las contraseñas.
    function validatePasswordConfirmation(passwordConfirmation, password) {
        if (passwordConfirmation !== password) {
            displayErrorMessage(field, "Las contraseñas no coinciden.");
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
                "Por favor, ingrese su año de nacimiento."
            );
            return false;
        }
        return true;
    }

    // Esta función valida el email.
    function validateEmail(email, field, errorMessage) {
        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (email === "" || !emailRegex.test(email)) {
            document;
            displayErrorMessage(
                field,
                "Por favor, ingrese un correo electrónico válido (usuario@example.com)"
            );
            return false;
        }
        return true;
    }

    // Manejar clic en el botón de registro
    document
        .getElementById("registerButton")
        .addEventListener("click", function (e) {
            if (!validateForm()) {
                e.preventDefault();
            }
        });
});
