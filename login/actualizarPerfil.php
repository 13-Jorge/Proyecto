<?php
include_once '../connectDB/connect.php';
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

$oldUser = recogerValor('oldUser');
$newUser = recogerValor('user');
$nombre = recogerValor('nombre');
$apellidos = recogerValor('apellidos');
$email = recogerValor('email');
$telefono = recogerValor('telefono');
$pass = recogerValor('pass');
$es_admin = isset($_POST['es_admin']) ? 1 : 0;

// Check for duplicate username
if ($newUser !== $oldUser && usuarioExiste($newUser)) {
    echo "<script>
            alert('ERROR: El nombre de usuario ya está en uso.');
            window.history.back();
          </script>";
    exit();
}

// Check for duplicate email
$datosUsuario = obtenerDatosUsuario($oldUser);
if ($email !== $datosUsuario['email'] && emailExiste($email)) {
    echo "<script>
            alert('ERROR: El email ya está registrado.');
            window.history.back();
          </script>";
    exit();
}

if (!empty($pass)) {
    // Hashear la nueva contraseña si se proporciona
    $hashedPass = password_hash($pass, PASSWORD_BCRYPT);
} else {
    // Mantener la contraseña actual si no se proporciona una nueva
    $hashedPass = $datosUsuario['pass'];
}

actualizarPerfil($oldUser, $newUser, $nombre, $apellidos, $email, $telefono, $hashedPass, $es_admin);

header('Location: perfil.php?user=' . $newUser);
exit();
?>
