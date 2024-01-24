function goBack() {
    window.history.back();
}

function buscarAmigo() {
    var searchQuery = document.getElementById("search_amigo").value.trim();
    var amigoResults = document.getElementById("amigoResults");

    if (searchQuery === "") {
        amigoResults.innerHTML = "";
        return;
    }

    axios.get("/busqueda/amigo", {
            params: {
                query: searchQuery,
            },
        })
        .then(function(response) {
            amigoResults.innerHTML = "";
            var amigos = response.data.amigos;

            if (Array.isArray(amigos) && amigos.length > 0) {
                amigoResults.classList.add("border", "border-gray-500", "rounded-lg", "p-2");

                amigos.forEach(function(resultado) {
                    var li = document.createElement("li");
                    li.classList.add(
                        "hover:bg-blue-200",
                        "transition",
                        "duration-300",
                        "ease-in-out"
                    );
                    li.textContent = resultado.name;

                    li.addEventListener("click", function() {
                        document.getElementById("search_amigo").value = resultado.name;

                        // Cambia la línea para obtener el campo de entrada oculto correctamente
                        var amigoHiddenInput = document.getElementById("amigoId");
                        amigoHiddenInput.value = resultado.id;

                        // Cerrar la lista de resultados y quitar algunos estilos
                        amigoResults.innerHTML = "";
                        amigoResults.classList.remove("border", "border-gray-300");
                    });

                    amigoResults.appendChild(li);
                });
            } else {
                console.error("No se encontraron amigos.");
                amigoResults.innerHTML = "<li>No se encontraron amigos.</li>";
            }
        })
        .catch(function(error) {
            console.error("Error al realizar la búsqueda:", error);
            amigoResults.innerHTML = "<li>Error en la búsqueda.</li>";
        });
}
