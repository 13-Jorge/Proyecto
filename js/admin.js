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
            content.innerHTML = `
                <h2>Notificaciones</h2>
                <ul class="list-group">
                    <li class="list-group-item">
                        Bienvenido al sistema de administración.
                        <a href="#" class="btn btn-sm btn-primary float-right" onclick="marcarLeido(this)">Marcar como leído</a>
                    </li>
                </ul>
            `;
            updateUnreadCount();
        } else if (section === 'usuarios') {
            fetch('fetchUsuarios.php')
                .then(response => response.text())
                .then(data => {
                    content.innerHTML = data;
                });
        } else {
            content.innerHTML = `<h2>Sección de ${section}</h2><p>Contenido de la sección ${section} se cargará aquí.</p>`;
        }
    }

    window.marcarLeido = function(element) {
        element.parentElement.classList.add('list-group-item-secondary');
        element.remove();
        const badge = document.querySelector('.badge-danger');
        if (badge) {
            let count = parseInt(badge.textContent);
            count--;
            if (count <= 0) {
                badge.remove();
            } else {
                badge.textContent = count;
            }
        }
    };

    function updateUnreadCount() {
        const badge = document.querySelector('.badge-danger');
        if (badge) {
            let count = document.querySelectorAll('.list-group-item:not(.list-group-item-secondary)').length;
            badge.textContent = count;
            if (count <= 0) {
                badge.remove();
            }
        }
    }

    // Cargar la sección de usuarios por defecto
    loadSection('usuarios');
});