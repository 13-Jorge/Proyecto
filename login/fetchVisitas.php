<?php
include_once '../connectDB/connect.php';

function obtenerVisitasSolicitadas()
{
    $pdo = connectDB();
    if ($pdo != null) {
        $query = "SELECT v.id, p.titulo AS propiedad, l.nombre AS cliente, v.dias_preferencia AS fecha, v.rango_horas AS hora, v.comentarios
                  FROM visitasSolicitadas v
                  JOIN propiedades p ON v.propiedad_id = p.id
                  JOIN login l ON v.cliente_id = l.user
                  LEFT JOIN visitasConfirmadas vc ON v.id = vc.id_solicitud
                  WHERE vc.id_solicitud IS NULL";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    return [];
}

function obtenerVisitasConfirmadas()
{
    $pdo = connectDB();
    if ($pdo != null) {
        $query = "SELECT vc.id, vc.cliente, vc.agente, p.titulo AS propiedad, vc.fecha, vc.horario
                  FROM visitasConfirmadas vc
                  JOIN propiedades p ON vc.propiedad = p.id";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    return [];
}


$visitasSolicitadas = obtenerVisitasSolicitadas();
$visitasConfirmadas = obtenerVisitasConfirmadas();
?>
<div class="table-responsive">
    <h2>Gestión de Visitas</h2> <br><br>
    <h3 id="gestion-visitas">Visitas Solicitadas</h3>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Propiedad</th>
                <th>Cliente</th>
                <th>Preferencia Fecha</th>
                <th>Preferencia Hora</th>
                <th>Comentarios</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($visitasSolicitadas as $visita): ?>
                <tr>
                    <td><?php echo htmlspecialchars($visita['id']); ?></td>
                    <td><?php echo htmlspecialchars($visita['propiedad']); ?></td>
                    <td><?php echo htmlspecialchars($visita['cliente']); ?></td>
                    <td><?php echo htmlspecialchars($visita['fecha']); ?></td>
                    <td><?php echo htmlspecialchars($visita['hora']); ?></td>
                    <td><?php echo htmlspecialchars($visita['comentarios']); ?></td>
                    <td>
                        <a href="confirmarVisita.php?id=<?php echo $visita['id']; ?>" class="btn btn-primary">Confirmar</a>
                        <form method="post" style="display:inline;" onsubmit="return confirmRechazar(this);">
                            <input type="hidden" name="id" value="<?php echo $visita['id']; ?>">
                            <input type="hidden" name="razon" value="">
                            <button type="submit" name="rechazar" class="btn btn-danger">Rechazar</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h3>Visitas Confirmadas</h3>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Cliente</th>
                <th>Agente</th>
                <th>Propiedad</th>
                <th>Fecha</th>
                <th>Horario</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($visitasConfirmadas as $visita): ?>
                <tr>
                    <td><?php echo htmlspecialchars($visita['id']); ?></td>
                    <td><?php echo htmlspecialchars($visita['cliente']); ?></td>
                    <td><?php echo htmlspecialchars($visita['agente']); ?></td>
                    <td><?php echo htmlspecialchars($visita['propiedad']); ?></td>
                    <td><?php echo htmlspecialchars($visita['fecha']); ?></td>
                    <td><?php echo htmlspecialchars($visita['horario']); ?></td>
                    <td>
                        <form method="post" style="display:inline;">
                            <input type="hidden" name="id" value="<?php echo $visita['id']; ?>">
                            <button type="submit" name="cancelar" class="btn btn-danger">Cancelar</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

