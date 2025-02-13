<?php
include_once '../connectDB/connect.php';
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

$oldUser = $_SESSION['user'];
$newUser = recogerValor('user');
$nombre = recogerValor('nombre');
$apellidos = recogerValor('apellidos');
$email = recogerValor('email');
$telefono = recogerValor('telefono');
$pass = recogerValor('pass');

actualizarPerfil($oldUser, $newUser, $nombre, $apellidos, $email, $telefono, $pass);
?>
