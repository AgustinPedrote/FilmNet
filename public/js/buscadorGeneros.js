function buscarGenero() {
    // Obtener los datos de entrada
    var searchQuery = document.getElementById("search_genero").value.trim();

    // Obtener elementos del DOM
    var generoResults = document.getElementById("generoResults");

    // Verificar si la búsqueda está en blanco
    if (searchQuery === "") {
        // Limpiar la lista de resultados si la búsqueda está vacía
        generoResults.innerHTML = "";
        generoResults.classList.remove("border", "border-gray-300");
        return;
    }

    // Realizar la búsqueda con AJAX
    axios
        .get("/busqueda/genero", {
            params: {
                query: searchQuery,
            },
        })
        .then(function (response) {
            // Limpiar la lista de resultados y agregar estilos
            generoResults.innerHTML = "";
            generoResults.classList.remove("border", "border-gray-300");

            // Mostrar los resultados y agregar estilos
            if (response.data && response.data.generos) {
                response.data.generos.forEach(function (resultado) {
                    var li = document.createElement("li");
                    li.classList.add(
                        "hover:bg-blue-200",
                        "transition",
                        "duration-300",
                        "ease-in-out"
                    );
                    li.textContent = resultado.nombre;

                    // Agregar un evento de clic y asignar el valor del resultado al campo de entrada oculto
                    li.addEventListener("click", function () {
                        // Asignar el valor del resultado al campo de entrada oculto
                        document.getElementById("genero").value =
                            resultado.nombre;

                        // Asignar el valor del resultado al campo de entrada visible
                        document.getElementById("search_genero").value =
                            resultado.nombre;

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
                console.error(
                    "La propiedad 'generos' no está presente en la respuesta o no es un array."
                );
            }
        })
        .catch(function (error) {
            console.error("Error al realizar la búsqueda:", error);
        });
}
