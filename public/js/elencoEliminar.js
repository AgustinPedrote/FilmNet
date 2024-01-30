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

// Función para eliminar todo el elenco de un audiovisual utilizando Axios
async function eliminarTodoElenco(audiovisualId) {
    try {
        // Realizar la solicitud DELETE utilizando Axios
        await axios.delete(
            `/audiovisuales/${audiovisualId}/eliminar-todo-elenco`,
            {
                headers: {
                    "X-CSRF-TOKEN": document.querySelector(
                        'meta[name="csrf-token"]'
                    ).content,
                },
            }
        );

        // Cerrar el modal y recargar la página después de eliminar el elenco con éxito
        document
            .querySelector(`[data-modal-hide="ElencoEliminar${audiovisualId}"]`)
            .click();
        location.reload();
    } catch (error) {
        // Manejar errores de la solicitud
        if (error.response) {
            // La solicitud fue realizada, pero el servidor respondió con un código de estado que no está en el rango 2xx
            mostrarMensaje(
                error.response.data.message ||
                    "Error al comunicarse con el servidor.",
                "alert"
            );
        } else if (error.request) {
            // La solicitud fue realizada pero no se recibió ninguna respuesta
            mostrarMensaje("No se recibió respuesta del servidor.", "alert");
        } else {
            // Hubo un error al configurar la solicitud
            mostrarMensaje("Error al comunicarse con el servidor.", "alert");
        }
    }
}

// Función para eliminar una relación específica y manejar la respuesta utilizando Axios
async function eliminarRelacion(
    audiovisualId,
    tipoRelacion,
    relacionId,
    listItemElement
) {
    try {
        // Realizar la solicitud DELETE utilizando Axios
        await axios.delete(
            `/audiovisuales/${audiovisualId}/eliminar-relacion/${tipoRelacion}/${relacionId}`,
            {
                headers: {
                    "X-CSRF-TOKEN": document.querySelector(
                        'meta[name="csrf-token"]'
                    ).content,
                },
            }
        );

        // Eliminar el elemento de la lista en el modal
        listItemElement.remove();
        mostrarMensaje("Relación eliminada exitosamente.", "success");
    } catch (error) {
        // Manejar errores de la solicitud
        if (error.response) {
            // La solicitud fue realizada, pero el servidor respondió con un código de estado que no está en el rango 2xx
            mostrarMensaje(
                error.response.data.message ||
                    "Error al comunicarse con el servidor.",
                "alert"
            );
        } else if (error.request) {
            // La solicitud fue realizada pero no se recibió ninguna respuesta
            mostrarMensaje("No se recibió respuesta del servidor.", "alert");
        } else {
            // Hubo un error al configurar la solicitud
            mostrarMensaje("Error al comunicarse con el servidor.", "alert");
        }
    }
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
