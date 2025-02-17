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
    <script src="../js/cerrarSesion.js"></script>
    <script src="../js/admin.js"></script>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light fixed-top">
            <div class="container">
                <a class="navbar-brand" href="index.php">
                    <img src="../img/logo.jpg" alt="CM Gestión Inmobiliaria">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item"><a class="nav-link" href="index.php">Inicio</a></li>
                        <li class="nav-item"><a class="nav-link" href="propiedades.php">Propiedades</a></li>
                        <li class="nav-item"><a class="nav-link" href="homestaging.php">Homestaging</a></li>
                        <li class="nav-item"><a class="nav-link" href="solicitarVisita.php">Solicitar Visita</a></li>
                        <li class="nav-item"><a class="nav-link" href="contacto.php">Contacto</a></li>
                    </ul>
                    <div class="user-info d-flex align-items-center ml-3">
                        <?php if (isset($_SESSION['user'])): ?>
                            <img src="../img/user.svg" alt="User Icon" class="rounded-circle mr-2" style="width: 30px; height: 30px;">
                            <a href="<?php echo esAdmin($_SESSION['user']) ? 'login/admin.php' : 'login/perfil.php'; ?>" class="btn btn-outline-light mr-2"><?php echo htmlspecialchars($_SESSION['user']); ?></a>
                            <button class="btn btn-outline-light" onclick="cerrarSesion()">Cerrar Sesión</button>
                        <?php else: ?>
                            <button class="btn btn-outline-light" onclick="window.location.href='login/login.php'">Iniciar Sesión</button>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </nav>
    </header>
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