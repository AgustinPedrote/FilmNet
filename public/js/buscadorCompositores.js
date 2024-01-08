function buscarCompositor(audiovisualId) {
    // Obtener los datos de entrada
    var searchQuery = document
        .getElementById("search_compositor" + audiovisualId)
        .value.trim();

    // Obtener elementos del DOM
    var compositorResults = document.getElementById(
        "compositorResults" + audiovisualId
    );
    var compositorInput = document.getElementById(
        "search_compositor" + audiovisualId
    );

    // Verificar si la búsqueda está en blanco
    if (searchQuery === "") {
        // Limpiar la lista de resultados si la búsqueda está vacía
        document.getElementById("compositorResults" + audiovisualId).innerHTML =
            "";
        compositorResults.classList.remove("border", "border-gray-300");
        return;
    }

    // Realizar la búsqueda con AJAX
    // Solicitud GET asíncrona a la ruta pasándole el parámetro de consulta
    axios
        .get("/busqueda/compositor", {
            params: {
                query: searchQuery,
            },
        })
        .then(function (response) {
            // Limpiar la lista de resultados y agregar estilos
            compositorResults.innerHTML = "";

            var compositores = response.data.compositores;

            if (Array.isArray(compositores) && compositores.length > 0) {
                compositorResults.classList.add(
                    "border",
                    "border-gray-500",
                    "rounded-lg",
                    "p-2"
                );

                // Mostrar los resultados y agregar estilos
                compositores.forEach(function (resultado) {
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
                        compositorInput.value = resultado.nombre;

                        // Aquí cambia la línea para obtener el campo de entrada oculto correctamente
                        var compositorHiddenInput = document.getElementById(
                            "compositor" + audiovisualId
                        );
                        compositorHiddenInput.value = resultado.id;

                        // Cerrar la lista de resultados y quitar algunos estilos
                        compositorResults.innerHTML = "";
                        compositorResults.classList.remove(
                            "border",
                            "border-gray-300"
                        );
                    });

                    compositorResults.appendChild(li);
                });
            } else {
                console.error("No se encontraron compositores.");
            }
        })
        .catch(function (error) {
            console.error("Error al realizar la búsqueda:", error);
        });
}
