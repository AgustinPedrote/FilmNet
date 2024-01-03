function buscarCompany(audiovisualId) {
    // Obtener los datos de entrada
    var searchQuery = document
        .getElementById("search_company" + audiovisualId)
        .value.trim();

    // Obtener elementos del DOM
    var companyResults = document.getElementById(
        "companyResults" + audiovisualId
    );
    var companyInput = document.getElementById("search_company" + audiovisualId);

    // Verificar si la búsqueda está en blanco
    if (searchQuery === "") {
        // Limpiar la lista de resultados si la búsqueda está vacía
        document.getElementById("companyResults" + audiovisualId).innerHTML = "";
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
                companyResults.classList.add(
                    "border",
                    "border-gray-500",
                    "rounded-lg",
                    "p-2"
                );

                // Mostrar los resultados y agregar estilos
                companies.forEach(function (resultado) {
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
                        companyInput.value = resultado.nombre;

                        // Aquí cambia la línea para obtener el campo de entrada oculto correctamente
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
