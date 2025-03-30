<?php
include_once '../connectDB/connect.php';
session_start();

if (!isset($_SESSION['user']) || !esAdmin($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = intval($_POST['id']);
    $pdo = connectDB();

    if ($pdo != null) {
        $query = "DELETE FROM homestaging WHERE id = :id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            header('Location: admin.php?success=1');
            exit();
        } else {
            header('Location: admin.php?error=1');
            exit();
        }
    }
}
header('Location: admin.php?error=1');
exit();
?>