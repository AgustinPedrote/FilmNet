function buscarGenero(audiovisualId) {
    // Obtener los datos de entrada
    var searchQuery = document
        .getElementById("search_genero" + audiovisualId)
        .value.trim();

    // Obtener elementos del DOM
    var generoResults = document.getElementById(
        "generoResults" + audiovisualId
    );
    var generoInput = document.getElementById("search_genero" + audiovisualId);

    // Verificar si la búsqueda está en blanco
    if (searchQuery === "") {
        // Limpiar la lista de resultados si la búsqueda está vacía
        document.getElementById("generoResults" + audiovisualId).innerHTML = "";
        generoResults.classList.remove("border", "border-gray-300");
        return;
    }

    // Realizar la búsqueda con AJAX
    // Solicitud GET asíncrona a la ruta pasándole el parámetro de consulta
    axios
        .get("/busqueda/genero", {
            params: {
                query: searchQuery,
            },
        })
        .then(function (response) {
            // Limpiar la lista de resultados y agregar estilos
            generoResults.innerHTML = "";

            var generos = response.data.generos;

            if (Array.isArray(generos) && generos.length > 0) {
                generoResults.classList.add(
                    "border",
                    "border-gray-500",
                    "rounded-lg",
                    "p-2"
                );

                // Mostrar los resultados y agregar estilos
                generos.forEach(function (resultado) {
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
                        generoInput.value = resultado.nombre;

                        // Aquí cambia la línea para obtener el campo de entrada oculto correctamente
                        var generoHiddenInput = document.getElementById(
                            "genero" + audiovisualId
                        );
                        generoHiddenInput.value = resultado.id;

                        // Cerrar la lista de resultados y quitar algunos estilos
                        generoResults.innerHTML = "";
                        generoResults.classList.remove(
                            "border",
                            "border-gray-300"
                        );
                    });

                    generoResults.appendChild(li);
                });
            } else {
                console.error("No se encontraron géneros.");
            }
        })
        .catch(function (error) {
            console.error("Error al realizar la búsqueda:", error);
        });
}
