function buscarAudiovisual2(premioId) {
    // Obtener los datos de entrada
    var searchQuery = document
        .getElementById("search_audiovisual_" + premioId)
        .value.trim();

    // Obtener elementos del DOM
    var audiovisualResults = document.getElementById(
        "audiovisualResults_" + premioId
    );
    var audiovisual = document.querySelector(".audiovisual_" + premioId); // Campo oculto
    var audiovisualInput = document.getElementById(
        "search_audiovisual_" + premioId
    );

    // Verificar si la búsqueda está en blanco
    if (searchQuery === "") {
        // Limpiar la lista de resultados si la búsqueda está vacía
        document.getElementById("audiovisualResults_" + premioId).innerHTML =
            "";
        audiovisualResults.classList.remove("border", "border-gray-300");
        return;
    }

    // Realizar la búsqueda con AJAX
    // Solicitud GET asíncrona a la ruta pasandole el parámetro de consulta
    axios
        .get("/busqueda/audiovisual", {
            params: {
                query: searchQuery,
            },
        })
        .then(function (response) {
            // Limpiar la lista de resultados y agregar estilos
            audiovisualResults.innerHTML = "";

            if (response.data) {
                audiovisualResults.classList.add(
                    "border",
                    "border-gray-500",
                    "rounded-lg",
                    "p-2"
                );
            }

            // Mostrar los resultados y agregar estilos
            response.data.forEach(function (resultado) {
                var li = document.createElement("li");
                li.classList.add(
                    "hover:bg-blue-200",
                    "transition",
                    "duration-300",
                    "ease-in-out"
                );
                li.textContent = resultado.titulo;

                // Agregar un evento de clic y asigna el valor del resultado al campo oculto y de entrada
                li.addEventListener("click", function () {
                    audiovisual.value = resultado.id;
                    audiovisualInput.value = resultado.titulo;

                    // Cerrar la lista de resultados y quita algunos estilos
                    audiovisualResults.innerHTML = "";
                    audiovisualResults.classList.remove(
                        "border",
                        "border-gray-300"
                    );
                });

                audiovisualResults.appendChild(li);
            });
        })
        .catch(function (error) {
            console.error("Error al realizar la búsqueda:", error);
        });
}
