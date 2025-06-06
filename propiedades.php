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

if (isset($_POST['propiedad_id']) && isset($_POST['is_favorite']) && isset($_SESSION['user'])) {
    $cliente_id = $_SESSION['user'];
    $propiedad_id = $_POST['propiedad_id'];
    $is_favorite = $_POST['is_favorite'];

    if ($is_favorite === 'true') {
        $consulta = "INSERT INTO favoritas (cliente_id, propiedad_id) VALUES (:cliente_id, :propiedad_id)";
        $stmt = $pdo->prepare($consulta);
        $stmt->execute([
            'cliente_id' => $cliente_id,
            'propiedad_id' => $propiedad_id
        ]);
    } else {
        $consulta = "DELETE FROM favoritas WHERE cliente_id = :cliente_id AND propiedad_id = :propiedad_id";
        $stmt = $pdo->prepare($consulta);
        $stmt->execute([
            'cliente_id' => $cliente_id,
            'propiedad_id' => $propiedad_id
        ]);
    }

    echo json_encode(['success' => true]);
    exit();
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
    <link rel="stylesheet" href="styles/propiedades.css">
</head>
<body>
    <?php include_once "./includes/header.php"; ?>

    <main class="container my-4">
        <div class="row">
            <?php foreach ($propiedades as $propiedad): ?>
                <div class="col-lg-4 md-6 mb-4 ">
                    <div class="card">
                        <!-- Mostramos la imagen fuera del collapse -->
                        <div class="card-img-container">
                            <?php if ($propiedad['imagen']): ?>
                                <img src="data:image/jpeg;base64,<?php echo base64_encode($propiedad['imagen']); ?>" alt="<?php echo htmlspecialchars($propiedad['titulo']); ?>">
                            <?php else: ?>
                                <img src="img/default-property.jpg" alt="Imagen no disponible">
                            <?php endif; ?>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($propiedad['titulo']); ?></h5>
                            <p class="card-text property-price"><?php echo number_format($propiedad['precio'], 0, ',', '.'); ?>€</p>
                            
                            <button class="btn btn-gold btn-toggle collapsed" type="button" data-toggle="collapse" data-target="#collapse<?php echo $propiedad['id']; ?>" aria-expanded="false" aria-controls="collapse<?php echo $propiedad['id']; ?>">
                                <span>Ver Detalles</span> 
                                <i class="fas fa-chevron-down"></i>
                                <i class="fas fa-chevron-up"></i>
                            </button>
                            
                            <div class="collapse" id="collapse<?php echo $propiedad['id']; ?>">
                                <div class="property-details mt-3">
                                    <p class="card-text"><?php echo htmlspecialchars($propiedad['descripcion']); ?></p>
                                    
                                    <div class="property-features">
                                        <p><strong>Direccion:</strong> <?php echo htmlspecialchars($propiedad['direccion']); ?></p>
                                        <p><strong>Ciudad:</strong> <?php echo htmlspecialchars($propiedad['ciudad']); ?></p>
                                        <p><strong>Código Postal:</strong> <?php echo htmlspecialchars($propiedad['codigo_postal']); ?></p>
                                        <p><strong>Superficie:</strong> <?php echo htmlspecialchars($propiedad['superficie']); ?> m²</p>
                                    </div>
                                </div>
                            </div>
                            
                            <label class="btn-favorite">
                                <input type="checkbox" class="favorite-checkbox" data-propiedad-id="<?php echo $propiedad['id']; ?>">
                                <i class="fas fa-heart"></i>
                            </label>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </main>

    <?php include_once "./includes/footer.php"; ?>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="js/cerrarSesion.js"></script>
    <script src="js/propiedades.js"></script>
    <script src="js/favoritos.js"></script>
</body>
</html>