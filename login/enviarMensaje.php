<?php
include_once '../connectDB/connect.php';
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

$autor = $_SESSION['user'];
$mensaje = recogerValor('message');

insertarNotificacion($autor, $mensaje);

echo "Mensaje enviado correctamente";
?>
