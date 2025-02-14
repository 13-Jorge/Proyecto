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

actualizarPerfil($oldUser, $newUser, $nombre, $apellidos, $email, $telefono, $pass, $es_admin);

header('Location: perfil.php?user=' . $newUser);
exit();
?>
