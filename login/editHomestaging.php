<?php
include_once '../connectDB/connect.php';
session_start();

if (!isset($_SESSION['user']) || !esAdmin($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

$pdo = connectDB();

// Obtener agentes con es_admin=true
$queryAgentes = "SELECT user, nombre FROM login WHERE es_admin = 1";
$stmtAgentes = $pdo->prepare($queryAgentes);
$stmtAgentes->execute();
$agentes = $stmtAgentes->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $query = "SELECT * FROM homestaging WHERE id = :id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $homestaging = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$homestaging) {
        header('Location: admin.php?error=notfound');
        exit();
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);
    $propiedad = $_POST['propiedad'];
    $descripcion = $_POST['descripcion'];
    $fecha = $_POST['fecha'];
    $coste = $_POST['coste'];
    $agente = $_POST['agente'];

    $query = "UPDATE homestaging SET propiedad_id = :propiedad, descripcion = :descripcion, fecha = :fecha, coste = :coste, agente = :agente WHERE id = :id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':propiedad', $propiedad, PDO::PARAM_INT);
    $stmt->bindParam(':descripcion', $descripcion, PDO::PARAM_STR);
    $stmt->bindParam(':fecha', $fecha, PDO::PARAM_STR);
    $stmt->bindParam(':coste', $coste, PDO::PARAM_STR);
    $stmt->bindParam(':agente', $agente, PDO::PARAM_STR);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        header('Location: admin.php?success=updated');
        exit();
    } else {
        header('Location: admin.php?error=updatefailed');
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Homestaging</title>
    <link rel="stylesheet" href="../styles/common.css">
    <link rel="stylesheet" href="../styles/confirmarVisita.css">
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h1 class="form-title">Editar Homestaging</h1>
            <form method="POST" action="editHomestaging.php">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($homestaging['id']); ?>">

                <div class="form-group">
                    <label for="propiedad">Propiedad:</label>
                    <input type="text" id="propiedad" name="propiedad" class="form-control" value="<?php echo htmlspecialchars($homestaging['propiedad_id']); ?>" required>
                </div>

                <div class="form-group">
                    <label for="descripcion">Descripción:</label>
                    <textarea id="descripcion" name="descripcion" class="form-control" required><?php echo htmlspecialchars($homestaging['descripcion']); ?></textarea>
                </div>

                <div class="form-group">
                    <label for="fecha">Fecha:</label>
                    <input type="date" id="fecha" name="fecha" class="form-control" value="<?php echo htmlspecialchars($homestaging['fecha']); ?>" required>
                </div>

                <div class="form-group">
                    <label for="coste">Coste:</label>
                    <input type="number" id="coste" name="coste" class="form-control" value="<?php echo htmlspecialchars($homestaging['coste']); ?>" required>
                </div>

                <div class="form-group">
                    <label for="agente">Agente:</label>
                    <select id="agente" name="agente" class="form-control" required>
                        <?php foreach ($agentes as $agente): ?>
                            <option value="<?php echo htmlspecialchars($agente['user']); ?>" <?php echo $homestaging['agente'] === $agente['user'] ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($agente['nombre']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                    <a href="admin.php" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>