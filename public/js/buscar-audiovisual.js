function buscarAudiovisual() {
    return {
        searchTerm: "",
        selectedGenre: "",
        selectedType: "",
        selectedRecommendation: "",
        resultados: [],

        buscarAudiovisual2() {
            let titulo = this.searchTerm.trim().toLowerCase();
            let genero = this.selectedGenre;
            let tipo = this.selectedType;
            let recomendacion = this.selectedRecommendation;

            axios
                .get(`/buscar-audiovisual`, {
                    params: {
                        search: titulo,
                        genre: genero,
                        type: tipo,
                        recommendation: recomendacion,
                    },
                })
                .then((response) => {
                    this.resultados = response.data;
                })
                .catch((error) => {
                    console.error(error);
                });
        },
    };
}
