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
                // Agregar estilos a la lista de resultados
                guionistaResults.classList.add(
                    "border",
                    "border-gray-500",
                    "rounded-lg",
                    "p-2"
                );

                // Mostrar los resultados y agregar estilos a cada elemento de la lista
                guionistas.forEach(function (resultado) {
                    var li = document.createElement("li");
                    li.classList.add(
                        "hover:bg-blue-200",
                        "transition",
                        "duration-300",
                        "ease-in-out"
                    );
                    li.textContent = resultado.nombre;

                    // Manejar el clic en el elemento de la lista
                    li.addEventListener("click", function () {
                        // Asignar el valor del guionista seleccionado al campo de entrada
                        guionistaInput.value = resultado.nombre;

                        // Obtener el campo de entrada oculto y asignar el ID del guionista
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

                    // Agregar el elemento de la lista al contenedor de resultados
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
