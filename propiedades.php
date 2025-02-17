<?php
session_start();
include_once 'connectDB/connect.php';

$pdo = connectDB();
$propiedades = [];
if ($pdo != null) {
    $consulta = "SELECT p.*, i.imagen FROM propiedades p LEFT JOIN imagenes i ON p.id = i.propiedad_id";
    $resul = $pdo->query($consulta);
    $propiedades = $resul->fetchAll(PDO::FETCH_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Propiedades - CM Gestión Inmobiliaria</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles/common.css">
</head>
<body>
    <?php include_once "./inludes/header.php"; ?>

    <main class="container my-4">
        <h1 class="text-center mb-4">Nuestras Propiedades</h1>
        <div class="row">
            <?php foreach ($propiedades as $propiedad): ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <?php if ($propiedad['imagen']): ?>
                            <img src="data:image/jpeg;base64,<?php echo base64_encode($propiedad['imagen']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($propiedad['titulo']); ?>">
                        <?php else: ?>
                            <img src="img/default-property.jpg" class="card-img-top" alt="Imagen no disponible">
                        <?php endif; ?>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($propiedad['titulo']); ?></h5>
                            <p class="card-text"><?php echo htmlspecialchars(substr($propiedad['descripcion'], 0, 100)) . '...'; ?></p>
                            <p class="card-text"><strong>Precio:</strong> €<?php echo number_format($propiedad['precio'], 2); ?></p>
                            <a href="detallePropiedad.php?id=<?php echo $propiedad['id']; ?>" class="btn btn-primary">Ver Detalles</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </main>

    <?php include_once "./inludes/footer.php"; ?>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="js/cerrarSesion.js"></script>
</body>
</html>