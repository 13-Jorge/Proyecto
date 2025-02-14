document.addEventListener('DOMContentLoaded', function() {
    const menuItems = document.querySelectorAll('.list-group-item');
    const content = document.getElementById('content');

    menuItems.forEach(item => {
        item.addEventListener('click', function(e) {
            e.preventDefault();
            menuItems.forEach(i => i.classList.remove('active'));
            this.classList.add('active');
            const section = this.getAttribute('data-section');
            loadSection(section);
        });
    });

    function loadSection(section) {
        // Aquí cargarías el contenido de cada sección
        // Por ahora, solo mostraremos un mensaje
        content.innerHTML = `<h2>Sección de ${section}</h2><p>Contenido de la sección ${section} se cargará aquí.</p>`;
    }

    // Cargar la sección de usuarios por defecto
    loadSection('usuarios');
});