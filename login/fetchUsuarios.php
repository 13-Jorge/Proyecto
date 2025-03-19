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

<style>
    /* Oculta la columna de teléfono en tablets y móviles */
    @media only screen and (max-width: 1024px) {
        .telefono-columna {
            display: none;
        }
        .acciones-columna {
            width: 80px;
        }
        .btn-gestionar {
            padding: 0.25rem 0.5rem;
            font-size: 0.8rem;
        }
    }
</style>


<h2>Gestión de Usuarios</h2>
<div class="usuarios-table-container">
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Usuario</th>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Email</th>
                    <th class="telefono-columna">Teléfono</th>
                    <th class="acciones-columna">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($user['user']); ?></td>
                        <td><?php echo htmlspecialchars($user['nombre']); ?></td>
                        <td><?php echo htmlspecialchars($user['apellidos']); ?></td>
                        <td><?php echo htmlspecialchars($user['email']); ?></td>
                        <td class="telefono-columna"><?php echo htmlspecialchars($user['telefono']); ?></td>
                        <td class="acciones-columna">
                            <a href="perfil.php?user=<?php echo $user['user']; ?>" class="btn btn-primary btn-sm btn-gestionar">Gestionar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>