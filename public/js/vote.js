// Función asíncrona
async function saveVote(event, audiovisual) {
    // Evitar recarga de la página
    event.preventDefault();

    // Se obtiene el token CSRF de la página
    let csrfToken = document.head.querySelector(
        'meta[name="csrf-token"]'
    ).content;

    // Se obtiene el voto del audiovisual
    let voto = document.querySelector('select[id="voto"]').value;
    audiovisual["voto"] = voto;

    console.log("Voto seleccionado:", voto);

    // Primero solicitud: Enviar votaciones
    const result = await fetch("http://127.0.0.1:8000/votaciones/create", {
        method: "POST",
        body: JSON.stringify(audiovisual),
        headers: {
            "Content-Type": "application/json",
            Accept: "application/json",
            "X-CSRF-Token": csrfToken,
        },
    });

    // Segunda solicitud: Refrescar votaciones
    const refresh = await fetch("http://127.0.0.1:8000/votaciones/show", {
        method: "POST",
        body: JSON.stringify(audiovisual),
        headers: {
            "Content-Type": "application/json",
            Accept: "application/json",
            "X-CSRF-Token": csrfToken,
        },
    });

    // Actualización de la Interfaz:

    // Convertir en formato JSON
    const data = await refresh.json();

    // Actualizar la cantidad de votos
    let elem = document.getElementById("votos");
    elem.innerText = `${data.length} Votos`;

    elem = document.getElementById("nota");

    // Calcular el promedio de votos
    var sum = 0;
    var avg = "No vista";

    // Verificar si hay votos en los datos recibidos
    if (data.length !== 0) {
        var totalVotos = 0;

        // Iterar sobre los datos recibidos
        for (var i = 0; i < data.length; i++) {
            // Obtener el voto como un entero
            const voto = parseInt(data[i]["voto"], 10);

            // Verificar si el voto es un número válido
            if (!isNaN(voto)) {
                // Sumar el voto al total y contar los votos válidos
                sum += voto;
                totalVotos++;
            }
        }

        // Si hay datos recibidos, calcular la media
        if (totalVotos > 0) {
            avg = sum / totalVotos;
        }
    }

    if (voto.trim().toLowerCase() === "no vista") {
        avg = "No vista";
    } else if (totalVotos > 0) {
        avg = sum / totalVotos;
    }

    // Actualizar el elemento en la interfaz con el promedio de votos
    elem.innerText = avg !== "No vista" ? `${avg.toFixed(1)}` : avg;

    // Actualizar las estrellas
    updateStars(avg);
}

function updateStars(avg) {
    // Contenedor de estrellas
    const starsContainer = document.getElementById("stars-container");

    // Limpiar el contenido actual
    starsContainer.innerHTML = "";

    // Crear nuevas estrellas según la nueva calificación promedio
    for (let i = 1; i <= 10; i++) {
        const star = document.createElement("span");
        star.className =
            i <= avg ? "text-yellow-300 text-lg" : "text-gray-400 text-lg";
        star.innerHTML = "&#9733;";
        starsContainer.appendChild(star);
    }
}
