<?php
session_start();
include_once '../connectDB/connect.php';

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

$user = isset($_GET['user']) && esAdmin($_SESSION['user']) ? $_GET['user'] : $_SESSION['user'];
$datosUsuario = obtenerDatosUsuario($user);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de Usuario - CM Gestión Inmobiliaria</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../styles/login.css">
    <script src="../js/borrarCuenta.js"></script>
</head>
<body>
    <div class="container mt-5">
        <div class="d-flex justify-content-end mb-3">
            <a href="../index.php" class="btn btn-secondary mr-2">Volver al Inicio</a>
            <?php if (esAdmin($_SESSION['user'])): ?>
                <a href="admin.php" class="btn btn-secondary mr-2">Administrador</a>
            <?php endif; ?>
        </div>
        <h1 class="text-center mb-4">Perfil de Usuario</h1>
        <div class="card p-4 mt-3">
            <?php if ($datosUsuario): ?>
                <form method="post" action="actualizarPerfil.php">
                    <input type="hidden" name="oldUser" value="<?php echo htmlspecialchars($datosUsuario['user']); ?>">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="nombre">Nombre:</label>
                            <input type="text" id="nombre" name="nombre" class="form-control" value="<?php echo htmlspecialchars($datosUsuario['nombre']); ?>" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="apellidos">Apellidos:</label>
                            <input type="text" id="apellidos" name="apellidos" class="form-control" value="<?php echo htmlspecialchars($datosUsuario['apellidos']); ?>" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="email">Email:</label>
                            <input type="email" id="email" name="email" class="form-control" value="<?php echo htmlspecialchars($datosUsuario['email']); ?>" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="telefono">Teléfono:</label>
                            <input type="tel" id="telefono" name="telefono" class="form-control" value="<?php echo htmlspecialchars($datosUsuario['telefono']); ?>" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="user">Usuario:</label>
                            <input type="text" id="user" name="user" class="form-control" value="<?php echo htmlspecialchars($datosUsuario['user']); ?>" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="pass">Contraseña:</label>
                            <input type="password" id="pass" name="pass" class="form-control" value="<?php echo htmlspecialchars($datosUsuario['pass']); ?>" required>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center mt-3">
                        <button type="submit" class="btn btn-primary mr-2">Actualizar Datos</button>
                        <button type="button" class="btn btn-danger" onclick="borrarCuenta('<?php echo htmlspecialchars($datosUsuario['user']); ?>')">Borrar Cuenta</button>
                    </div>
                </form>
            <?php else: ?>
                <div class="alert alert-danger" role="alert">
                    Error al obtener los datos del usuario.
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>