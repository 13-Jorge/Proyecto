<?php
include_once '../connectDB/connect.php';
session_start();

if (!isset($_SESSION['user']) || !esAdmin($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

$notificaciones = obtenerNotificaciones();
?>

<style>
    .notificaciones-container {
        width: 100%;
        max-width: 800px;
        margin: 0 auto;
    }
    
    .notificacion-item {
        border: 1px solid #ddd;
        border-radius: 5px;
        padding: 15px;
        margin-bottom: 10px;
        background-color: #fff;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    
    .notificacion-leida {
        background-color: #f8f9fa;
    }
    
    .notificacion-campo {
        display: block;
        margin-bottom: 8px;
    }
    
    .notificacion-mensaje {
        white-space: normal;
        word-wrap: break-word;
        margin-top: 10px;
        padding-top: 10px;
        border-top: 1px solid #eee;
    }
    
    .notificacion-accion {
        margin-top: 10px;
        text-align: right;
    }
    
    .btn-leer {
        display: inline-block;
        padding: 5px 10px;
        background-color: #007bff;
        color: white;
        text-decoration: none;
        border-radius: 3px;
        font-size: 14px;
    }
</style>

<div class="notificaciones-container">
    <?php foreach ($notificaciones as $notificacion): ?>
        <div class="notificacion-item <?php echo $notificacion['leido'] ? 'notificacion-leida' : ''; ?>">
            <span class="notificacion-campo"><strong>Email:</strong> <?php echo htmlspecialchars($notificacion['email']); ?></span>
            <span class="notificacion-campo"><strong>Fecha:</strong> <?php echo htmlspecialchars($notificacion['fecha']); ?></span>
            <div class="notificacion-mensaje">
                <strong>Mensaje:</strong><br>
                <?php echo $notificacion['mensaje']; ?>
            </div>
            <?php if (!$notificacion['leido']): ?>
                <div class="notificacion-accion">
                    <a href="marcarLeido.php?id=<?php echo $notificacion['id']; ?>" class="btn-leer">Marcar como leído</a>
                </div>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>
</div>