<?php
session_start();
include_once '../connectDB/connect.php';

if (!isset($_SESSION['user']) || !esAdmin($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

// Fetch all users except the admin
$pdo = connectDB();
$users = [];
if ($pdo != null) {
    $consulta = "SELECT * FROM login WHERE user != :adminUser";
    $resul = $pdo->prepare($consulta);
    $resul->execute(['adminUser' => $_SESSION['user']]);
    $users = $resul->fetchAll(PDO::FETCH_ASSOC);
}
?>
<h2>Gestión de Usuarios</h2>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Usuario</th>
            <th>Nombre</th>
            <th>Apellidos</th>
            <th>Email</th>
            <th>Teléfono</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?php echo htmlspecialchars($user['user']); ?></td>
                <td><?php echo htmlspecialchars($user['nombre']); ?></td>
                <td><?php echo htmlspecialchars($user['apellidos']); ?></td>
                <td><?php echo htmlspecialchars($user['email']); ?></td>
                <td><?php echo htmlspecialchars($user['telefono']); ?></td>
                <td>
                    <a href="perfil.php?user=<?php echo $user['user']; ?>" class="btn btn-primary btn-sm">Gestionar Usuario</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>