<?php
include_once '../connectDB/connect.php';
session_start();

if (!isset($_SESSION['user']) || !esAdmin($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

$pdo = connectDB();
$propiedades = [];
if ($pdo != null) {
    $consulta = "SELECT * FROM propiedades";
    $resul = $pdo->query($consulta);
    $propiedades = $resul->fetchAll(PDO::FETCH_ASSOC);
}
?>
<h2>Gestión de Propiedades</h2>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Título</th>
            <th>Descripción</th>
            <th>Precio</th>
            <th>Dirección</th>
            <th>Ciudad</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($propiedades as $propiedad): ?>
            <tr>
                <td><?php echo htmlspecialchars($propiedad['titulo']); ?></td>
                <td><?php echo htmlspecialchars($propiedad['descripcion']); ?></td>
                <td><?php echo htmlspecialchars($propiedad['precio']); ?> €</td>
                <td><?php echo htmlspecialchars($propiedad['direccion']); ?></td>
                <td><?php echo htmlspecialchars($propiedad['ciudad']); ?></td>
                <td>
                    <a href="editarPropiedad.php?id=<?php echo $propiedad['id']; ?>" class="btn btn-primary btn-sm">Editar</a>
                    <a href="eliminarPropiedad.php?id=<?php echo $propiedad['id']; ?>" class="btn btn-danger btn-sm">Eliminar</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
