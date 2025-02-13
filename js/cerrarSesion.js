function cerrarSesion() {
    if (confirm('¿Deseas cerrar sesión?')) {
        window.location.href = '/Proyecto/login/logout.php';
    }
}
