<?php
include_once '../connectDB/connect.php';
session_start();

if (!isset($_SESSION['user']) || !esAdmin($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

$pdo = connectDB();
$propiedades = [];
if ($pdo != null) {
    $consulta = "SELECT p.*, i.imagen FROM propiedades p LEFT JOIN imagenes i ON p.id = i.propiedad_id";
    $resul = $pdo->query($consulta);
    $propiedades = $resul->fetchAll(PDO::FETCH_ASSOC);
}


?>
<h2>Gestión de Propiedades</h2>
<form id="addPropertyForm" method="post" enctype="multipart/form-data" action="insertarPropiedad.php">
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="titulo">Título</label>
            <input type="text" id="titulo" name="titulo" class="form-control" required>
        </div>
        <div class="form-group col-md-6">
            <label for="precio">Precio</label>
            <input type="number" id="precio" name="precio" class="form-control" required>
        </div>
    </div>
    <div class="form-group">
        <label for="descripcion">Descripción</label>
        <textarea id="descripcion" name="descripcion" class="form-control" rows="3" required></textarea>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="direccion">Dirección</label>
            <input type="text" id="direccion" name="direccion" class="form-control" required>
        </div>
        <div class="form-group col-md-6">
            <label for="ciudad">Ciudad</label>
            <input type="text" id="ciudad" name="ciudad" class="form-control" required>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="codigo_postal">Código Postal</label>
            <input type="text" id="codigo_postal" name="codigo_postal" class="form-control" required>
        </div>
        <div class="form-group col-md-6">
            <label for="tipo">Tipo</label>
            <input type="text" id="tipo" name="tipo" class="form-control" required>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="superficie">Superficie (m²)</label>
            <input type="number" id="superficie" name="superficie" class="form-control" required>
        </div>
        <div class="form-group col-md-6">
            <label for="num_habitaciones">Número de Habitaciones</label>
            <input type="number" id="num_habitaciones" name="num_habitaciones" class="form-control" required>
        </div>
        <div class="form-group col-md-6 mx-auto">
            <label for="num_banos">Número de Baños</label>
            <input type="number" id="num_banos" name="num_banos" class="form-control" required>
        </div>
    </div>
    <div class="form-group">
        <label for="imagen">Imagen</label>
        <input type="file" id="imagen" name="imagen" class="form-control-file" required>
    </div>
    <button type="submit" class="btn btn-primary">Añadir Propiedad</button>
</form>
<hr>
<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Título</th>
                <th class="descripcion-columna">Descripción</th>
                <th>Precio</th>
                <th>Dirección</th>
                <th>Ciudad</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($propiedades as $propiedad): ?>
                <tr>
                    <td><?php echo htmlspecialchars($propiedad['titulo']); ?></td>
                    <td class="descripcion-columna"><?php echo htmlspecialchars($propiedad['descripcion']); ?></td>
                    <td>
                        <?php
                        $precioFormateado = strpos($propiedad['precio'], '.') !== false ? rtrim(rtrim($propiedad['precio'], '0'), '.') : $propiedad['precio'];
                        echo htmlspecialchars($precioFormateado) . ' €';
                        ?>
                    </td>
                    <td><?php echo htmlspecialchars($propiedad['direccion']); ?></td>
                    <td><?php echo htmlspecialchars($propiedad['ciudad']); ?></td>
                    <td>
                        <a href="editarPropiedad.php?id=<?php echo $propiedad['id']; ?>" class="btn btn-primary btn-sm">Gestionar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</div>