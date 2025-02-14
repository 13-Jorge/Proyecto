$(document).ready(function() {
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });

    $(".list-group-item").click(function(e) {
        e.preventDefault();
        $(".list-group-item").removeClass("active");
        $(this).addClass("active");
        var section = $(this).data("section");
        loadSection(section);
    });

    function loadSection(section) {
        // Aquí cargarías el contenido de cada sección
        // Por ahora, solo mostraremos un mensaje
        $("#content").html("<h2>Sección de " + section + "</h2><p>Contenido de la sección " + section + " se cargará aquí.</p>");
    }

    // Cargar la sección de usuarios por defecto
    loadSection("usuarios");
});