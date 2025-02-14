<?php
session_start();
include_once '../connectDB/connect.php';

if (!isset($_SESSION['user']) || !esAdmin($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

$user = recogerValor('id');
borrarCuenta($user);

header('Location: admin.php');
exit();
?>
