function buscarAudiovisual() {
    return {
        searchTerm: "",
        selectedGenre: "",
        resultados: [],

        buscarAudiovisual2() {
            let titulo = this.searchTerm.trim().toLowerCase();
            let genero = this.selectedGenre;

            axios
                .get(`/buscar-audiovisual`, {
                    params: {
                        search: titulo,
                        genre: genero,
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
