<?php
include_once '../connectDB/connect.php';
session_start();

if (!isset($_SESSION['user']) || !esAdmin($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

$pdo = connectDB();

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Obtener la visita confirmada
    $queryVisita = "SELECT id, agente FROM visitasConfirmadas WHERE id = :id";
    $stmtVisita = $pdo->prepare($queryVisita);
    $stmtVisita->bindParam(':id', $id, PDO::PARAM_INT);
    $stmtVisita->execute();
    $visita = $stmtVisita->fetch(PDO::FETCH_ASSOC);

    if (!$visita) {
        header('Location: admin.php?error=notfound');
        exit();
    }

    // Obtener agentes con es_admin=true
    $queryAgentes = "SELECT user, nombre FROM login WHERE es_admin = 1";
    $stmtAgentes = $pdo->prepare($queryAgentes);
    $stmtAgentes->execute();
    $agentes = $stmtAgentes->fetchAll(PDO::FETCH_ASSOC);
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id']) && isset($_POST['agente'])) {
    $id = intval($_POST['id']);
    $agente = $_POST['agente'];

    // Actualizar el agente en la base de datos
    $query = "UPDATE visitasConfirmadas SET agente = :agente WHERE id = :id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':agente', $agente, PDO::PARAM_STR);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        header('Location: admin.php?success=reasigned');
        exit();
    } else {
        header('Location: admin.php?error=reasignfailed');
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reasignar Agente</title>
    <link rel="stylesheet" href="../styles/common.css">
    <link rel="stylesheet" href="../styles/confirmarVisita.css">
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h1 class="form-title">Reasignar Agente</h1>
            <form method="POST" action="reasignarAgenteForm.php">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($visita['id']); ?>">

                <div class="form-group">
                    <label for="agente">Seleccionar nuevo agente:</label>
                    <select id="agente" name="agente" class="form-control" required>
                        <?php foreach ($agentes as $agente): ?>
                            <option value="<?php echo htmlspecialchars($agente['user']); ?>" <?php echo $visita['agente'] === $agente['user'] ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($agente['nombre']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                    <a href="admin.php" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>