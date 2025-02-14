<?php
session_start();
include_once '../connectDB/connect.php';

if (!isset($_SESSION['user']) || !esAdmin($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

$id = recogerValor('user');
$pdo = connectDB();
if ($pdo != null) {
    $consulta = "DELETE FROM login WHERE user = :user";
    $resul = $pdo->prepare($consulta);
    $resul->execute(['user' => $id]);
}

header('Location: admin.php');
exit();
?>
