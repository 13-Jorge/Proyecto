function cerrarSesion() {
    if (confirm('¿Deseas cerrar sesión?')) {
        window.location.href = '../login/logout.php';
    }
}
