<?php
session_start();
include_once '../connectDB/connect.php';

// Verificar que el usuario es un administrador
if (!isset($_SESSION['user']) || !esAdmin($_SESSION['user'])) {
    echo '<div class="alert alert-danger">No tienes permisos para acceder a esta sección.</div>';
    exit();
}
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
                    <p class="card-text">Propiedades Activas</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-3 col-sm-6 mb-4">
            <div class="card stat-card">
                <div class="card-body text-center">
                    <i class="fas fa-calendar-check fa-3x mb-3 text-primary"></i>
                    <h3 class="counter"><?php echo $totalVisitas; ?></h3>
                    <p class="card-text">Visitas Totales</p>
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
                    <i class="fas fa-user-plus mr-2"></i>Nuevo Usuario
                </a>
            </div>
            <div class="col-md-4 mb-3">
                <a href="#" class="btn btn-gold btn-block btn-lg" data-section="visitas">
                    <i class="fas fa-calendar-plus mr-2"></i>Programar Visita
                </a>
            </div>
        </div>
    </div>
</div>

<script>
    // Añadir event listeners a los botones de acciones rápidas
    document.addEventListener('DOMContentLoaded', function() {
        const quickActionButtons = document.querySelectorAll('.quick-actions-container .btn');
        
        quickActionButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const section = this.getAttribute('data-section');
                
                // Actualizar la clase active en el menú
                const menuItems = document.querySelectorAll('.list-group-item');
                menuItems.forEach(item => item.classList.remove('active'));
                document.querySelector(`.list-group-item[data-section="${section}"]`).classList.add('active');
                
                // Cargar la sección
                loadSection(section);
            });
        });
    });
</script>