<?php
include_once '../connectDB/connect.php';

function obtenerVisitaSolicitada($id)
{
    $pdo = connectDB();
    if ($pdo != null) {
        $query = "SELECT v.id, p.titulo AS propiedad, p.id AS propiedad_id, l.nombre AS cliente, v.dias_preferencia AS fecha, v.rango_horas AS hora, v.comentarios
                  FROM visitasSolicitadas v
                  JOIN propiedades p ON v.propiedad_id = p.id
                  JOIN login l ON v.cliente_id = l.user
                  WHERE v.id = :id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    return null;
}

function obtenerAgentes()
{
    $pdo = connectDB();
    if ($pdo != null) {
        $query = "SELECT user, nombre FROM login WHERE es_admin = TRUE";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    return [];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $cliente = $_POST['cliente'];
    $agente = $_POST['agente'];
    $propiedad = $_POST['propiedad'];
    $fecha = $_POST['fecha'];
    $horario = $_POST['horario'];

    $pdo = connectDB();
    if ($pdo != null) {
        $query = "INSERT INTO visitasConfirmadas (id_solicitud, cliente, agente, propiedad, fecha, horario)
                  VALUES (:id_solicitud, :cliente, :agente, :propiedad, :fecha, :horario)";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':id_solicitud', $id);
        $stmt->bindParam(':cliente', $cliente);
        $stmt->bindParam(':agente', $agente);
        $stmt->bindParam(':propiedad', $propiedad);
        $stmt->bindParam(':fecha', $fecha);
        $stmt->bindParam(':horario', $horario);
        $stmt->execute();

        header('Location: ../admin.php#gestion-visitas');
        exit;
    }
}

$id = $_GET['id'];
$visita = obtenerVisitaSolicitada($id);
$agentes = obtenerAgentes();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Confirmar Visita</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h2>Confirmar Visita</h2>
    <form method="post">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($visita['id']); ?>">
        <div class="form-group">
            <label>Cliente</label>
            <input type="text" class="form-control" name="cliente" value="<?php echo htmlspecialchars($visita['cliente']); ?>" readonly>
        </div>
        <div class="form-group">
            <label>Propiedad</label>
            <input type="hidden" name="propiedad" value="<?php echo htmlspecialchars($visita['propiedad_id']); ?>">
            <input type="text" class="form-control" value="<?php echo htmlspecialchars($visita['propiedad']); ?>" readonly>
        </div>
        <div class="form-group">
            <label>Fecha</label>
            <select class="form-control" name="fecha" required>
                <?php 
                $fechas = explode(',', $visita['fecha']);
                foreach ($fechas as $fecha): ?>
                    <option value="<?php echo htmlspecialchars($fecha); ?>"><?php echo htmlspecialchars($fecha); ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label>Horario</label>
            <input type="text" class="form-control" name="horario" value="<?php echo htmlspecialchars($visita['hora']); ?>" readonly>
        </div>
        <div class="form-group">
            <label>Agente</label>
            <select class="form-control" name="agente" required>
                <?php foreach ($agentes as $agente): ?>
                    <option value="<?php echo htmlspecialchars($agente['user']); ?>"><?php echo htmlspecialchars($agente['nombre']); ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Confirmar</button>
    </form>
</div>
</body>
</html>
