function buscarReparto(audiovisualId) {
    // Obtener los datos de entrada
    var searchQuery = document
        .getElementById("search_reparto" + audiovisualId)
        .value.trim();

    // Obtener elementos del DOM
    var repartoResults = document.getElementById(
        "repartoResults" + audiovisualId
    );
    var repartoInput = document.getElementById(
        "search_reparto" + audiovisualId
    );

    // Verificar si la búsqueda está en blanco
    if (searchQuery === "") {
        // Limpiar la lista de resultados si la búsqueda está vacía
        document.getElementById("repartoResults" + audiovisualId).innerHTML =
            "";
        repartoResults.classList.remove("border", "border-gray-300");
        return;
    }

    // Realizar la búsqueda con AJAX
    // Solicitud GET asíncrona a la ruta pasándole el parámetro de consulta
    axios
        .get("/busqueda/reparto", {
            params: {
                query: searchQuery,
            },
        })
        .then(function (response) {
            // Limpiar la lista de resultados y agregar estilos
            repartoResults.innerHTML = "";

            var repartos = response.data.repartos;

            if (Array.isArray(repartos) && repartos.length > 0) {
                repartoResults.classList.add(
                    "border",
                    "border-gray-500",
                    "rounded-lg",
                    "p-2"
                );

                // Mostrar los resultados y agregar estilos
                repartos.forEach(function (resultado) {
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
                        repartoInput.value = resultado.nombre;

                        // Aquí cambia la línea para obtener el campo de entrada oculto correctamente
                        var repartoHiddenInput = document.getElementById(
                            "reparto" + audiovisualId
                        );
                        repartoHiddenInput.value = resultado.id;

                        // Cerrar la lista de resultados y quitar algunos estilos
                        repartoResults.innerHTML = "";
                        repartoResults.classList.remove(
                            "border",
                            "border-gray-300"
                        );
                    });

                    repartoResults.appendChild(li);
                });
            } else {
                console.error("No se encontraron repartos.");
            }
        })
        .catch(function (error) {
            console.error("Error al realizar la búsqueda:", error);
        });
}
