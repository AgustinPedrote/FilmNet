function buscarFotografia(audiovisualId) {
    // Obtener los datos de entrada
    var searchQuery = document
        .getElementById("search_fotografia" + audiovisualId)
        .value.trim();

    // Obtener elementos del DOM relacionados con la búsqueda
    var fotografiaResults = document.getElementById(
        "fotografiaResults" + audiovisualId
    );
    var fotografiaInput = document.getElementById(
        "search_fotografia" + audiovisualId
    );

    // Verificar si la búsqueda está en blanco
    if (searchQuery === "") {
        // Limpiar la lista de resultados si la búsqueda está vacía
        document.getElementById("fotografiaResults" + audiovisualId).innerHTML =
            "";
        fotografiaResults.classList.remove("border", "border-gray-300");
        return;
    }

    // Realizar la búsqueda con AJAX
    // Solicitud GET asíncrona a la ruta pasándole el parámetro de consulta
    axios
        .get("/busqueda/fotografia", {
            params: {
                query: searchQuery,
            },
        })
        .then(function (response) {
            // Limpiar la lista de resultados y agregar estilos
            fotografiaResults.innerHTML = "";

            var fotografias = response.data.fotografias;

            if (Array.isArray(fotografias) && fotografias.length > 0) {
                // Agregar estilos a la lista de resultados
                fotografiaResults.classList.add(
                    "border",
                    "border-gray-500",
                    "rounded-lg",
                    "p-2"
                );

                // Mostrar los resultados y agregar estilos a cada elemento de la lista
                fotografias.forEach(function (resultado) {
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
                        // Asignar el valor de la fotografía seleccionada al campo de entrada
                        fotografiaInput.value = resultado.nombre;

                        // Obtener el campo de entrada oculto y asignar el ID de la fotografía
                        var fotografiaHiddenInput = document.getElementById(
                            "fotografia" + audiovisualId
                        );
                        fotografiaHiddenInput.value = resultado.id;

                        // Cerrar la lista de resultados y quitar algunos estilos
                        fotografiaResults.innerHTML = "";
                        fotografiaResults.classList.remove(
                            "border",
                            "border-gray-300"
                        );
                    });

                    // Agregar el elemento de la lista al contenedor de resultados
                    fotografiaResults.appendChild(li);
                });
            } else {
                console.error("No se encontraron directores de fotografias.");
            }
        })
        .catch(function (error) {
            console.error("Error al realizar la búsqueda:", error);
        });
}
