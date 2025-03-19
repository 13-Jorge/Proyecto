<?php
include_once '../connectDB/connect.php';
session_start();

if (!isset($_SESSION['user']) || !esAdmin($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

$pdo = connectDB();
$propiedad = null;
if ($pdo != null && isset($_GET['id'])) {
    $id = $_GET['id'];
    $consulta = "SELECT p.*, i.imagen FROM propiedades p LEFT JOIN imagenes i ON p.id = i.propiedad_id WHERE p.id = ?";
    $stmt = $pdo->prepare($consulta);
    $stmt->execute([$id]);
    $propiedad = $stmt->fetch(PDO::FETCH_ASSOC);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle form submission for updating or deleting the property
    if (isset($_POST['update'])) {
        // Update property
        $titulo = $_POST['titulo'];
        $precio = $_POST['precio'];
        $descripcion = $_POST['descripcion'];
        $direccion = $_POST['direccion'];
        $ciudad = $_POST['ciudad'];
        $codigo_postal = $_POST['codigo_postal'];
        $tipo = $_POST['tipo'];
        $superficie = $_POST['superficie'];
        $num_habitaciones = $_POST['num_habitaciones'];
        $num_banos = $_POST['num_banos'];

        $updateQuery = "UPDATE propiedades SET titulo = ?, precio = ?, descripcion = ?, direccion = ?, ciudad = ?, codigo_postal = ?, tipo = ?, superficie = ?, num_habitaciones = ?, num_banos = ? WHERE id = ?";
        $stmt = $pdo->prepare($updateQuery);
        $stmt->execute([$titulo, $precio, $descripcion, $direccion, $ciudad, $codigo_postal, $tipo, $superficie, $num_habitaciones, $num_banos, $id]);

        // Handle image upload if a new image is provided
        if (!empty($_FILES['imagen']['name'])) {
            $imagen = file_get_contents($_FILES['imagen']['tmp_name']);
            $updateImageQuery = "UPDATE imagenes SET imagen = ? WHERE propiedad_id = ?";
            $stmt = $pdo->prepare($updateImageQuery);
            $stmt->execute([$imagen, $id]);
        }

        header('Location: admin.php');
        exit();
    } elseif (isset($_POST['delete'])) {
        // Delete property
        $deleteQuery = "DELETE FROM propiedades WHERE id = ?";
        $stmt = $pdo->prepare($deleteQuery);
        $stmt->execute([$id]);

        header('Location: fetchPropiedades.php');
        exit();
    }
}
?>

<?php if ($propiedad): ?>
    <h2>Editar Propiedad</h2>
    <form method="post" enctype="multipart/form-data">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="titulo">Título</label>
                <input type="text" id="titulo" name="titulo" class="form-control" value="<?php echo htmlspecialchars($propiedad['titulo']); ?>" required>
            </div>
            <div class="form-group col-md-6">
                <label for="precio">Precio</label>
                <input type="number" id="precio" name="precio" class="form-control" value="<?php echo htmlspecialchars($propiedad['precio']); ?>" required>
            </div>
        </div>
        <div class="form-group">
            <label for="descripcion">Descripción</label>
            <textarea id="descripcion" name="descripcion" class="form-control" rows="3" required><?php echo htmlspecialchars($propiedad['descripcion']); ?></textarea>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="direccion">Dirección</label>
                <input type="text" id="direccion" name="direccion" class="form-control" value="<?php echo htmlspecialchars($propiedad['direccion']); ?>" required>
            </div>
            <div class="form-group col-md-6">
                <label for="ciudad">Ciudad</label>
                <input type="text" id="ciudad" name="ciudad" class="form-control" value="<?php echo htmlspecialchars($propiedad['ciudad']); ?>" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="codigo_postal">Código Postal</label>
                <input type="text" id="codigo_postal" name="codigo_postal" class="form-control" value="<?php echo htmlspecialchars($propiedad['codigo_postal']); ?>" required>
            </div>
            <div class="form-group col-md-6">
                <label for="tipo">Tipo</label>
                <input type="text" id="tipo" name="tipo" class="form-control" value="<?php echo htmlspecialchars($propiedad['tipo']); ?>" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="superficie">Superficie (m²)</label>
                <input type="number" id="superficie" name="superficie" class="form-control" value="<?php echo htmlspecialchars($propiedad['superficie']); ?>" required>
            </div>
            <div class="form-group col-md-6">
                <label for="num_habitaciones">Número de Habitaciones</label>
                <input type="number" id="num_habitaciones" name="num_habitaciones" class="form-control" value="<?php echo htmlspecialchars($propiedad['num_habitaciones']); ?>" required>
            </div>
            <div class="form-group col-md-6 mx-auto">
                <label for="num_banos">Número de Baños</label>
                <input type="number" id="num_banos" name="num_banos" class="form-control" value="<?php echo htmlspecialchars($propiedad['num_banos']); ?>" required>
            </div>
        </div>
        <div class="form-group">
            <label for="imagen">Imagen</label>
            <input type="file" id="imagen" name="imagen" class="form-control-file">
            <?php if ($propiedad['imagen']): ?>
                <img src="data:image/jpeg;base64,<?php echo base64_encode($propiedad['imagen']); ?>" alt="Imagen de la propiedad" class="img-thumbnail mt-2" style="max-width: 200px;">
            <?php endif; ?>
        </div>
        <button type="submit" name="update" class="btn btn-primary">Actualizar Propiedad</button>
        <button type="submit" name="delete" class="btn btn-danger">Eliminar Propiedad</button>
    </form>
<?php else: ?>
    <p>Propiedad no encontrada.</p>
<?php endif; ?>
