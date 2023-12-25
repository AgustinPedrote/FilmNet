document.addEventListener("DOMContentLoaded", function () {
    var scrollToTopButton = document.getElementById("scroll-to-top");

    window.addEventListener("scroll", function () {
        // Muestra la flecha cuando el scroll está más abajo de 200 píxeles
        if (window.scrollY > 200) {
            scrollToTopButton.classList.remove("hidden");
        } else {
            scrollToTopButton.classList.add("hidden");
        }
    });

    // Desplázate suavemente al principio de la página cuando se hace clic en la flecha
    scrollToTopButton.addEventListener("click", function () {
        window.scrollTo({
            top: 0,
            behavior: "smooth",
        });
    });
});
