<?php
include_once '../connectDB/connect.php';
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

$autor = $_SESSION['user'];
$mensaje = recogerValor('message');

$query = "INSERT INTO mensajes (autor, mensaje) VALUES ('$autor', '$mensaje')";
$result = mysqli_query($conn, $query);

if ($result) {
    insertarNotificacion($autor, $mensaje);
    echo "Mensaje enviado correctamente";
} else {
    echo "Error al enviar el mensaje";
}
?>
