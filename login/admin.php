<?php
session_start();
include_once '../connectDB/connect.php';

if (!isset($_SESSION['user']) || !esAdmin($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

// Aquí deberías obtener el número de notificaciones no leídas
$numNotificaciones = 5; // Ejemplo, reemplaza con la lógica real
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - CM Gestión Inmobiliaria</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="../styles/common.css">
    <link rel="stylesheet" href="../styles/admin.css">
    <script src="../js/cerrarSesion.js"></script>
    <script src="../js/admin.js"></script>
</head>
<body>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <div class="bg-light border-right" id="sidebar-wrapper">
            <div class="sidebar-heading">CM Gestión Inmobiliaria</div>
            <div class="list-group list-group-flush">
                <a href="#" class="list-group-item list-group-item-action" data-section="usuarios">
                    <i class="fas fa-users mr-2"></i>Gestión de Usuarios
                </a>
                <a href="#" class="list-group-item list-group-item-action" data-section="propiedades">
                    <i class="fas fa-home mr-2"></i>Gestión de Propiedades
                </a>
                <a href="#" class="list-group-item list-group-item-action" data-section="visitas">
                    <i class="fas fa-calendar-check mr-2"></i>Gestión de Visitas
                </a>
                <a href="#" class="list-group-item list-group-item-action" data-section="homestaging">
                    <i class="fas fa-paint-roller mr-2"></i>Gestión de Homestaging
                </a>
                <a href="#" class="list-group-item list-group-item-action" data-section="notificaciones">
                    <i class="fas fa-bell mr-2"></i>Notificaciones
                    <?php if ($numNotificaciones > 0): ?>
                        <span class="badge badge-danger ml-2"><?php echo $numNotificaciones; ?></span>
                    <?php endif; ?>
                </a>
            </div>
        </div>

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
                <button class="btn btn-primary" id="menu-toggle">Menu</button>
                <div class="ml-auto">
                    <a href="../index.php" class="btn btn-secondary mr-2">Volver al Inicio</a>
                    <button class="btn btn-danger" onclick="cerrarSesion()">Cerrar Sesión</button>
                </div>
            </nav>

            <div class="container-fluid mt-4">
                <h1 class="mt-4 mb-4">Panel de Administración</h1>
                
                <!-- Contenido dinámico -->
                <div id="content">
                    <!-- El contenido se cargará dinámicamente aquí -->
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>