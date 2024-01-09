function buscarAudiovisual() {
    return {
        searchTerm: '',
        resultados: [],

        buscarAudiovisual2() {
            let titulo = this.searchTerm.trim().toLowerCase();

            axios.get(`/buscar-audiovisual`, {
                    params: {
                        search: titulo,
                    }
                })
                .then(response => {
                    this.resultados = response.data;
                })
                .catch(error => {
                    console.error(error);
                });
        }
    };
}
