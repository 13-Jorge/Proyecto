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

if (!empty($pass)) {
    // Hashear la nueva contraseña si se proporciona
    $hashedPass = password_hash($pass, PASSWORD_BCRYPT);
} else {
    // Mantener la contraseña actual si no se proporciona una nueva
    $datosUsuario = obtenerDatosUsuario($oldUser);
    $hashedPass = $datosUsuario['pass'];
}

actualizarPerfil($oldUser, $newUser, $nombre, $apellidos, $email, $telefono, $hashedPass, $es_admin);

header('Location: perfil.php?user=' . $newUser);
exit();
?>
