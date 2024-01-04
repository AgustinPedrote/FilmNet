function buscarFotografia(audiovisualId) {
    // Obtener los datos de entrada
    var searchQuery = document
        .getElementById("search_fotografia" + audiovisualId)
        .value.trim();

    // Obtener elementos del DOM
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
                fotografiaResults.classList.add(
                    "border",
                    "border-gray-500",
                    "rounded-lg",
                    "p-2"
                );

                // Mostrar los resultados y agregar estilos
                fotografias.forEach(function (resultado) {
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
                        fotografiaInput.value = resultado.nombre;

                        // Aquí cambia la línea para obtener el campo de entrada oculto correctamente
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
