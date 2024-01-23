function buscarCompany(audiovisualId) {
    // Obtener los datos de entrada
    var searchQuery = document
        .getElementById("search_company" + audiovisualId)
        .value.trim();

    // Obtener elementos del DOM
    var companyResults = document.getElementById(
        "companyResults" + audiovisualId
    );
    var companyInput = document.getElementById(
        "search_company" + audiovisualId
    );

    // Verificar si la búsqueda está en blanco
    if (searchQuery === "") {
        // Limpiar la lista de resultados si la búsqueda está vacía
        document.getElementById("companyResults" + audiovisualId).innerHTML =
            "";
        companyResults.classList.remove("border", "border-gray-300");
        return;
    }

    // Realizar la búsqueda con AJAX
    // Solicitud GET asíncrona a la ruta pasándole el parámetro de consulta
    axios
        .get("/busqueda/company", {
            params: {
                query: searchQuery,
            },
        })
        .then(function (response) {
            // Limpiar la lista de resultados y agregar estilos
            companyResults.innerHTML = "";

            var companies = response.data.companies;

            if (Array.isArray(companies) && companies.length > 0) {
                // Agregar estilos a la lista de resultados
                companyResults.classList.add(
                    "border",
                    "border-gray-500",
                    "rounded-lg",
                    "p-2"
                );

                // Mostrar los resultados y agregar estilos a cada elemento de la lista
                companies.forEach(function (resultado) {
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
                        // Asignar el valor de la compañía seleccionada al campo de entrada
                        companyInput.value = resultado.nombre;

                        // Obtener el campo de entrada oculto y asignar el ID de la compañía
                        var companyHiddenInput = document.getElementById(
                            "company" + audiovisualId
                        );
                        companyHiddenInput.value = resultado.id;

                        // Cerrar la lista de resultados y quitar algunos estilos
                        companyResults.innerHTML = "";
                        companyResults.classList.remove(
                            "border",
                            "border-gray-300"
                        );
                    });

                    // Agregar el elemento de la lista al contenedor de resultados
                    companyResults.appendChild(li);
                });
            } else {
                console.error("No se encontraron compañías.");
            }
        })
        .catch(function (error) {
            console.error("Error al realizar la búsqueda:", error);
        });
}
