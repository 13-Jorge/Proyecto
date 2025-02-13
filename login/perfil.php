<?php
session_start();
include_once '../connectDB/connect.php';

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

$user = $_SESSION['user'];
$datosUsuario = obtenerDatosUsuario($user);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Perfil de Usuario</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="../js/borrarCuenta.js"></script>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Perfil de Usuario</h1>
        <div class="card p-4 mt-3">
            <?php if ($datosUsuario): ?>
                <form method="post" action="actualizarPerfil.php">
                    <div class="form-group">
                        <label for="nombre">Nombre:</label>
                        <input type="text" id="nombre" name="nombre" class="form-control" value="<?php echo $datosUsuario['nombre']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="apellidos">Apellidos:</label>
                        <input type="text" id="apellidos" name="apellidos" class="form-control" value="<?php echo $datosUsuario['apellidos']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" class="form-control" value="<?php echo $datosUsuario['email']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="telefono">Teléfono:</label>
                        <input type="tel" id="telefono" name="telefono" class="form-control" value="<?php echo $datosUsuario['telefono']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="user">Usuario:</label>
                        <input type="text" id="user" name="user" class="form-control" value="<?php echo $datosUsuario['user']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="pass">Contraseña:</label>
                        <input type="password" id="pass" name="pass" class="form-control" value="<?php echo $datosUsuario['pass']; ?>" required>
                    </div>
                    <div class="d-flex justify-content-center mt-3">
                        <button type="submit" class="btn btn-primary mr-2">Actualizar Datos</button>
                        <button type="button" class="btn btn-danger" onclick="borrarCuenta()">Borrar Cuenta</button>
                    </div>
                </form>
            <?php else: ?>
                <div class="alert alert-danger" role="alert">
                    Error al obtener los datos del usuario.
                </div>
            <?php endif; ?>
            <div class="text-center mt-3">
                <a href="../index.php" class="btn btn-primary">Volver al Inicio</a>
            </div>
        </div>
    </div>
</body>
</html>
