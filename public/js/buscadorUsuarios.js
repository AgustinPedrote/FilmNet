// Temporizador de búsqueda
var searchTimeout;

function buscarAmigo() {
    // Obtener el valor de búsqueda del campo de entrada
    var searchQuery = document.getElementById("search_amigo").value.trim();
    // Obtener el elemento de resultados
    var amigoResults = document.getElementById("amigoResults");

    // Cancelar búsqueda anterior si existe
    clearTimeout(searchTimeout);

    // Establecer un temporizador antes de realizar la búsqueda para evitar solicitudes excesivas
    searchTimeout = setTimeout(function () {
        // Si la consulta de búsqueda está vacía, limpiar los resultados y ocultar la lista
        if (searchQuery === "") {
            amigoResults.style.display = "none";
            amigoResults.innerHTML = "";
            return;
        }

        // Realizar una solicitud GET al servidor para obtener los amigos que coincidan con la consulta
        axios
            .get("/busqueda/amigo", {
                params: { query: searchQuery },
            })
            .then(function (response) {
                // Limpiar los resultados anteriores
                amigoResults.innerHTML = "";
                // Obtener la lista de amigos del objeto de respuesta
                var amigos = response.data.amigos;

                // Si se encontraron amigos, mostrarlos en la lista de resultados
                if (Array.isArray(amigos) && amigos.length > 0) {
                    amigos.forEach(function (resultado) {
                        var li = document.createElement("li");
                        // Agregar clases de estilo al elemento de lista
                        li.classList.add(
                            "px-4",
                            "py-2",
                            "cursor-pointer",
                            "hover:bg-blue-200",
                            "transition",
                            "duration-300",
                            "ease-in-out"
                        );
                        // Establecer el texto del elemento de lista como el nombre del amigo
                        li.textContent = resultado.name;

                        // Agregar un evento de clic para manejar la selección de amigo
                        li.addEventListener("click", function () {
                            document.getElementById("search_amigo").value =
                                resultado.name;

                            var amigoHiddenInput =
                                document.getElementById("amigoId");
                            amigoHiddenInput.value = resultado.id;

                            // Ocultar la lista de resultados después de seleccionar un amigo
                            amigoResults.style.display = "none";
                        });

                        // Agregar el elemento de lista a la lista de resultados
                        amigoResults.appendChild(li);
                    });

                    // Mostrar la lista de resultados
                    amigoResults.style.display = "block";
                } else {
                    // Si no se encontraron amigos, mostrar un mensaje de error en la lista de resultados
                    console.error("No se encontraron amigos.");
                    amigoResults.innerHTML =
                        "<li class='px-4 py-2'>No se encontraron amigos.</li>";
                    amigoResults.style.display = "block";
                }
            })
            .catch(function (error) {
                // Manejar errores de solicitud mostrando un mensaje de error en la lista de resultados
                console.error("Error al realizar la búsqueda:", error);
                amigoResults.innerHTML =
                    "<li class='px-4 py-2'>Error en la búsqueda.</li>";
                amigoResults.style.display = "block";
            });
    }, 300); // Establecer un retraso antes de iniciar la búsqueda
}
