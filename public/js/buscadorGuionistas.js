function buscarGuionista(audiovisualId) {
    // Obtener los datos de entrada
    var searchQuery = document
        .getElementById("search_guionista" + audiovisualId)
        .value.trim();

    // Obtener elementos del DOM
    var guionistaResults = document.getElementById(
        "guionistaResults" + audiovisualId
    );
    var guionistaInput = document.getElementById(
        "search_guionista" + audiovisualId
    );

    // Verificar si la búsqueda está en blanco
    if (searchQuery === "") {
        // Limpiar la lista de resultados si la búsqueda está vacía
        document.getElementById("guionistaResults" + audiovisualId).innerHTML =
            "";
        guionistaResults.classList.remove("border", "border-gray-300");
        return;
    }

    // Realizar la búsqueda con AJAX
    // Solicitud GET asíncrona a la ruta pasándole el parámetro de consulta
    axios
        .get("/busqueda/guionista", {
            params: {
                query: searchQuery,
            },
        })
        .then(function (response) {
            // Limpiar la lista de resultados y agregar estilos
            guionistaResults.innerHTML = "";

            var guionistas = response.data.guionistas;

            if (Array.isArray(guionistas) && guionistas.length > 0) {
                guionistaResults.classList.add(
                    "border",
                    "border-gray-500",
                    "rounded-lg",
                    "p-2"
                );

                // Mostrar los resultados y agregar estilos
                guionistas.forEach(function (resultado) {
                    var li = document.createElement("li");
                    li.classList.add(
                        "hover:bg-blue-200",
                        "transition",
                        "duration-300",
                        "ease-in-out"
                    );
                    li.textContent = resultado.nombre;

                    // Dentro de la función de clic del elemento LI
                    li.addEventListener("click", function () {
                        guionistaInput.value = resultado.nombre;

                        // Aquí cambia la línea para obtener el campo de entrada oculto correctamente
                        var guionistaHiddenInput = document.getElementById(
                            "guionista" + audiovisualId
                        );
                        guionistaHiddenInput.value = resultado.id;

                        // Cerrar la lista de resultados y quitar algunos estilos
                        guionistaResults.innerHTML = "";
                        guionistaResults.classList.remove(
                            "border",
                            "border-gray-300"
                        );
                    });

                    guionistaResults.appendChild(li);
                });
            } else {
                console.error("No se encontraron guionistas.");
            }
        })
        .catch(function (error) {
            console.error("Error al realizar la búsqueda:", error);
        });
}
