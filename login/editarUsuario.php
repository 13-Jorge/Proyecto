<?php
session_start();
include_once '../connectDB/connect.php';

if (!isset($_SESSION['user']) || !esAdmin($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

$id = recogerValor('id');
$pdo = connectDB();
$user = null;
if ($pdo != null) {
    $consulta = "SELECT * FROM login WHERE id = :id";
    $resul = $pdo->prepare($consulta);
    $resul->execute(['id' => $id]);
    $user = $resul->fetch(PDO::FETCH_ASSOC);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = recogerValor('user');
    $nombre = recogerValor('nombre');
    $apellidos = recogerValor('apellidos');
    $email = recogerValor('email');
    $telefono = recogerValor('telefono');
    $pass = recogerValor('pass');
    $es_admin = isset($_POST['es_admin']) ? 1 : 0;

    $consulta = "UPDATE login SET user = :user, nombre = :nombre, apellidos = :apellidos, email = :email, telefono = :telefono, pass = :pass, es_admin = :es_admin WHERE user = :user";
    $resul = $pdo->prepare($consulta);
    $resul->execute([
        'user' => $user,
        'nombre' => $nombre,
        'apellidos' => $apellidos,
        'email' => $email,
        'telefono' => $telefono,
        'pass' => $pass,
        'es_admin' => $es_admin
    ]);
    header('Location: admin.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario - CM Gestión Inmobiliaria</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Editar Usuario</h1>
        <div class="card p-4 mt-3">
            <?php if ($user): ?>
                <form method="post">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="user">Usuario:</label>
                            <input type="text" id="user" name="user" class="form-control" value="<?php echo htmlspecialchars($user['user']); ?>" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="nombre">Nombre:</label>
                            <input type="text" id="nombre" name="nombre" class="form-control" value="<?php echo htmlspecialchars($user['nombre']); ?>" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="apellidos">Apellidos:</label>
                            <input type="text" id="apellidos" name="apellidos" class="form-control" value="<?php echo htmlspecialchars($user['apellidos']); ?>" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">Email:</label>
                            <input type="email" id="email" name="email" class="form-control" value="<?php echo htmlspecialchars($user['email']); ?>" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="telefono">Teléfono:</label>
                            <input type="tel" id="telefono" name="telefono" class="form-control" value="<?php echo htmlspecialchars($user['telefono']); ?>" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="pass">Contraseña:</label>
                            <input type="password" id="pass" name="pass" class="form-control" value="<?php echo htmlspecialchars($user['pass']); ?>" required>
                        </div>
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="es_admin" name="es_admin" <?php echo $user['es_admin'] ? 'checked' : ''; ?>>
                        <label class="form-check-label" for="es_admin">Administrador</label>
                    </div>
                    <div class="d-flex justify-content-center mt-3">
                        <button type="submit" class="btn btn-primary mr-2">Actualizar</button>
                        <a href="admin.php" class="btn btn-secondary">Cancelar</a>
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
