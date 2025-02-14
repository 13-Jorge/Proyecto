function borrarCuenta(user) {
    if (confirm('¿Deseas borrar esta cuenta?')) {
        window.location.href = `../login/borrarCuenta.php?user=${user}`;
    }
}
