<?php
include_once '../connectDB/connect.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Sanitizar el ID recibido por GET

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $motivo = $_POST['motivo'] ?? '';
        $pdo = connectDB();

        if ($pdo != null) {
            try {
                // Eliminar la visita de visitasSolicitadas
                $stmt = $pdo->prepare("DELETE FROM visitasSolicitadas WHERE id = :id");
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                $stmt->execute();

                // Redirigir con éxito y pasar el motivo como parámetro
                header("Location: admin.php?status=rejected&motivo=" . urlencode($motivo));
                exit();
            } catch (Exception $e) {
                error_log("Error al rechazar la visita: " . $e->getMessage());
                header("Location: admin.php?status=error");
                exit();
            }
        }
    }
} else {
    // Redirigir si no se recibe un ID válido
    header("Location: admin.php?status=invalid");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rechazar Visita</title>
    <link rel="stylesheet" href="../styles/confirmarVisita.css">
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h3 class="form-title">Rechazar Visita</h3>
            <form method="POST">
                <div class="form-group">
                    <label for="motivo">Selecciona el motivo del rechazo:</label>
                    <select class="form-control" name="motivo" id="motivo" required>
                        <option value="" disabled selected>Selecciona una opción</option>
                        <option value="fechas">Por fechas</option>
                        <option value="horario">Por horario</option>
                        <option value="ambas">Por ambas</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="propuesta">Proponer nueva fecha u horario (opcional):</label>
                    <textarea class="form-control" name="propuesta" id="propuesta" rows="3" placeholder="Escribe aquí una nueva propuesta de fecha u horario"></textarea>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-danger">Rechazar</button>
                    <a href="fetchVisitas.php" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>