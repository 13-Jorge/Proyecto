<?php
session_start();
include_once '../connectDB/connect.php';

// Verificar que el usuario es un administrador
if (!isset($_SESSION['user']) || !esAdmin($_SESSION['user'])) {
    echo '<div class="alert alert-danger">No tienes permisos para acceder a esta sección.</div>';
    exit();
}

// Función para contar el total de usuarios
function contarUsuarios() {
    $pdo = connectDB();
    if ($pdo != null) {
        $consulta = "SELECT COUNT(*) FROM login";
        $resul = $pdo->query($consulta);
        return $resul->fetchColumn();
    }
    return 0;
}

// Función para contar el total de propiedades
function contarPropiedades() {
    $pdo = connectDB();
    if ($pdo != null) {
        $consulta = "SELECT COUNT(*) FROM propiedades";
        $resul = $pdo->query($consulta);
        return $resul->fetchColumn();
    }
    return 0;
}

// Función para contar solicitudes pendientes (visitas solicitadas que no están en visitasConfirmadas)
function contarSolicitudesPendientes() {
    $pdo = connectDB();
    if ($pdo != null) {
        $consulta = "SELECT COUNT(*) FROM visitasSolicitadas WHERE id NOT IN (SELECT id_solicitud FROM visitasConfirmadas)";
        $resul = $pdo->query($consulta);
        return $resul->fetchColumn();
    }
    return 0;
}

// Función para contar las visitas programadas para hoy
function contarVisitasHoy() {
    $pdo = connectDB();
    if ($pdo != null) {
        // Obtener la fecha actual en formato dd/mm/yyyy para que coincida con la base de datos
        $fechaHoy = date('d/m/Y'); // Usamos '/' en lugar de '-' para el formato
        
        // Consulta para encontrar registros que coincidan con la fecha de hoy
        $consulta = "SELECT COUNT(*) FROM visitasConfirmadas WHERE fecha = :fechaHoy";
        $resul = $pdo->prepare($consulta);
        $resul->execute(['fechaHoy' => $fechaHoy]);
        return $resul->fetchColumn();
    }
    return 0;
}
// Obtener las estadísticas
$totalUsuarios = contarUsuarios();
$totalPropiedades = contarPropiedades();
$solicitudesPendientes = contarSolicitudesPendientes();
$visitasHoy = contarVisitasHoy();
?>

<div class="inicio-container">
    <div class="welcome-section">
        <h1>Bienvenido al Panel de Administración</h1>
        <p>Gestión integral de CM Gestión Inmobiliaria</p>
    </div>
    
    <div class="row stats-row mt-4">
        <div class="col-md-3 col-sm-6 mb-4">
            <div class="card stat-card">
                <div class="card-body text-center">
                    <i class="fas fa-users fa-3x mb-3 text-primary"></i>
                    <h3 class="counter"><?php echo $totalUsuarios; ?></h3>
                    <p class="card-text">Usuarios Registrados</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-3 col-sm-6 mb-4">
            <div class="card stat-card">
                <div class="card-body text-center">
                    <i class="fas fa-home fa-3x mb-3 text-primary"></i>
                    <h3 class="counter"><?php echo $totalPropiedades; ?></h3>
                    <p class="card-text">Propiedades</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-3 col-sm-6 mb-4">
            <div class="card stat-card">
                <div class="card-body text-center">
                    <i class="fas fa-calendar-check fa-3x mb-3 text-primary"></i>
                    <h3 class="counter"><?php echo $solicitudesPendientes; ?></h3>
                    <p class="card-text">Solicitudes Pendientes</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-3 col-sm-6 mb-4">
            <div class="card stat-card">
                <div class="card-body text-center">
                    <i class="fas fa-calendar-day fa-3x mb-3 text-primary"></i>
                    <h3 class="counter"><?php echo $visitasHoy; ?></h3>
                    <p class="card-text">Visitas Hoy</p>
                </div>
            </div>
        </div>
    </div>
    
    <div class="logo-container mt-5 mb-5">
        <img src="../img/logo-admin.png" alt="CM Gestión Inmobiliaria" class="img-fluid central-logo">
    </div>
    
    <div class="quick-actions-container mt-5">
        <h2 class="mb-4">Acciones Rápidas</h2>
        <div class="row">
            <div class="col-md-4 mb-3">
                <a href="#" class="btn btn-gold btn-block btn-lg" data-section="propiedades">
                    <i class="fas fa-plus-circle mr-2"></i>Nueva Propiedad
                </a>
            </div>
            <div class="col-md-4 mb-3">
                <a href="#" class="btn btn-gold btn-block btn-lg" data-section="usuarios">
                    <i class="fas fa-user-plus mr-2"></i>Nuevo Agente
                </a>
            </div>
            <div class="col-md-4 mb-3">
                <a href="#" class="btn btn-gold btn-block btn-lg" data-section="visitas">
                    <i class="fas fa-calendar-plus mr-2"></i>Programar Homestaging
                </a>
            </div>
        </div>
    </div>
</div>
