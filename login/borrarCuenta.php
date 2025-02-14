<?php
include_once '../connectDB/connect.php';
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

$user = recogerValor('user');
borrarCuenta($user);
?>
