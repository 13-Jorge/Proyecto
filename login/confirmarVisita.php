<?php
include_once '../connectDB/connect.php';

function obtenerVisitaSolicitada($id)
{
    $pdo = connectDB();
    if ($pdo != null) {
        $query = "SELECT v.id, p.titulo AS propiedad, p.id AS propiedad_id, l.user AS cliente, v.dias_preferencia AS fecha, v.rango_horas AS hora, v.comentarios
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



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $cliente = $_POST['cliente'];
    $agente = $_POST['agente'];
    $propiedad = $_POST['propiedad'];
    $fecha = $_POST['fecha'];
    $horario = $_POST['horario'];

    $pdo = connectDB();
    if ($pdo != null) {
        try {
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

            header('Location: admin.php');
            exit;
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmar Visita</title>
    <link rel="stylesheet" href="../styles/common.css">
    <link rel="stylesheet" href="../styles/confirmarVisita.css">
</head>
<body>
<div class="container">
    <h2 class="form-title">Confirmar Visita</h2>
    <div class="form-container">
        <form method="post">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($visita['id']); ?>">
            <div class="form-group">
                <label>Cliente</label>
                <input type="text" class="form-control readonly" name="cliente" value="<?php echo htmlspecialchars($visita['cliente']); ?>" readonly>
            </div>
            <div class="form-group">
                <label>Propiedad</label>
                <input type="hidden" name="propiedad" value="<?php echo htmlspecialchars($visita['propiedad_id']); ?>">
                <input type="text" class="form-control readonly" value="<?php echo htmlspecialchars($visita['propiedad']); ?>" readonly>
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
                <input type="text" class="form-control readonly" name="horario" value="<?php echo htmlspecialchars($visita['hora']); ?>" readonly>
            </div>
            <div class="form-group">
                <label>Agente</label>
                <select class="form-control" name="agente" required>
                    <?php foreach ($agentes as $agente): ?>
                        <option value="<?php echo htmlspecialchars($agente['user']); ?>"><?php echo htmlspecialchars($agente['nombre']); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn-primary">Confirmar</button>
                <a href="admin.php" class="btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</div>
</body>
</html>