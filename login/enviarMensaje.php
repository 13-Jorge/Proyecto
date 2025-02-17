<?php
include_once '../connectDB/connect.php';
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

$autor = $_SESSION['user'];
$mensaje = recogerValor('message');



try {
    insertarNotificacion($autor, $mensaje);
    echo "Mensaje enviado correctamente";
} catch (Exception $e) {
    echo "Error al enviar el mensaje: " . $e->getMessage();
}


?>
