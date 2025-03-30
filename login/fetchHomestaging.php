<?php
include_once '../connectDB/connect.php';
session_start();
if (!isset($_SESSION['user']) || !esAdmin($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

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

// Fetch agents
$agentes = obtenerAgentes();

// Fetch homestaging records
$homestagingRecords = obtenerHomestaging();

setlocale(LC_TIME, 'es_ES.UTF-8');
?>



<div class="responsive-container">
    <!-- Formulario para añadir homestaging -->
    <form id="homestaging-form" method="POST" action="insertHomestaging.php" class="responsive-form mb-5">
        <div class="row">
            <div class="col-md-6 mb-3">
                <div class="form-group">
                    <label for="propiedad">Propiedad</label>
                    <select id="propiedad" name="propiedad" class="form-control form-select" required>
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
            </div>
            <div class="col-md-6 mb-3">
                <div class="form-group">
                    <label for="agente">Agente</label>
                    <select id="agente" class="form-control form-select" name="agente" required>
                        <?php foreach ($agentes as $agente): ?>
                            <option value="<?php echo htmlspecialchars($agente['user']); ?>"><?php echo htmlspecialchars($agente['nombre']); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <div class="form-group">
                    <label for="fecha">Fecha</label>
                    <input type="date" id="fecha" name="fecha" class="form-control" required min="<?php echo date('Y-m-d'); ?>">
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="form-group">
                    <label for="coste">Coste</label>
                    <input type="number" id="coste" name="coste" class="form-control" required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 mb-3">
                <div class="form-group">
                    <label for="descripcion">Descripción</label>
                    <textarea id="descripcion" name="descripcion" class="form-control" rows="3" required></textarea>
                </div>
            </div>
        </div>
        <div class="form-group text-center text-md-start">
            <button type="submit" class="btn btn-primary">Añadir Homestaging</button>
        </div>
    </form>

    <!-- Tabla para mostrar homestaging -->
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Propiedad</th>
                    <th class="d-none d-lg-table-cell">Descripción</th>
                    <th>Fecha</th>
                    <th style="width: 100px;">Coste</th>
                    <th>Agente</th>
                    <th class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($homestagingRecords as $record): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($record['id']); ?></td>
                        <td><?php echo htmlspecialchars($record['propiedad_titulo']); ?></td>
                        <td class="d-none d-lg-table-cell"><?php echo htmlspecialchars($record['descripcion']); ?></td>
                        <td><?php echo htmlspecialchars($record['fecha']); ?></td>
                        <td><?php echo htmlspecialchars($record['coste']); ?> €</td>
                        <td><?php echo htmlspecialchars($record['agente_nombre']); ?></td>
                        <td class="text-center">
                            <form method="POST" action="deleteHomestaging.php" onsubmit="return confirm('¿Estás seguro de que deseas cancelar este homestaging?');" style="display:inline;">
                                <input type="hidden" name="id" value="<?php echo htmlspecialchars($record['id']); ?>">
                                <button type="submit" class="btn btn-secondary btn-sm">Cancelar</button>
                            </form>
                            <a href="editHomestaging.php?id=<?php echo htmlspecialchars($record['id']); ?>" class="btn btn-primary btn-sm">Gestionar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
