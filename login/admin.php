<?php
session_start();
include_once '../connectDB/connect.php';

if (!isset($_SESSION['user']) || !esAdmin($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - CM Gestión Inmobiliaria</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../styles/admin.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Panel de Administración</h1>
        <div class="card p-4 mt-3">
            <p>Bienvenido, <?php echo htmlspecialchars($_SESSION['user']); ?>. Aquí puedes gestionar el sitio.</p>
            <!-- Admin content goes here -->
        </div>
    </div>
</body>
</html>
