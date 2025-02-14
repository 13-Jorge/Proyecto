<?php
session_start();
include_once '../connectDB/connect.php';

if (!isset($_SESSION['user']) || !esAdmin($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

$id = recogerValor('id');
$pdo = connectDB();
if ($pdo != null) {
    $consulta = "DELETE FROM login WHERE id = :id";
    $resul = $pdo->prepare($consulta);
    $resul->execute(['id' => $id]);
}

header('Location: admin.php');
exit();
?>
