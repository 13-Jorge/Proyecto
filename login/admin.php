<?php
session_start();
include_once '../connectDB/connect.php';

if (!isset($_SESSION['user']) || !esAdmin($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

// Fetch notifications
$notificaciones = obtenerNotificaciones();
$numNotificaciones = count(array_filter($notificaciones, function ($notificacion) {
    return !$notificacion['leido'];
}));
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
    <link rel="stylesheet" href="../styles/inicio-admin.css">
    <script src="../js/cerrarSesion.js"></script>
</head>

<body class="admin-page">
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <!-- Contenedor separado para el botón de cierre -->
            <div class="close-btn-container">
                <button class="close-btn" id="close-sidebar">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            
            <!-- Logo centrado -->
            <div class="sidebar-logo-container">
                <a href="../index.php">
                    <img src="../img/logo.jpg" alt="CM Gestión Inmobiliaria" class="sidebar-logo">
                </a>
            </div>
            
            <!-- Menú de navegación -->
            <div class="list-group list-group-flush">
                <a href="#" class="list-group-item list-group-item-action active" data-section="inicio">
                    <i class="fas fa-tachometer-alt mr-2"></i>Inicio
                </a>
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
            
            <!-- Logout button at the bottom -->
            <div class="logout-container">
                <button class="btn btn-outline-light" onclick="cerrarSesion()">
                    <i class="fas fa-sign-out-alt mr-2"></i>Cerrar Sesión
                </button>
            </div>
        </div>

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom mt-3">
                <button class="btn btn-primary" id="menu-toggle">
                    <i class="fas fa-bars"></i> Menu
                </button>
            </nav>

            <div class="container-fluid mt-4">
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
    <script src="../js/admin.js"></script>
</body>

</html>