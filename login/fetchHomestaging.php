<?php
include_once '../connectDB/connect.php';

function obtenerHomestaging()
{
    $pdo = connectDB();
    if ($pdo != null) {
        $query = "SELECT hs.id, p.titulo AS propiedad_titulo, hs.descripcion, hs.fecha, hs.coste, l.nombre AS agente_nombre
                  FROM homestaging hs
                  JOIN propiedades p ON hs.propiedad_id = p.id
                  JOIN login l ON hs.agente = l.user";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    return [];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $propiedad = $_POST['propiedad'];
    $descripcion = $_POST['descripcion'];
    $fecha = $_POST['fecha'];
    $coste = $_POST['coste'];
    $agente = $_POST['agente'];

    $pdo = connectDB();
    if ($pdo != null) {
        $query = "INSERT INTO homestaging (propiedad_id, descripcion, fecha, coste, agente) VALUES (?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$propiedad, $descripcion, $fecha, $coste, $agente]);
    }
}

// Fetch agents
$agentes = obtenerAgentes();

// Fetch homestaging records
$homestagingRecords = obtenerHomestaging();

setlocale(LC_TIME, 'es_ES.UTF-8');
?>

<h2>Gestión de Homestaging</h2>

<!-- Formulario para añadir homestaging -->
<form id="homestaging-form" method="POST">
    <div class="form-group">
        <label for="propiedad">Propiedad</label>
        <select id="propiedad" name="propiedad" class="form-control" required>
            <?php
            $pdo = connectDB();
            $consulta = "SELECT id, titulo FROM propiedades";
            $resul = $pdo->query($consulta);
            while ($propiedad = $resul->fetch(PDO::FETCH_ASSOC)) {
                echo '<option value="' . htmlspecialchars($propiedad['id']) . '">' . htmlspecialchars($propiedad['titulo']) . '</option>';
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="descripcion">Descripción</label>
        <textarea id="descripcion" name="descripcion" class="form-control" required></textarea>
    </div>
    <div class="form-group">
        <label for="fecha">Fecha</label>
        <input type="date" id="fecha" name="fecha" class="form-control" required min="<?php echo date('Y-m-d'); ?>" pattern="\d{2}/\d{2}/\d{4}">
    </div>
    <div class="form-group">
        <label for="coste">Coste</label>
        <input type="number" id="coste" name="coste" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="agente">Agente</label>
        <select class="form-control" name="agente" required>
            <?php foreach ($agentes as $agente): ?>
                <option value="<?php echo htmlspecialchars($agente['user']); ?>"><?php echo htmlspecialchars($agente['nombre']); ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Añadir Homestaging</button>
</form>

<!-- Tabla para mostrar homestaging -->
<table class="table mt-4">
    <thead>
        <tr>
            <th>ID</th>
            <th>Propiedad</th>
            <th>Descripción</th>
            <th>Fecha</th>
            <th>Coste</th>
            <th>Agente</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($homestagingRecords as $record): ?>
            <tr>
                <td><?php echo htmlspecialchars($record['id']); ?></td>
                <td><?php echo htmlspecialchars($record['propiedad_titulo']); ?></td>
                <td><?php echo htmlspecialchars($record['descripcion']); ?></td>
                <td><?php echo htmlspecialchars($record['fecha']); ?></td>
                <td><?php echo htmlspecialchars($record['coste']); ?></td>
                <td><?php echo htmlspecialchars($record['agente_nombre']); ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>