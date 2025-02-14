<?php
include_once '../connectDB/connect.php';
session_start();

if (!isset($_SESSION['user']) || !esAdmin($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

$notificaciones = obtenerNotificaciones();
?>
<h2>Notificaciones</h2>
<ul class="list-group">
    <?php foreach ($notificaciones as $notificacion): ?>
        <li class="list-group-item <?php echo $notificacion['leido'] ? 'list-group-item-secondary' : ''; ?>">
            <strong>Email:</strong> <?php echo htmlspecialchars($notificacion['email']); ?><br>
            <strong>Mensaje:</strong> <?php echo htmlspecialchars($notificacion['mensaje']); ?>
            <?php if (!$notificacion['leido']): ?>
                <a href="marcarLeido.php?id=<?php echo $notificacion['id']; ?>" class="btn btn-sm btn-primary float-right">Marcar como leído</a>
            <?php endif; ?>
        </li>
    <?php endforeach; ?>
</ul>
