// Manejar el evento de clic de seguimiento
function toggleSeguimiento() {
    // Obtener referencia al formulario y al icono de estrella en el DOM
    var form = document.getElementById("toggleSeguimientoForm");
    var starIcon = document.getElementById("starIcon");

    // Enviar una solicitud fetch al servidor para manejar el seguimiento
    fetch(form.action, {
        method: form.method,
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')
                .content,
        },
        body: JSON.stringify({
            audiovisual_id: form.querySelector('[name="audiovisual_id"]').value,
        }),
    })
        // Primera respuesta del servidor a formato JSON.
        .then((response) => response.json())

        // La segunda actualiza el color de relleno del icono de estrella
        .then((data) => {
            console.log(data);

            // Actualiza el color de relleno del ícono según la respuesta del servidor
            if (data.status === "added") {
                starIcon.setAttribute("fill", "yellow");
            } else if (data.status === "removed") {
                starIcon.setAttribute("fill", "white");
            }
        })
        .catch((error) => console.error("Error:", error));
}
