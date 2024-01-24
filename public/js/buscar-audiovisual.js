function buscarAudiovisual() {
    return {
        // Propiedades para almacenar los parámetros de búsqueda y los resultados
        searchTerm: "",
        selectedGenre: "",
        selectedType: "",
        selectedRecommendation: "",
        resultados: [],

        buscarAudiovisual2() {
            // Preparación de parámetros de búsqueda
            let titulo = this.searchTerm.trim().toLowerCase();
            let genero = this.selectedGenre;
            let tipo = this.selectedType;
            let recomendacion = this.selectedRecommendation;

            // Realizar una solicitud HTTP GET utilizando Axios
            axios
                .get(`/buscar-audiovisual`, {
                    params: {
                        search: titulo,
                        genre: genero,
                        type: tipo,
                        recommendation: recomendacion,
                    },
                })
                // Manejar la respuesta exitosa
                .then((response) => {
                    this.resultados = response.data;
                })
                // Manejar errores durante la solicitud HTTP
                .catch((error) => {
                    console.error(error);
                });
        },
    };
}
