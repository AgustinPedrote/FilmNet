// Función para confirmar y eliminar todo el elenco de un audiovisual (Botón Aceptar)
function aceptarEliminarTodoElenco(audiovisualId) {
    // Recargar la página después de aceptar
    location.reload();
    document
        .querySelector(`[data-modal-hide="ElencoEliminar${audiovisualId}"]`)
        .click();
}

// Función de confirmación para mostrar una ventana emergente
function confirmarEliminarTodo(audiovisualId) {
    if (
        confirm("¿Estás seguro de que deseas eliminar todo el elenco y equipo?")
    ) {
        // Llamar a la función para eliminar todo el elenco
        eliminarTodoElenco(audiovisualId);
    }
}

// Función para eliminar todo el elenco de un audiovisual
function eliminarTodoElenco(audiovisualId) {
    var xhr = new XMLHttpRequest();

    // La función se llamará cada vez que cambie el estado de la solicitud
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            // Verificar si la respuesta del servidor es exitosa (código 200)
            if (xhr.status === 200) {
                var response = JSON.parse(xhr.responseText);
                if (response.success) {
                    // Cerrar el modal y recargar la página después de eliminar el elenco con éxito
                    document
                        .querySelector(
                            `[data-modal-hide="ElencoEliminar${audiovisualId}"]`
                        )
                        .click();
                    location.reload();
                } else {
                    // Mostrar mensaje de error en caso de problemas con la solicitud al servidor
                    mostrarMensaje(response.message, "alert");
                }
            } else {
                mostrarMensaje(
                    "Error al comunicarse con el servidor.",
                    "alert"
                );
            }
        }
    };

    // Configurar la solicitud DELETE a la URL específica para eliminar elenco
    xhr.open(
        "DELETE",
        `/audiovisuales/${audiovisualId}/eliminar-todo-elenco`,
        true
    );

    // Configurar el encabezado con el token CSRF
    xhr.setRequestHeader(
        "X-CSRF-TOKEN",
        document.querySelector('meta[name="csrf-token"]').content
    );

    // Enviar la solicitud DELETE al servidor
    xhr.send();
}

// Función para eliminar una relación específica y manejar la respuesta
function eliminarRelacion(
    audiovisualId,
    tipoRelacion,
    relacionId,
    listItemElement
) {
    // Crear una nueva instancia de XMLHttpRequest
    var xhr = new XMLHttpRequest();

    // La función se ejecutará cada vez que cambie el estado de la solicitud
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                // Analizar la respuesta JSON del servidor
                var response = JSON.parse(xhr.responseText);
                if (response.success) {
                    // Eliminar el elemento de la lista en el modal
                    listItemElement.remove();
                    mostrarMensaje(response.message, "success");
                } else {
                    mostrarMensaje(response.message, "alert");
                }
            } else {
                mostrarMensaje(
                    "Error al comunicarse con el servidor.",
                    "alert"
                );
            }
        }
    };

    // Configurar la solicitud DELETE a la URL específica para eliminar la relación
    xhr.open(
        "DELETE",
        `/audiovisuales/${audiovisualId}/eliminar-relacion/${tipoRelacion}/${relacionId}`,
        true
    );

    // Configurar el encabezado con el token CSRF
    xhr.setRequestHeader(
        "X-CSRF-TOKEN",
        document.querySelector('meta[name="csrf-token"]').content
    );

    // Enviar la solicitud DELETE al servidor
    xhr.send();
}

// Función para mostrar mensajes al usuario
function mostrarMensaje(mensaje, tipoMensaje) {
    // Crear un nuevo elemento div para el mensaje
    var mensajeElement = document.createElement("div");
    // Asignar el texto del mensaje al elemento
    mensajeElement.innerText = mensaje;

    // Definir clases base comunes para todos los tipos de mensaje
    mensajeElement.classList.add(
        "fixed",
        "top-0",
        "left-1/2",
        "transform",
        "-translate-x-1/2",
        "p-2",
        "font-medium",
        "rounded-lg",
        "shadow",
        "text-center",
        "z-50",
        "transition-all",
        "duration-500",
        "ease-in-out",
        "text-lg"
    );

    // Configurar estilos y clases específicas según el tipo de mensaje
    switch (tipoMensaje) {
        case "success":
            mensajeElement.classList.add(
                "text-green-500",
                "bg-green-200",
                "border-green-500",
                "my-4"
            );
            break;
        case "alert":
            mensajeElement.classList.add(
                "text-red-500",
                "bg-red-200",
                "border-red-500",
                "my-4"
            );
            break;
    }

    // Configurar estilos adicionales
    mensajeElement.style.width = "70%";
    mensajeElement.style.top = "0";

    // Agregar el elemento al cuerpo del documento HTML
    document.body.appendChild(mensajeElement);

    // Transición de opacidad
    void mensajeElement.offsetHeight;

    // Mostrar el mensaje
    mensajeElement.style.opacity = "1";

    // Ocultar el mensaje después de unos segundos
    setTimeout(function () {
        mensajeElement.style.opacity = "0";
        setTimeout(function () {
            mensajeElement.remove();
        }, 500);
    }, 3000);
}
