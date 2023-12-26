// Manejar el evento de clic de seguimiento

function toggleSeguimiento() {
    var form = document.getElementById("toggleSeguimientoForm");
    var starIcon = document.getElementById("starIcon");

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
        .then((response) => response.json())
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
