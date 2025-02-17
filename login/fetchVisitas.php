<?php
include_once '../connectDB/connect.php';

function obtenerVisitas() {
    $pdo = connectDB();
    if ($pdo != null) {
        $query = "SELECT v.id, p.titulo AS propiedad, l.nombre AS cliente, v.dias_preferencia AS fecha, v.rango_horas AS hora, v.comentarios
                  FROM visitas v
                  JOIN propiedades p ON v.propiedad_id = p.id
                  JOIN login l ON v.cliente_id = l.user";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    return [];
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
            <th>Comentarios</th>
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
                <td><?php echo htmlspecialchars($visita['comentarios']); ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
