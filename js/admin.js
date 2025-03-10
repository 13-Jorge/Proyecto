document.addEventListener('DOMContentLoaded', function() {
    const menuItems = document.querySelectorAll('.list-group-item');
    const content = document.getElementById('content');
    const menuToggle = document.getElementById('menu-toggle');
    const wrapper = document.getElementById('wrapper');
    
    // Función para comprobar si estamos en un dispositivo móvil/tablet
    function isMobileOrTablet() {
        return window.innerWidth <= 991;
    }

    menuItems.forEach(item => {
        item.addEventListener('click', function(e) {
            e.preventDefault();
            menuItems.forEach(i => i.classList.remove('active'));
            this.classList.add('active');
            const section = this.getAttribute('data-section');
            loadSection(section);
            
            // Si estamos en móvil/tablet, replegar el sidebar al seleccionar una sección
            if (isMobileOrTablet()) {
                wrapper.classList.remove('toggled');
            }
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
        } else if (section === 'homestaging') {
            fetch('fetchHomestaging.php')
                .then(response => response.text())
                .then(data => {
                    content.innerHTML = data;
                })
                .catch(error => {
                    content.innerHTML = `<h2>Sección de Homestaging</h2><p>Contenido de la sección de Homestaging se cargará aquí.</p>`;
                });
        } else {
            content.innerHTML = `<h2>Sección de ${section}</h2><p>Contenido de la sección ${section} se cargará aquí.</p>`;
        }
    }

    // Cargar la sección de usuarios por defecto
    loadSection('usuarios');
    
    // Ajustar cuando se redimensiona la ventana
    window.addEventListener('resize', function() {
        if (!isMobileOrTablet()) {
            // En pantallas grandes, asegurarse de que el sidebar está visible
            wrapper.classList.remove('toggled');
        }
    });
});