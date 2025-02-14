<?php
include_once '../connectDB/connect.php';
session_start();

if (!isset($_SESSION['user']) || !esAdmin($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

$id = recogerValor('id');
marcarNotificacionLeida($id);

header('Location: admin.php');
exit();
?>
