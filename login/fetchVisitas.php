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
                  WHERE vc.id_solicitud IS NULL
                  AND STR_TO_DATE(SUBSTRING_INDEX(v.dias_preferencia, ',', -1), '%d/%m/%Y') >= CURDATE()";
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
                  JOIN propiedades p ON vc.propiedad = p.id
                  WHERE STR_TO_DATE(vc.fecha, '%d/%m/%Y') >= CURDATE()";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    return [];
}


$visitasSolicitadas = obtenerVisitasSolicitadas();
$visitasConfirmadas = obtenerVisitasConfirmadas();
?>

<style>
/* Estilos para dispositivos móviles */
@media (max-width: 767px) {
    .table-responsive {
        width: 100%;
        overflow-x: auto;
    }
    
    .table {
        width: 100%;
        min-width: 700px; /* Ancho mínimo consistente para ambas tablas */
    }
    
    .tabla-acciones {
        min-width: 100px !important;
        width: 100px !important;
    }
    
    .btn-accion {
        padding: 0.375rem 0.5rem;
        font-size: 0.875rem;
        text-align: center;
        height: 38px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    /* Ocultar la columna de comentarios en dispositivos móviles */
    .columna-comentarios,
    .th-comentarios {
        display: none;
    }
}

/* Estilos específicos para tablets (1024x768 o menor) */
@media (min-width: 768px) and (max-width: 1024px) {
    .table-responsive {
        width: 100%;
        overflow-x: auto;
    }
    
    .table {
        width: 100%;
        min-width: 700px; /* Ancho mínimo consistente para ambas tablas */
    }
    
    .tabla-acciones {
        min-width: 120px !important;
        width: 120px !important;
    }
    
    .btn-accion {
        padding: 0.375rem 0.5rem;
        font-size: 0.875rem;
    }
    
    /* Ocultar la columna de comentarios en tablets */
    .columna-comentarios,
    .th-comentarios {
        display: none;
    }
}
</style>

<div class="table-responsive">
    <h3 id="gestion-visitas">Visitas Solicitadas</h3>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Propiedad</th>
                <th>Cliente</th>
                <th>Preferencia Fecha</th>
                <th>Preferencia Hora</th>
                <th class="th-comentarios">Comentarios</th>
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
                    <td class="columna-comentarios"><?php echo htmlspecialchars($visita['comentarios']); ?></td>
                    <td class="tabla-acciones" style="min-width: 140px;">
                        <div class="d-flex flex-column flex-xl-row gap-2">
                            <a href="confirmarVisita.php?id=<?php echo $visita['id']; ?>" class="btn btn-primary btn-sm w-100 mb-2 mb-xl-0 btn-accion">Confirmar</a>
                            <a href="confirmarVisita.php?id=<?php echo $visita['id']; ?>" class="btn btn-secondary btn-sm w-100 btn-accion">Rechazar</a>
                        </div>
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
                    <td class="tabla-acciones" style="min-width: 140px;">
                        <a href="confirmarVisita.php?id=<?php echo $visita['id']; ?>" class="btn btn-secondary w-100 btn-accion">Cancelar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>