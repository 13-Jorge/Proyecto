document.addEventListener('DOMContentLoaded', function() {
    const menuItems = document.querySelectorAll('.list-group-item');
    const content = document.getElementById('content');
    const menuToggle = document.getElementById('menu-toggle');
    const wrapper = document.getElementById('wrapper');

    menuItems.forEach(item => {
        item.addEventListener('click', function(e) {
            e.preventDefault();
            menuItems.forEach(i => i.classList.remove('active'));
            this.classList.add('active');
            const section = this.getAttribute('data-section');
            loadSection(section);
        });
    });

    menuToggle.addEventListener('click', function(e) {
        e.preventDefault();
        wrapper.classList.toggle('toggled');
    });

    function loadSection(section) {
        if (section === 'notificaciones') {
            fetch('fetchNotificaciones.php')
                .then(response => response.text())
                .then(data => {
                    content.innerHTML = data;
                });
        } else if (section === 'usuarios') {
            fetch('fetchUsuarios.php')
                .then(response => response.text())
                .then(data => {
                    content.innerHTML = data;
                });
        } else if (section === 'propiedades') {
            fetch('fetchPropiedades.php')
                .then(response => response.text())
                .then(data => {
                    content.innerHTML = data;
                });
        } else if (section === 'visitas') {
            fetch('fetchVisitas.php')
                .then(response => response.text())
                .then(data => {
                    content.innerHTML = data;
                });
        } else {
            content.innerHTML = `<h2>Sección de ${section}</h2><p>Contenido de la sección ${section} se cargará aquí.</p>`;
        }
    }

    // Cargar la sección de usuarios por defecto
    loadSection('usuarios');
});