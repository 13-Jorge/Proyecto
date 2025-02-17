<?php
include_once '../connectDB/connect.php';

function obtenerVisitas() {
    global $conn; 
    $query = "SELECT * FROM visitas";
    $result = mysqli_query($conn, $query);
    $visitas = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $visitas;
}

$visitas = obtenerVisitas();
?>

<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Propiedad</th>
            <th>Cliente</th>
            <th>Fecha</th>
            <th>Hora</th>
            <th>Estado</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($visitas as $visita): ?>
            <tr>
                <td><?php echo htmlspecialchars($visita['id']); ?></td>
                <td><?php echo htmlspecialchars($visita['propiedad']); ?></td>
                <td><?php echo htmlspecialchars($visita['cliente']); ?></td>
                <td><?php echo htmlspecialchars($visita['fecha']); ?></td>
                <td><?php echo htmlspecialchars($visita['hora']); ?></td>
                <td><?php echo htmlspecialchars($visita['estado']); ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
