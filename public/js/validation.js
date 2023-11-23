$(document).ready(function() {
    // Esta función se ejecuta cuando el documento HTML ha sido completamente cargado

    function validateForm() {
        // Esta función realiza la validación del formulario

        // Restablecer mensajes de error
        $('.error-message').remove(); // Elimina los mensajes de error existentes

        // Validar cada campo
        var isValid = true; // Variable que indica si el formulario es válido o no

        // Nombre
        var name = $('#name').val();
        isValid = validateField(name, '#name', 'Por favor, ingrese su nombre.') && isValid;

        // Año de nacimiento
        var nacimiento = $('#nacimiento').val();
        isValid = validateYear(nacimiento, '#nacimiento') && isValid;

        // Género
        var sexo = $('#sexo').val();
        isValid = validateField(sexo, '#sexo', 'Por favor, seleccione su género.') && isValid;

        // Ciudad
        var ciudad = $('#ciudad').val();
        isValid = validateField(ciudad, '#ciudad', 'Por favor, ingrese su ciudad.') && isValid;

        // País
        var pais = $('#pais').val();
        isValid = validateField(pais, '#pais', 'Por favor, ingrese su país.') && isValid;

        // Email
        var email = $('#email').val();
        isValid = validateEmail(email, '#email', 'Ingrese un correo electrónico válido.') && isValid;

        // Contraseña
        var password = $('#password').val();
        isValid = validateField(password, '#password', 'Por favor, ingrese su contraseña.') && isValid;

        // Confirmar contraseña
        var passwordConfirmation = $('#password_confirmation').val();
        isValid = validatePasswordConfirmation(passwordConfirmation, password) && isValid;

        return isValid; // Devuelve true si todos los campos son válidos, de lo contrario, devuelve false
    }

    function validateField(value, fieldId, errorMessage) {
        // Esta función valida un campo genérico

        if (value === '') {
            // Si el valor está vacío, muestra un mensaje de error
            $(fieldId).after(
                '<p class="text-red-500 bg-red-200 border border-red-500 rounded p-1 my-2 text-center error-message">' +
                errorMessage +
                '</p>'
            );
            return false; // Indica que la validación ha fallado
        }
        return true; // Indica que la validación ha tenido éxito
    }

    function validateYear(year, fieldId) {
        // Esta función valida el campo de año de nacimiento

        if (year === '' || isNaN(year) || year < 1900 || year > 9999) {
            // Si el año no es válido, muestra un mensaje de error
            $(fieldId).after(
                '<p class="text-red-500 bg-red-200 border border-red-500 rounded p-1 my-2 text-center error-message">' +
                'Ingrese un año de nacimiento válido.' +
                '</p>'
            );
            return false; // Indica que la validación ha fallado
        }
        return true; // Indica que la validación ha tenido éxito
    }

    function validateEmail(email, fieldId, errorMessage) {
        // Esta función valida el campo de correo electrónico utilizando una expresión regular

        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (email === '' || !emailRegex.test(email)) {
            // Si el correo electrónico no es válido, muestra un mensaje de error
            $(fieldId).after(
                '<p class="text-red-500 bg-red-200 border border-red-500 rounded p-1 my-2 text-center error-message">' +
                errorMessage +
                '</p>'
            );
            return false; // Indica que la validación ha fallado
        }
        return true; // Indica que la validación ha tenido éxito
    }

    function validatePasswordConfirmation(passwordConfirmation, password) {
        // Esta función valida la coincidencia de las contraseñas

        if (passwordConfirmation !== password) {
            // Si las contraseñas no coinciden, muestra un mensaje de error
            $('#password_confirmation').after(
                '<p class="text-red-500 bg-red-200 border border-red-500 rounded p-1 my-2 text-center error-message">' +
                'Las contraseñas no coinciden.' +
                '</p>'
            );
            return false; // Indica que la validación ha fallado
        }
        return true; // Indica que la validación ha tenido éxito
    }

    // Manejar clic en el botón de registro
    $('#registerButton').click(function(e) {
        // Esta función se ejecuta cuando se hace clic en el botón de registro

        // Evitar el envío del formulario si la validación falla
        if (!validateForm()) {
            e.preventDefault(); // Evita que el formulario se envíe
        }
    });
});

