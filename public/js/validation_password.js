// Valida la contraseña actual
function validateCurrentPassword(currentPassword) {
    // Verifica si la contraseña actual está en blanco.
    if (currentPassword.trim() === "") {
        displayErrorMessage(
            "current_password",
            "Por favor, ingrese su contraseña actual."
        );
        return false;
    }
    return true;
}

// Valida la contraseña nueva
function validatePassword(password, field) {
    // Verifica la longitud de la contraseña.
    if (password.length < 8) {
        displayErrorMessage(
            field,
            "La contraseña debe tener al menos 8 caracteres."
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

    // Verifica la presencia de al menos una letra.
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
        displayErrorMessage(
            "password_confirmation",
            "Las contraseñas no coinciden."
        );
        return false;
    }
    return true;
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

// Manejar clic en el botón de guardar
document.getElementById("saveButton").addEventListener("click", function (e) {
    // Elimina los mensajes de error existentes.
    document.querySelectorAll(".error-message").forEach(function (element) {
        element.remove();
    });

    // Obtener valores de las contraseñas
    var currentPassword = document.getElementById("current_password").value;
    var password = document.getElementById("password").value;
    var passwordConfirmation = document.getElementById("password_confirmation").value;

    // Validar la contraseña actual
    var isCurrentPasswordValid = validateCurrentPassword(currentPassword);

    // Validar la nueva contraseña y la confirmación solo si la contraseña actual es válida
    var isNewPasswordValid = false;
    var isPasswordConfirmationValid = false;
    if (isCurrentPasswordValid) {
        isNewPasswordValid = validatePassword(password, "password");
        isPasswordConfirmationValid = validatePasswordConfirmation(passwordConfirmation, password);
    }

    // Si no es válida al menos una de las contraseñas, prevenir el envío del formulario
    if (!isCurrentPasswordValid || !isNewPasswordValid || !isPasswordConfirmationValid) {
        e.preventDefault();
    }
});

