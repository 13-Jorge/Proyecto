function borrarCuenta() {
    if (confirm('¿Estás seguro de que deseas borrar tu cuenta?')) {
        window.location.href = '../login/borrarCuenta.php';
    }
}
