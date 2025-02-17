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
    <link rel="stylesheet" href="styles/index.css">
</head>
<body>
    <!-- Header con la barra de navegación -->
    <header>
        <nav class="navbar navbar-expand-lg navbar-light fixed-top">
            <div class="container">
                <a class="navbar-brand" href="index.php">
                    <img src="img/logo.jpg" alt="CM Gestión Inmobiliaria" style="height: 60px;">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item"><a class="nav-link" href="index.php">Inicio</a></li>
                        <li class="nav-item"><a class="nav-link" href="#about">Acerca de</a></li>
                        <li class="nav-item"><a class="nav-link" href="#services">Servicios</a></li>
                        <li class="nav-item"><a class="nav-link" href="#testimonials">Testimonios</a></li>
                        <li class="nav-item"><a class="nav-link" href="#contact">Contacto</a></li>
                        <li class="nav-item"><a class="nav-link" href="propiedades.php">Propiedades</a></li>
                    </ul>
                    <div class="user-info d-flex align-items-center ml-3">
                        <?php if (isset($_SESSION['user'])): ?>
                            <img src="img/user.svg" alt="User Icon" class="rounded-circle mr-2" style="width: 30px; height: 30px;">
                            <a href="<?php echo esAdmin($_SESSION['user']) ? 'login/admin.php' : 'login/perfil.php'; ?>" class="btn btn-outline-light mr-2"><?php echo htmlspecialchars($_SESSION['user']); ?></a>
                            <button class="btn btn-outline-light" onclick="cerrarSesion()">Cerrar Sesión</button>
                        <?php else: ?>
                            <button class="btn btn-outline-light" onclick="window.location.href='login/login.php'">Iniciar Sesión</button>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <!-- Contenido Principal -->
    <main class="container mt-5">
        <h1 class="text-center mb-4">Propiedades</h1>
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
                            <p class="card-text"><?php echo htmlspecialchars($propiedad['descripcion']); ?></p>
                            <p class="card-text"><strong>Precio:</strong> <?php echo htmlspecialchars($propiedad['precio']); ?> €</p>
                            <a href="detallePropiedad.php?id=<?php echo $propiedad['id']; ?>" class="btn btn-primary">Ver Detalles</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </main>

    <!-- Footer -->
    <footer class="footer text-center">
        <div class="container">
            <p>&copy; <?php echo date('Y'); ?> CM Gestión Inmobiliaria. Todos los derechos reservados.</p>
            <p>
                <a href="#">Política de Privacidad</a> |
                <a href="#">Términos y Condiciones</a>
            </p>
            <div class="social-icons mt-3">
                <a href="#" class="mx-2"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="mx-2"><i class="fab fa-twitter"></i></a>
                <a href="#" class="mx-2"><i class="fab fa-instagram"></i></a>
                <a href="#" class="mx-2"><i class="fab fa-linkedin-in"></i></a>
            </div>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="js/cerrarSesion.js"></script>
</body>
</html>
